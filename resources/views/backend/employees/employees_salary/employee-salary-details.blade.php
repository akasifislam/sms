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
                      
                      <h3>   
                          Employee Salary Details Info

                        <a class="btn btn-success btn-sm float-right" href="{{ route('employees.salary.view') }} "> <i class="fa fa-list"></i> Employee List</a>
                      </h3>
                      
                  </div>
                  <div class="card-body">
                      <h1> Name: <span style="color:rgb(4, 0, 255);">{{ $details->name }}</span> </h1>
                      <table class="table table-bordered table-hover table-sm table-striped table-success">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Previous Salary</th>
                                    <th>Increment Salary</th>
                                    <th>Present Salary</th>
                                    <th>Effected Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($salary_log as $key => $salary)

                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{$salary->previous_salary}}</td>
                                    <td>{{$salary->increment_salary}}</td>
                                    <td>{{$salary->present_salary}}</td>
                                    <td>{{date('d-m-Y',strtotime($salary->effected_date))}}</td>
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