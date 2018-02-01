<?php

namespace laravel\Http\Controllers;

Use laravel\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        if(request()->wantsJson()){
        $products = datatables()->of(Product::query())->toJson();
        return $products;
        }
        return view('products.index');
    }
}
