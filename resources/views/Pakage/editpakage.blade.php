@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12 mt-3">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Pakage</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('update_pakage',$pakage->id)}}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Pakage name</label>
                                        <input type="text" class="form-control" value="{{$pakage->pakage_name}}" name="pakage_name" id="exampleInputEmail1" placeholder="Enter Pakage Name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Duration</label>
                                        <input type="text" class="form-control" value="{{$pakage->duration}}" name="duration" id="exampleInputPassword1" placeholder="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Dicription</label>
                                        <input type="text" class="form-control" value="{{$pakage->discription}}" name="discription" id="exampleInputPassword1" placeholder="Discription" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Price</label>
                                        <input type="number" class="form-control" value="{{$pakage->price}}" name="price" id="exampleInputPassword1" placeholder="$ 0.00" required>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
