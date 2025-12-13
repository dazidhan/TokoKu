<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('karyawan', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'phone' => 'required',
            'status' => 'required',
            'joined_at' => 'required|date',
        ]);

        // Employee::create($request->all());
        Employee::create($request->except(['_token']));
        return redirect()->back();
    }

    public function destroy($id)
    {
        Employee::find($id)->delete();
        return redirect()->back();
    }
}