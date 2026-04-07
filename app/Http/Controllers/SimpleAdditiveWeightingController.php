<?php

namespace App\Http\Controllers;

class SimpleAdditiveWeightingController extends Controller
{
    public function __invoke()
    {
        return view('simple-additive-weighting.index');
    }
}
