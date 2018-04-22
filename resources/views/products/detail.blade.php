@extends('layouts.app')

@section('ProductList', 'Page Title')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="container">
        <div class="row">
            
            <div class="col-xs-10 col-xs-offset-1">
                   

                        <div class="thumbnail" >
                            <img src="{{asset('storage')}}/{{$product->imageurl}}" class="img-responsive" style="width: 800px; height: 400px;border-radius:30px;">
                            <div class="caption">
                                <div class="row">
                                    <div class="col-md-2 col-md-offset-2">
                                        <h1>{{$product->name}}</h1>
                                    </div>
                                    <div class="col-md-3 col-md-offset-4 price">
                                        <h1>
                                            <label>${{$product->price}}</label></h1>
                                    </div>
                                </div>
                                <p style="text-align: center;font-size:2em;">Publisher : {{$product->publisher}}</p>
                                <p style="text-align: center;font-size:2em;">Category : {{$product->category}}</p>
                                <p>ISBN : {{$product->isbn}}</p>
                                <p>Average Rating : @if($avg == 5)
                                            {{$avg}}&#9733; &#9733; &#9733; &#9733; &#9733;
                                              @else
                                              @if($avg >= 4)
                                                {{$avg}}&#9733; &#9733; &#9733; &#9733; &#9734;
                                                @else
                                                  @if($avg >= 3)
                                                  {{$avg}}&#9733; &#9733; &#9733; &#9734; &#9734;
                                                  @else
                                                    @if($avg >= 2)
                                                    {{$avg}}&#9733; &#9733;  &#9734;  &#9734;  &#9734;
                                                    @else
                                                      @if($avg >= 1)
                                                      {{$avg}}&#9733; &#9734; &#9734; &#9734; &#9734;
                                                      @else
                                                          @if($avg == null)
                                                          This Books not rated yet
                                                        @endif
                                                      @endif
                                                    @endif
                                                  @endif
                                              @endif
                                            @endif
                                </p>
                                <div class="row">
                               @if(auth()->id() == 1)
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="/" class="btn btn-success btn-product">
                                        <span class="fa fa-shopping-cart"></span> Go Back</a>
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
                    @foreach($haves as $have)
                        @php
                            $goods = $have->trackItem;
                        @endphp
                     
                    @foreach($goods as $good)
                        @if($good->product_id == $product->id && $have->state == "shipped")
                            @php 
                                $canRate = 1;
                            @endphp
                        @endif
                    @endforeach
                    @endforeach
                        @if ($canRate == 1)
                        <div class="panel-body" >
                            <form method="POST" action="/product/rating/{{$product->id}}" 
                            class="form-horizontal" enctype="multipart/form-data" role="form">
                            {!! csrf_field() !!}
                            <fieldset>
                            <div >
                            <div class="form-group">
                                <label class=" control-label" for="textarea">Rating</label>
                                <select name="star"  >
                                <option value="1">1 Star</option>
                                <option value="2">2 Star</option>
                                <option value="3">3 Star</option>
                                <option value="4">4 Star</option>
                                <option value="5">5 Star</option>
                                </select>
                            </div>
                            </div>
                            <div class="form-group">
                                <label  for="comment">Comment</label>
                                <div >
                            <textarea class="form-control" id="comment" name="comment"  type="text" placeholder="Leave your comment"  required=""></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-10 control-label" for="submit"></label>
                                    <div >
                                <button id="submit" name="submit" class="btn btn-primary">Submit</button>
                                </div>
                                </div>
                                  
                            </fieldset>
                            </form>
                       
                    </div>
                    <div style="font-size:30px;border-top: 3px solid blue;">Others Comment</div>
                        <div style="border: 2px solid red; padding: 10px; border-top-left-radius: 25px;">
                            @foreach($ratings as $rating)
                            
                            <div style="font-size:20px">{{$rating->user->name}} : <span style="font-size:20px">{{$rating->message}}</span></div>
                                
                            @endforeach
                        </div>
                    </div>
                   @endif

            </div>
        </div>
         <div class="col-xs-10 col-xs-offset-5">

             </div>
    </div>

@endsection