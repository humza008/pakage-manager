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
                    <a href="{{route('add_pakage_view')}}"><button class="btn btn-success"><i class="fab fa-usps"></i>&nbsp Add Pakage</button></a>
                </div>
            </div>
        </div>
    @endif
    <div class="container-fluid">

        <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Transactions</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pakage Name</th>
                                <th>User Name</th>
                                <th>Price</th>
                                <th>Phone NO</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            @if(blank($transation))
                                <tbody id="credit_info">
                                <tr>
                                    <td colspan="6" align="center">No Transaction yet!</td>
                                </tr>
                                </tbody>
                            @else
                                <tbody>
                                @foreach($transation as $key)
                                    @php
                                        $num = 1;
                                    @endphp
                                    <tr>
                                        <td>{{$num++}}</td>
                                        <td>{{$key->pakage->pakage_name}}</td>
                                        <td>{{$key->user->name}}</td>
                                        <td>{{$key->pakage->price}}</td>
                                        <td>{{$key->phone_no}}</td>
                                        <td>{{date('d-M-Y', strtotime($key->created_at))}}</td>
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
