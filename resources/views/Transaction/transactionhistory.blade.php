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
                        <h3 class="card-title">Transactions History</h3>
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
                                <th>Date</th>
                            </tr>
                            </thead>
                            @if(blank($transaction))
                                <tbody id="credit_info">
                                <tr>
                                    <td colspan="6" align="center">No Transaction yet!</td>
                                </tr>
                                </tbody>
                            @else
                                <tbody>
                                @php
                                    $num = 1;
                                @endphp
                                    <tr>
                                        <td>{{$num++}}</td>
                                        <td>{{$transaction->pakage->pakage_name}}</td>
                                        <td>{{$transaction->user->name}}</td>
                                        <td>{{$transaction->pakage->price}}</td>
                                        <td>{{date('d-M-Y', strtotime($transaction->created_at))}}</td>
                                    </tr>
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
