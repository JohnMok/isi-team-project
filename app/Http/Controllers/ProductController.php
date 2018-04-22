<?php

namespace App\Http\Controllers;

use App\Product;
use App\Rating;
use App\Track;
use App\TrackItem;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
//use Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{

    public function index(){
        $products = Product::all();
        if (request('name')<>null)
        $products = Product::where('name','like','%'.Request('name').'%')->orwhere('id',Request('name'))->get();
        return view('admin.products',compact('products','search'));
    }


    public function destroy($id){
        Product::destroy($id);
        return redirect('/admin/products');
    }

    public function newProduct(){
        return view('admin.new');
    }

    public function add(Request $request) {
        $validatedData = $request->validate([
        'price' => 'numeric',
        'isbn' => 'max:10',
    ]);
        $file = Request('file');
        $extension = $file->getClientOriginalExtension();
        Storage::disk('public')->put($file->getClientOriginalName(),  File::get($file));

        $entry = new \App\File();
        $entry->mime = $file->getClientMimeType();
        $entry->original_filename = $file->getClientOriginalName();
        $entry->filename = $file->getClientOriginalName().'.'.$extension;

        $entry->save();

        $product  = new Product();
        $product->file_id=$entry->id;
        $product->name =Request('name');
        $product->publisher =Request('publisher');
        $product->category =Request('category');
        $product->price =Request('price');
        $product->isbn =Request('isbn');
        $product->imageurl =$file->getClientOriginalName();

        $product->save();

        return redirect('/admin/products');

    }
    public function productDetail(Product $product) {
        
        $ratings = $product->ratings;
        $avg = Rating::where('product_id',$product->id)->avg('star');
        
        $haves = Track::where('user_id',Auth::user()->id)->get();
        $canRate=0;
        //foreach($haves as $have){
            //if ($have->trackItem->product_id == $product->id && $have->state== shipped){
              //  $canRate=1;
           // }
        //}
        
        return view('products.detail', compact('product','ratings','avg','canRate','haves'));
    }
     public function query()
    {
        //$products = Product::all();
       // $pro->category =Request::input('category');
        //$search = Request::input('category');
       
        $products = Product::where('category',Request('category'))->paginate(6);
        
        
        //dd($products);
        
        return view('products.query', compact('products','search'));
        //$product->category =Request::input('category');
        //$track = Track::where('user_id',Auth::user()->id);
        // return redirect('/query');
         //return view('products.query', compact('products'));

    }
    public function comment (Product $product){
        $comment = Rating::where('user_id',Auth::user()->id)->where('product_id',$product->id)->first();

        if(!$comment){
            $comment =  new Rating();
            $comment->user_id=Auth::user()->id;
            $comment->product_id=$product->id;
            $comment->message=request('comment');
            $comment->star=request('star');
            $comment->save();
        }

        $comment->message=request('comment');
        $comment->star=request('star');
        $comment->save();

        return redirect('/product/'.$product->id);
    }
}