@extends('backend.layouts.master')
@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <section class="col-md-12">
              <div class="card">
                  <div class="card-header">
                      <h3>User List
                        <a class="btn btn-success btn-sm float-right" href="{{ route('users.add') }} "> <i class="fa fa-plus-circle"></i> Add</a>
                      </h3>
                      
                  </div>
                  <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Sl</th>
                          <th>Name</th>
                          <th>Role</th>
                          <th>Email</th>
                          <th>Code</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($allData as $key => $user)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $user->name  }}</td>
                                <td>{{  $user->role   }}</td>
                                <td>{{ $user->email  }}</td>
                                <td>{{  $user->code   }}</td>
                                <td>
                                  <div class="btn-group" role="group" aria-label="Basic example">
                                      <a type="button" href="{{ route('users.edit',$user->id) }}" class="btn btn-success btn-sm"> <i class="fa fa-edit"></i> </a>
                                      <a type="button" id="delete" href="{{ route('users.delete',$user->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                  </div>
                                </td>
                              </tr>
                                
                            @endforeach
                            
                            
                        </tbody>
                    </table>
                  </div>
              </div>


          </section>
        </div>
        <!-- /.row -->
        <!-- Main row -->
       
    </section>
    <!-- /.content -->
@endsection