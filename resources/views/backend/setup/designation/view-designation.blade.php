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
                      <h3>Class List
                        <a class="btn btn-success btn-sm float-right" href="{{ route('setpus.designation.add') }} "> <i class="fa fa-plus-circle"></i> Add student Year</a>
                      </h3>
                      
                  </div>
                  <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Sl</th>
                          <th>Student Year</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($allData as $key => $value)
                            <tr class="{{ $value->id }}">
                                <td>{{ $key+1 }}</td>
                                <td>{{ $value->name  }}</td>
                                <td>
                                  <div class="btn-group" role="group" aria-label="Basic example">
                                      <a type="button" href="{{ route('setpus.designation.edit',$value->id) }}" class="btn btn-success btn-sm"> <i class="fa fa-edit"></i> </a>
                                      
                                      {{-- <a type="button" id="delete" href="{{ route('setpus.student.class.delete',$value->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a> --}}
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