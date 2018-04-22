@extends('layouts.app')

@section('购物车', 'Page Title')

@section('sidebar')
    @parent
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <div class="col-md-2 " style="font-size:30px"><strong>Order Info</strong></div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>PO.No</th>
                    <th>Purchases Date</th>
                    <th>Shipment Date</th>
                    <th>Customer Name</th>
                    <th>Status</th>
                    <th>Shipping Address</th>
                    @if ($track->state == 'cancelled')
                        <th>Cancelled by</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="color:blue"><strong>PO-{{$track->id}}</strong></td>
                        <td style="color:blue"><strong>{{$track->created_at}}</strong></td>
                        <td style="color:blue">
                            <strong>
                            @if ($track->state == 'shipped')
                                {{$track->updated_at}}
                            @else Not Shipped
                            @endif 
                            </strong>
                        </td>
                        <td style="color:blue"><strong>{{$track->user->name}}</strong></td>
                        <td style="color:blue"><strong>{{$track->state}}</strong></td>
                        <td style="color:blue"><strong>{{$track->user->address}}</strong></td>
                        @if ($track->state == 'cancelled')
                        <td style="color:blue"><strong>Vendor</strong></td>
                        @endif
                    </tr>
                </tbody>
            <table class="table table-hover">
                
                <thead>
                <tr>
                    <th>Products</th>
                    <th></th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Price</th>
                    <th>Subtotal</th>
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
                        <td class="col-sm-1 col-md-1" style="text-align: center"> </td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>1</strong></td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>${{$item->product_price}}</strong></td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>${{$item->product_price}}</strong></td>
                        
                    </tr>
                @endforeach

                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td><h3>Total</h3></td>
                    <td class="text-right"><h3><strong>${{$total}}</strong></h3></td>
                </tr>
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td></td>
                    <td>
                        <a href="/track"> <button type="button" class="btn btn-default">
                                <span class="fa fa-shopping-cart"></span> Go Back
                            </button>
                        </a></td>
                    
                </tbody>
            </table>
        </div>
    </div>
@endsection
