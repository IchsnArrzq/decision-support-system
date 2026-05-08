<?php

namespace App\Http\Controllers;

class CriteriaController extends Controller
{
    public function index()
    {
        return view('criterias.index');
    }

    public function create()
    {
        return view('criterias.create');
    }

    public function edit()
    {
        return view('criterias.edit');
    }

    public function show()
    {
        return view('criterias.show');
    }
}
