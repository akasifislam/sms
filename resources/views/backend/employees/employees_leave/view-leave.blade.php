@extends('backend.layouts.master')
@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <h1>Manage Employee Leave</h1>
        <div class="row">
          <section class="col-md-12">
              <div class="card">
                  <div class="card-header">
                      <h3>Manage Employee Leave List
                        <a class="btn btn-success btn-sm float-right" href="{{ route('employees.leave.add') }} "> <i class="fa fa-plus-circle"></i> Add Employee Leave</a>
                      </h3>
                      
                  </div>
                  <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Sl</th>
                          <th>Employee Name</th>
                          <th>ID NO</th>
                          <th>Purpose</th>
                          <th>Date</th>

                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($allData as $key => $value)
                            <tr class="{{ $value->id }}">
                                <td>{{ $key+1 }}</td>
                                <td>{{ $value['user']['name']  }}</td>
                                <td>{{ $value['user']['id_no']  }}</td>
                                <td>{{ $value['purpose']['name']  }}</td>

                                <td> {{date('d-m-Y',strtotime( $value->start_date ))}} to {{date('d-m-Y',strtotime( $value->end_date ))}} </td> 
                                <td>
                                  <div class="btn-group" role="group" aria-label="Basic example">
                                      <a type="button" href="{{ route('employees.leave.edit',$value->id) }}" class="btn btn-success btn-sm"> <i class="fa fa-edit"></i> </a>
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