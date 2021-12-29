@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12 mt-3">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Connection Detail</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('store_connection')}}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Customer name</label>
                                        <input type="text" readonly value="{{$connection->customer->name}}" class="form-control" name="customer_name" id="exampleInputEmail1" placeholder="Enter Customer Name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Email</label>
                                        <input type="email" readonly value="{{$connection->customer->email}}" class="form-control" name="email" id="exampleInputPassword1" placeholder="example@gmail.com" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Address</label>
                                        <input type="text" readonly value="{{$connection->customer->address}}" class="form-control" name="address" id="exampleInputPassword1" placeholder="Enter Address" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Phone No</label>
                                        <input type="number" readonly value="{{$connection->customer->phone_no}}" class="form-control" name="phone_no" id="exampleInputPassword1" placeholder="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">CNIC</label>
                                        <input type="text" readonly value="{{$connection->customer->cnic}}" class="form-control" name="cnic" id="exampleInputPassword1" placeholder="" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Status</label>
                                        <select name="status" {{ ($connection->status == 'paid') ? 'disabled' : ''}} id="status" class="form-control">
                                            <option value="" selected disabled>Select Status</option>
                                            <option value="paid" {{ $connection->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                            <option value="unpaid" {{ $connection->status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
{{--                                <div class="col-md-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="exampleInputPassword1">Pakages</label>--}}
{{--                                        <select name="pakage" id="pakage" class="form-control">--}}
{{--                                            <option value="" selected disabled>Select Pakage</option>--}}
{{--                                            @foreach($pakages as $pakage)--}}
{{--                                                <option value="{{$pakage->id}}">{{$pakage->pakage_name}}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row  info">
                                        <input type="hidden" name="pakage_price" value="" id="pakage_price">
                                        <input type="hidden" name="customer_id" id="customer_id" value="{{$connection->customer->id}}">
                                        <input type="hidden" name="pakage_id" value="{{$connection->pakage->id}}" id="pakage_id">
                                        <input type="hidden" name="connect_id" value="{{$connection->id}}" id="connect_id">
                                        <input type="hidden" id="price" value="{{$connection->pakage->price}}">
                                        <dt class="col-md-3 col-5 fw-normal">Pakage Name :</dt>
                                        <dd class="col-md-9 col-7 text-muted pakage_name">{{$connection->pakage->pakage_name}}</dd>

                                        <dt class="col-md-3 col-5 fw-normal">Duration :</dt>
                                        <dd class="col-md-9 col-7 text-muted pakage_duration">
                                            <p class="mb-0">{{$connection->pakage->duration}}</p>
                                        </dd>

                                        <dt class="col-md-3 col-5 fw-normal">Price :</dt>
                                        <dd class="col-md-9 col-7 text-muted pakage_price">${{$connection->pakage->price}}</dd>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
{{--                            <button type="submit" class="btn btn-primary">Add Connection</button>--}}
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('page_scripts')
    <script>
        $("#status").on('change',function (){
            var staus = $(this).val();
            var customer_id = $('#customer_id').val();
            var pakage_id = $('#pakage_id').val();
            var connect_id = $('#connect_id').val();
            var pakage_price = $('#price').val();
            alert(pakage_price);
            $.ajax({
                type: "GET",
                url: "{{ route('transaction_generate') }}",
                data: {
                    staus: staus,
                    customer_id:customer_id,
                    pakage_id:pakage_id,
                    connect_id:connect_id,
                    pakage_price:pakage_price,
                },
                success: function (result) {
                    if(result.status == 'yes'){
                        window.location.reload();
                    }

                },

            });

        });
    </script>
@endpush

