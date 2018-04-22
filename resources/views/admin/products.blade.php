@extends('layouts.app')

@section('商店后台', 'Page Title')

@section('sidebar')
    @parent
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a href="/admin/product/new"><button class="btn btn-success">new product</button></a>
                <a href="/admin/products"><button class="btn " name="state" value="pending">All</button></a>
            </div>
            <div class="panel-body" >
                <form method="GET" action="/admin/products" class="form-horizontal" enctype="multipart/form-data" role="form">
                {!! csrf_field() !!}
                    <fieldset>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="name">Book</label>
                        <div class="col-md-5">
                            <input id="name" name="name" type="text" placeholder="Book Name or ID" class="form-control input-md" required="">

                        </div>
                    </div>
                    </fieldset>
            </div> 
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                    <td>ID</td>    
                    <td>Picture</td>
                    <td>Name</td>
                    <td>Price</td>
                    <td>File</td>
                    <td>Operation</td>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td><a href="/product/{{$product->id}}"><img src="{{asset('storage')}}/{{$product->imageurl}}" class="img-responsive" style="width: 120px; height: 80px;"></a></td>
                            <td>{{$product->name}}</td>
                            <td>${{$product->price}}</td>
                            <td>{{$product->file->original_filename}}</td>
                            <td><a href="/admin/product/destroy/{{$product->id}}"><button class="btn btn-danger">Delete</button></a> </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection