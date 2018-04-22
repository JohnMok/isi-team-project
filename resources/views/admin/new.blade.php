@extends('layouts.app')

@section('新增商品', 'Page Title')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-title">New Product</div>
        </div>
        <div class="panel-body" >
            <form method="POST" action="/admin/product/save" class="form-horizontal" enctype="multipart/form-data" role="form">
                {!! csrf_field() !!}
                <fieldset>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="name">Book</label>
                        <div class="col-md-5">
                            <input id="name" name="name" type="text" placeholder="Book Name" class="form-control input-md" required="">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="textarea">Publisher</label>
                        <div class="col-md-5">
                            <textarea class="form-control" id="textarea" name="publisher" required=""></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="textarea">Category</label>
                            <select name="category">
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
                    <div class="form-group {{ $errors->has('price') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label" for="price">Price</label>
                        <div class="col-md-5">
                            <input id="price" name="price" type="text" placeholder="Product price" class="form-control input-md" required="">
                            @if ($errors->has('price'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('price') }}</strong>
                                </span>
                            @endif       
                        </div>
                    </div>
                    
                    <div class="form-group {{ $errors->has('isbn') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label" for="isbn">ISBN</label>
                        <div class="col-md-5">
                            <input id="isbn" name="isbn" type="number" placeholder="Product ISBN" class="form-control input-md">
                             @if ($errors->has('isbn'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('isbn') }}</strong>
                                </span>
                            @endif 
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="file">Image</label>
                        <div class="col-md-5">
                            <input id="file" name="file" class="input-file" type="file">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="submit"></label>
                        <div class="col-md-5">
                            <button id="submit" name="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

                </fieldset>

            </form>
        </div>
    </div>
@endsection