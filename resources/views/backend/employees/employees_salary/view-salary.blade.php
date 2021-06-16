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
                      <h3>Manage Employee Salary</h3>
                      
                  </div>
                  <div class="card-body">
                    <table id="example1" class="table table-sm table-bordered table-striped table-responsive">
                        <thead>
                        <tr>
                          <th>Sl</th>
                          <th>Employee Name</th>
                          <th>ID NO</th>
                          <th>Mobile No</th>
                          <th>Address</th>
                          <th>Gender</th>
                          <th>Salary</th>
                          <th>Join Date</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($allData as $key => $value)
                            <tr class="{{ $value->id }}">
                                <td>{{ $key+1 }}</td>
                                <td>{{ $value->name  }}</td>
                                <td>{{ $value->id_no  }}</td>
                                <td>{{ $value->mobile  }}</td>
                                <td>{{ $value->address  }}</td>
                                <td>{{ $value->gender  }}</td>
                                <td>{{ $value->salary  }}</td>
                                <td>{{ $value->join_date }}</td>
                                <td>
                                  <div class="btn-group" role="group" aria-label="Basic example">
                                      <a title="salary increment" type="button" href="{{ route('employees.salary.increment',$value->id) }}" class="btn btn-success btn-sm"> <i class="fa fa-plus-circle"></i> </a>
                                      <a title="details" type="button" target="_blank" href="{{ route('employees.salary.details',$value->id) }}" class="btn btn-primary btn-sm"> <i class="fa fa-eye"></i> </a>
                                      
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