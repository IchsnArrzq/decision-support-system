<?php

namespace App\Http\Controllers;

class AlternativeController extends Controller
{
    public function index()
    {
        return view('alternatives.index');
    }

    public function create()
    {
        return view('alternatives.create');
    }

    public function edit()
    {
        return view('alternatives.edit');
    }

    public function show()
    {
        return view('alternatives.show');
    }
}
