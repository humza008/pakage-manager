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
                                <th>status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            @if(blank($connection))
                                <tbody id="credit_info">
                                <tr>
                                    <td colspan="6" align="center">No Conncetion yet!</td>
                                </tr>
                                </tbody>
                            @else
                                <tbody>
                                @foreach($connection as $key)
                                    @php
                                        $num = 1;
                                    @endphp
                                    <tr>
                                        <td>{{$num++}}</td>
                                        <td>{{$key->customer->name}}</td>
                                        <td>{{$key->pakage->pakage_name}}</td>
                                        <td>{{$key->status}}</td>
                                        <td>{{date('d-M-Y', strtotime($key->created_at))}}</td>
                                        <td>
                                            <a href="{{route('transaction_history',$key->id)}}"><button class="btn btn-primary btn-sm">Transaction</button></a>
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
