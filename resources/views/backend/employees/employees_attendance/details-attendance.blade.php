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
                      <h3>Employee Attendance Details
                        <a class="btn btn-success btn-sm float-right" href="{{ route('employees.attendance.view') }} "> <i class="fa fa-list "></i>  Employee Attendance List</a>
                      </h3>
                      
                  </div>
                  <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Sl</th>
                          <th>Employee Name</th>
                          <th>ID NO</th>
                          <th>Date</th>
                          <th>Att. Sattus</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($details as $key => $value)
                            <tr class="{{ $value->id }}">
                                <td>{{ $key+1 }}</td>
                                <td>{{ $value['user']['name']  }}</td>
                                <td>{{ $value['user']['id_no']  }}</td>
                                <td>{{ date('d-M-Y',strtotime($value->date))  }}</td>
                                <td>{{ $value->attendance_status  }}</td>
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