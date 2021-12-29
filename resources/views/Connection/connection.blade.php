@extends('layouts.app')

@section('content')
    @if(Session::has('message'))
        <script>
            toastr.success("{{ Session::get('message') }}");
        </script>
    @endif
    @if(Session::has('error'))
        <script>
            toastr.error("{{ Session::get('error') }}");
        </script>
    @endif
    @if(auth()->user()->usertype_id == 1)
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-3" align="right">
                    <a href="{{route('add_connection')}}"><button class="btn btn-success"><i class="fab fa-usps"></i>&nbsp Add Connection</button></a>
                </div>
            </div>
        </div>
    @endif
    <div class="container-fluid">

        <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Connections</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Customer Name</th>
                                <th>Pakage Name</th>
                                <th>Price</th>
                                <th>staus</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            @if(blank($connection))
                                <tbody id="credit_info">
                                <tr>
                                    <td colspan="7" align="center">No Connections yet!</td>
                                </tr>
                                </tbody>
                            @else
                                <tbody>
                                @foreach($connection as $connect)
                                    @php
                                        $num = 1;
                                    @endphp
                                    <tr>
                                        <td>{{$num++}}</td>
                                        <td>{{$connect->customer->name}}</td>
                                        <td>{{$connect->pakage->pakage_name}}</td>
                                        <td>${{$connect->pakage->price}}</td>
                                        <td>{{$connect->status}}</td>
                                        <td>{{date('d-M-Y', strtotime($connect->created_at))}}</td>
                                        <td>
                                            <a href="{{route('connection_detail',$connect->id)}}"><button class="btn btn-primary btn-sm">View</button></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            @endif

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
