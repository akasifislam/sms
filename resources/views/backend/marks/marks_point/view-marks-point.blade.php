@extends('backend.layouts.master')
@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <h1>Mnage Grade Point</h1>
        <div class="row">
          <section class="col-md-12">
              <div class="card">
                  <div class="card-header">
                      <h3>Grade Point List
                        <a class="btn btn-success btn-sm float-right" href="{{ route('student.grade.point.add') }} "> <i class="fa fa-plus-circle"></i>Add Grade Point</a>
                      </h3>
                      
                  </div>
                  <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Sl</th>
                        <th>Grade Name</th>
                        <th>Grade Point</th>
                        <th>Start Marks</th>
                        <th>End Marks</th>
                        <th>Point Range</th>
                        <th>Remarks</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                          @foreach ($allData as $key => $value)
                          <tr class="{{ $value->id }}">
                              <td>{{ $key+1 }}</td>
                              <td>{{ $value->grade_name  }}</td>
                              <td>{{ $value->grade_point }}</td>
                              <td>{{ $value->start_marks }}</td>
                              <td>{{ $value->end_marks }}</td>
                              <td>{{ $value->start_point }} -- {{ $value->end_point }}  </td>
                              <td>{{ $value->remarks }}</td>
                              <td>
                                <a href=" {{ route('student.grade.point.edit',$value->id) }} " class="btn-primary btn-sm" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
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