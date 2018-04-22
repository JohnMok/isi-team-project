@extends('layouts.app')

@section('shopping_cart', 'Page Title')

@section('sidebar')
    @parent
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <a href="/"> <button type="button" class="btn btn-primary">
                                <span class="fa fa-shopping-cart"></span> Continous Purchase
                            </button>
                        </a>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Products</th>
                    <th></th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Price</th>
                    <th> </th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td class="col-sm-8 col-md-6">
                            <div class="media">
                                <a class="thumbnail pull-left" href="/product/{{$item->product_id}}"> <img class="media-object" src="{{asset('storage')}}/{{$item->product->imageurl}}" style="width: 100px; height: 72px;"> </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="/product/{{$item->product_id}}">{{$item->product->name}}</a></h4>
                                </div>
                            </div></td>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                        </td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>1</strong></td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>${{$item->product->price}}</strong></td>
                        <td class="col-sm-1 col-md-1">
                            <a href="/removeItem/{{$item->id}}"> <button type="button" class="btn btn-danger">
                                    <span class="fa fa-remove"></span> Delete
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach

                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td><h3>Total</h3></td>
                    <td><h3><strong>${{$total}}</strong></h3></td>
                </tr>
                </tbody>
            </table>
                    <form action="/track" method="POST" >
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                             
                                <div class="col-md-2 col-md-offset-9">
                                    <strong>Coupon:</strong>
                                    <input id="code" name="code" type="text" placeholder="Coupon Code" 
                                    class="form-control input-md" >
                                    @if ($errors->has('code'))
                                    <span class="help-block">
                                        <strong>Your coupon code is wrong</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                        <button type="submit" class="btn btn-success">
                            Pay <span class="fa fa-play"></span>
                        </button>
                            </form>
        </div>
    </div>

@endsection
