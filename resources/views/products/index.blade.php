@extends('layouts.app')

@section('styles.header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/css/jquery.dataTables.min.css">
@endsection

@section('content')

    <div class="row" >
        <div class = "col-xs-10 col-xs-offset-1">
            <div class ="page-header">
                <h1>Product List</h1>
                <table id="table" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    </table>
            </div>
        </div>
           
    </div>
@endsection

@section('scripts.footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/js/jquery.dataTables.min.js"></script>
    <script>
    $(function() {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/products',
                columns:[
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'price'},
                    ]
                });
            });
    </script>
@endsection