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
                <h3 class="card-title">Pakages</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Pakage Name</th>
                      <th>Duration</th>
                      <th>Discription</th>
                      <th>Price</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                    @if(blank($pakages))
                        <tbody id="credit_info">
                        <tr>
                            <td colspan="6" align="center">No Pakages yet!</td>
                        </tr>
                        </tbody>
                    @else
                        <tbody>
                          @foreach($pakages as $pakage)
                              @php
                                $num = 1;
                              @endphp
                            <tr>
                              <td>{{$num++}}</td>
                              <td>{{$pakage->pakage_name}}</td>
                              <td>{{$pakage->duration}}</td>
                              <td><span class="tag tag-success">{{$pakage->discription}}</span></td>
                              <td>${{$pakage->price}}</td>
                               @if(auth()->user()->usertype_id == 1)
                                <td>
                                    <a href="{{route('edit_pakage_view',$pakage->id)}}"><button class="btn btn-primary btn-sm">Edit</button></a>
                                    <a href="{{route('delete_pakage',$pakage->id)}}"><button class="btn btn-danger btn-sm">Delete</button></a>
                                </td>
                                @else
                                    <td>
                                        <a href="{{route('buy_connction_view',$pakage->id)}}"><button class="btn btn-success btn-sm">Buy Connection</button></a>
                                    </td>
                                @endif
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
