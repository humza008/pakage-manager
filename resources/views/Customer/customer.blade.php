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
    <div class="container-fluid">

        <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Customers</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Phone NO</th>
                                <th>CNIC</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            @if(blank($customers))
                                <tbody id="credit_info">
                                <tr>
                                    <td colspan="7" align="center">No Customers yet!</td>
                                </tr>
                                </tbody>
                            @else
                                <tbody>
                                @foreach($customers as $customer)
                                    @php
                                        $num = 1;
                                    @endphp
                                    <tr>
                                        <td>{{$num++}}</td>
                                        <td>{{$customer->name}}</td>
                                        <td>{{$customer->email}}</td>
                                        <td>{{$customer->address}}</td>
                                        <td>{{$customer->phone_no}}</td>
                                        <td>{{$customer->cnic}}</td>
                                        <td>
                                            <a href="{{route('connection_history',$customer->id)}}"><button class="btn btn-primary btn-sm">Connections</button></a>
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
