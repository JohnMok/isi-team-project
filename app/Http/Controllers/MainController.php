<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use App\File;
use Request;

class MainController extends Controller
{
    public function index()
    {
        $products = Product::paginate(6);
        
        if (request('category')<>null){
        $products = Product::where('category',Request::input('category'))->paginate(6);
        }
        else if (request('name')<>null){
        $products = Product::where('name','like','%'.Request::input('name').'%')->
        orwhere('publisher','like','%'.Request::input('name').'%')->paginate(6);
        }
        return view('products.index',['products' => $products]);

    }
   
}