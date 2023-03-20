<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;

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
        Bill::create([
            'doc_no' => rand(),
            'amount' => request('amount'),
            'description' => request('description')
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
}
