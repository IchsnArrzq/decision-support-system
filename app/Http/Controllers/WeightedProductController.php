<?php

namespace App\Http\Controllers;

class WeightedProductController extends Controller
{
    public function __invoke()
    {
        return view('weighted-product.index');
    }
}
