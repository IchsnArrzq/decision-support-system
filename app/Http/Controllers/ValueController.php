<?php

namespace App\Http\Controllers;

class ValueController extends Controller
{
    public function index()
    {
        return view('values.index');
    }

    public function create()
    {
        return view('values.create');
    }

    public function edit()
    {
        return view('values.edit');
    }

    public function show()
    {
        return view('values.show');
    }
}
