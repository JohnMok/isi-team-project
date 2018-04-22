@extends('layouts.app')

@section('商店后台', 'Page Title')

@section('sidebar')
    @parent
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                    <a href="/track"><button class="btn " name="state" value="pending">All</button></a>
                    <a href="/track?current=1"><button class="btn btn-success" name="state" value="pending">Current Purchases</button></a>
                    <a href="/track?past=1"><button class="btn btn-info" name="state" value="cancelled">Past Purchases</button></a>
                </div>  
                <div class="panel-body" >
                <form method="GET" action="/track" class="form-horizontal" enctype="multipart/form-data" role="form">
                {!! csrf_field() !!}
                    <fieldset>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="name">Search</label>
                        <div class="col-md-5">
                            <input id="name" name="name" type="text" placeholder="Order ID" class="form-control input-md" required="">

                        </div>
                    </div>
                    </fieldset>
            </div>
            </div>
       
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>

                            <td>PNO</td>
                            <td>Create Date</td>
                            <td>Customer Name</td>
                            <td>State</td>
                            <td>Total Price</td>
                            <td>Shipment Date</td>
                            <td>Operation</td>
                   
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            @php
                                $items = $order->trackItem;
                                $total = 0;
                            @endphp
                            <tr>
                                <td>
                                     @foreach($items as $item)
                                        @php
                                            $total+=$item->product_price;
                                        @endphp
                                    @endforeach
                                    PO-{{$order->id}}
                                </td>
                                <td>{{$order->created_at}}</td>
                                
                                <td>{{$order->user->name}}</td>
                                <td>{{$order->state}}</td>
                                <td>${{$total}}</td>
                                <td>
                                @if ($order->state == 'shipped')
                                    {{$order->updated_at}}
                                @else Not Shipped
                                @endif 
                                </td>
                                
                                <td><a href="/track/{{$order->id}}"><button class="btn btn-primary">Detail</button></a> </td>
                                <td>
                                   
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection