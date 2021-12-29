@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12 mt-3">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add Connection</h3>
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
                                        <input type="text" class="form-control" name="customer_name" id="exampleInputEmail1" placeholder="Enter Customer Name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Email</label>
                                        <input type="email" class="form-control" name="email" id="exampleInputPassword1" placeholder="example@gmail.com" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Address</label>
                                        <input type="text" class="form-control" name="address" id="exampleInputPassword1" placeholder="Enter Address" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Phone No</label>
                                        <input type="number" class="form-control" name="phone_no" id="exampleInputPassword1" placeholder="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">CNIC</label>
                                        <input type="text" class="form-control" name="cnic" id="exampleInputPassword1" placeholder="" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Status</label>
                                        <select name="status" id="" class="form-control">
                                            <option value="" selected disabled>Select Status</option>
                                            <option value="paid">Paid</option>
                                            <option value="unpaid">Unpaid</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Pakages</label>
                                        <select name="pakage" id="pakage" class="form-control">
                                            <option value="" selected disabled>Select Pakage</option>
                                            @foreach($pakages as $pakage)
                                                <option value="{{$pakage->id}}">{{$pakage->pakage_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row  info">
                                        <input type="hidden" name="pakage_price" value="" id="pakage_price">
                                        <dt class="col-md-3 col-5 fw-normal">Pakage Name :</dt>
                                        <dd class="col-md-9 col-7 text-muted pakage_name">admin</dd>

                                        <dt class="col-md-3 col-5 fw-normal">Duration :</dt>
                                        <dd class="col-md-9 col-7 text-muted pakage_duration">
                                            <p class="mb-0">1962 Pike Street,</p>
                                        </dd>

                                        <dt class="col-md-3 col-5 fw-normal">Price :</dt>
                                        <dd class="col-md-9 col-7 text-muted pakage_price">$300</dd>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Add Connection</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('page_scripts')
    <script>
        $('.info').hide();
        $("#pakage").on('change',function (){
            var pakage_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "{{ route('get-pakage') }}",
                data: {
                    pakage_id: pakage_id,
                },
                success: function (result) {
                    if(result.status == 'yes'){
                        $('.pakage_name').text(result.data.pakage_name);
                        $('.pakage_duration').text(result.data.duration);
                        $('.pakage_price').text('$'+result.data.price);
                        $('#pakage_price').val(result.data.price);
                        $('.info').show();
                    }

                },

            });

        });
    </script>
@endpush

