@extends('backend.layouts.master')
@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <h1>Manage Employee Attendance</h1>
        <div class="row">
          <section class="col-md-12">
              <div class="card">
                  <div class="card-header">
                      <h3>Employee Attendance List
                        <a class="btn btn-success btn-sm float-right" href="{{ route('employees.attendance.add') }} "> <i class="fa fa-plus-circle"></i>Add Employee Attendance</a>
                      </h3>
                      
                  </div>
                  <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Sl</th>
                        <th>Date</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                          @foreach ($allData as $key => $value)
                          <tr class="{{ $value->id }}">
                              <td>{{ $key+1 }}</td>
                              <td>{{ date('d-M-Y',strtotime($value->date))  }}</td>
                              <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a title="edit" type="button" href="{{ route('employees.attendance.edit',$value->date) }}" class="btn btn-success btn-sm"> <i class="fa fa-edit"></i> </a>
                                    <a title="view" type="button" href="{{ route('employees.attendance.details',$value->date) }}" class="btn btn-primary btn-sm"> <i class="fa fa-eye"></i> </a>
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