<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Product;
use App\Track;
use App\TrackItem;
use App\CartItem;
use Illuminate\Support\Facades\Auth;

//use Illuminate\Http\Request;
//use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TrackController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function addItem (Request $request){
        $validatedData = $request->validate([
        'code' => 'regex:/ABC80/|nullable',
    ]);

        $track = Track::where('user_id',Auth::user()->id);

            $track =  new Track();
            $track->user_id=Auth::user()->id;
            $track->save();

        $cartItems = (auth()->user()->cartItems);
        if (request('code')<>null){
        foreach ($cartItems as $cartItem) {
            $trackItem  = new Trackitem();
            $trackItem->product_id=$cartItem->product_id;
            $trackItem->track_id= $track->id;
            $trackItem->product_price=$cartItem->product->price*=0.8;
            $trackItem->save();
            
            CartItem::destroy($cartItem->id);
            }
        }
        
        else foreach ($cartItems as $cartItem) {
                $trackItem  = new Trackitem();
                $trackItem->product_id=$cartItem->product_id;
                $trackItem->track_id= $track->id;
                $trackItem->product_price=$cartItem->product->price;
                $trackItem->save();
                
                CartItem::destroy($cartItem->id);
        }
        return redirect('/track/'.$track->id);
    }
    public function index(){
        //$track = Track::where('user_id',Auth::user()->id)->first();
        //$track = Track::where('user_id',Auth::user()->id);
        //$track = Track::all();
       //Track::where('user_id',Auth::user()->id);
        
        $orders = Track::where('user_id',Auth::user()->id)->orderBy('id', 'desc')->get();
        
        $search = request('name');
        
        if (request('name')<>null){
        $orders = Track::where('user_id',Auth::user()->id)->where('id',request('name'))->orderBy('id', 'desc')->get();
        }
        elseif (request('current') == 1) {
            $orders = Track::where('user_id',Auth::user()->id)->where('state','pending')->orwhere('user_id',Auth::user()->id)->where('state','hold')->orderBy('id', 'desc')->get();
            
        }

        elseif (request('past') == 1){
            $orders = Track::where('user_id',Auth::user()->id)->where('state','cancelled')->orwhere('user_id',Auth::user()->id)->where('state','shipped')->orderBy('id', 'desc')->get();
        
        } 
        
        //dd($search);
        //$total = 0;
        //foreach($orders as $order){
        //$total+=1;
        //}
        //dd($total);
        return view('cart.track', compact('orders','items','total','search'));
    }
    
    public function orderDetail(Track $track) {
        //$item = TrackItem::where('id',$track->id);
        //dd($item);
        $items = $track->trackItem;
        $total=0;
        foreach($items as $item){
            $total+=$item->product_price;
        }
        //$itemDetail = Product::where('id', TrackItem::product()->id);
        //$itemDetails = $track->trackItem()->product_id;
           // $itemDetails = $track->trackItem()->first()->product;
            
        //dd($itemDetails);
        //foreach($items as $item) {
        //    $itemsDetail = $items->product;
        //}
        
        //dd($items);
        return view('products.orderDetail', compact('track','items','total'));
    }
    public function masterOrder() {
        //$item = TrackItem::where('id',$track->id);
        //dd($item);
        //$orders = Track::all();
        $orders = Track::orderBy('id', 'desc')->get();
        
        if (request('name')<>null){
            $orders = Track::where('id',request('name'))->orderBy('id', 'desc')->get();
        }
        elseif (request('pending') == 1) {
            $orders = Track::where('state','pending')->orderBy('id', 'desc')->get();
            
        }
        elseif (request('hold') == 1) {
            $orders = Track::where('state','hold')->orderBy('id', 'desc')->get();
            
        }
        elseif (request('past') == 1){
            $orders = Track::where('state','cancelled')->orwhere('state','shipped')->orderBy('id', 'desc')->get();
        
        }
        // elseif (request('shipped') == 1){
         //   $orders = Track::where('state','shipped')->orderBy('id', 'desc')->get();
        
        //}        

        return view('admin.masterOrder', compact('orders','items','total'));
    }
    public function masterOrderDetail(Track $track) {
        //$item = TrackItem::where('id',$track->id);
        //dd($item);
        $items = $track->trackItem;
        $total=0;
        foreach($items as $item){
            $total+=$item->product_price;
        }
        //$itemDetail = Product::where('id', TrackItem::product()->id);
        //$itemDetails = $track->trackItem()->product_id;
           // $itemDetails = $track->trackItem()->first()->product;
            
        //dd($itemDetails);
        //foreach($items as $item) {
        //    $itemsDetail = $items->product;
        //}
        
        //dd($items);
        return view('admin.masterOrderDetail', compact('track','items','total'));
    }
    public function state (Track $track){
        $track -> state = Request('state');
        $track->save();
       return redirect()->back();
    }
    
}
