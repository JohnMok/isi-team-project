@extends('layouts.app')

@section('ProductList', 'Page Title')

@section('sidebar')
    @parent
@endsection

@section('content')
<div class="panel-body" >
            <form method="GET" action="/" class="form-horizontal" enctype="multipart/form-data" role="form">
                {!! csrf_field() !!}
                    <div class="col-md-3 col-md-offset-3">
                        <div class="form-group">
                        <label  for="textarea">Category</label>
                            <select name="category" onchange="this.form.submit();">
                            <option value="">Select</option>
                            <option value="Science fiction">Science fiction</option>
                            <option value="Drama">Drama</option>
                            <option value="Action and Adventure">Action and Adventure</option>
                            <option value="Romance">Romance</option>
                            <option value="Horror">Horror</option>
                            <option value="Health">Health</option>
                            <option value="Travel">Travel</option>
                            <option value="Children's">Children's</option>
                            <option value="History">History</option>
                            <option value="Comics">Comics</option>
                            <option value="Fantasy">Fantasy</option>
                            </select>
                             
                       
                        </div>
                    </div>
                    <fieldset>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="name">Book</label>
                        <div class="col-md-4">
                            <input id="name" name="name" type="text" placeholder="Book Name or Publisher" class="form-control input-md" required="">

                        </div>
                    </div>
                    </fieldset>
</div>    
    <div class="container">
        <div class="row">
            
            <div col-xs-10 col-xs-offset-1>
                @foreach ($products as $product)
                   
                    <div class="col-md-6 col-sx-3">
                        <div class="thumbnail" >
                            <a href="/product/{{$product->id}}">
                            <img src="{{asset('storage')}}/{{$product->imageurl}}" class="img-responsive" style="width: 400px; height: 200px;"> </a> 
                            <div class="caption">
                                <div class="row">
                                    <div class="col-md-6 col-xs-6">
                                        <h3>{{$product->name}}</h3>
                                    </div>
                                    <div class="col-md-6 col-xs-6 price">
                                        <h3>
                                            <label>${{$product->price}}</label></h3>
                                    </div>
                                </div>
                                <p>Publisher : {{$product->publisher}}</p>
                                <p>Category : {{$product->category}}</p>
                                <div class="row">
                                @if(auth()->id() == 1)
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="/product/{{$product->id}}" class="btn btn-success btn-product">
                                        <span class="fa fa-shopping-cart"></span> Detail</a>
                                    </div>
                                @elseif (auth()->id() <> 1)  
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="/addProduct/{{$product->id}}" class="btn btn-success btn-product">
                                        <span class="fa fa-shopping-cart"></span> Buy</a>
                                    </div>
                                @endif        
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
         <div class="col-xs-10 col-xs-offset-5">
             {{ $products->appends($_GET)->links() }}
             </div>
    </div>

@endsection