<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class BillController extends Controller
{
    public function index()
    {
        $data = Bill::all();

        return view('bill.index', compact('data'));
    }

    public function create()
    {
        return view('bill.create');
    }

    public function store(Request $request)
    {
        $secret_key = 'Basic ' . config('xendit.key_auth');
        $external_id = Str::random(10);

        $data_request = Http::withHeaders([
            'Authorization' => $secret_key
        ])->post('https://api.xendit.co/v2/invoices', [
            'external_id' => $external_id,
            'amount' => request('amount')
        ]);

        $response = $data_request->object();

        Bill::create([
            'trx_no' => $external_id,
            'amount' => request('amount'),
            'description' => request('description'),
            'payment_status' => $response->status,
            'payment_link' => $response->invoice_url
        ]);

        return redirect()->route('bill.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function callback()
    {
        $data = request()->all();
        
        $status = $data['status'];
        $external_id = $data['external_id'];

        Bill::where('trx_no', $external_id)->update([
            'payment_status' => $status
        ]);

        return response()->json($data);
    }
}
