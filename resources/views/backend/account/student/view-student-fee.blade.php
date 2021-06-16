@extends('backend.layouts.master')
@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <h1>Mnage Student Fee</h1>
        <div class="row">
          <section class="col-md-12">
              <div class="card">
                  <div class="card-header">
                      <h3>Student Fee List
                        <a class="btn btn-success btn-sm float-right" href="{{ route('accounts.fee.add') }} "> <i class="fa fa-plus-circle"></i>Add Student Fee</a>
                      </h3>
                      
                  </div>
                  <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Sl</th>
                        <th>ID No</th>
                        <th>Name</th>
                        <th>Year</th>
                        <th>Class</th>
                        <th>Fee Type</th>
                        <th>Amount</th>
                        <th>Date</th>
                      </tr>
                      </thead>
                      <tbody>
                          @foreach ($allData as $key => $value)
                          <tr class="{{ $value->id }}">
                              <td>{{ $key+1 }}</td>
                              <td>{{ $value['student']['id_no']  }}</td>
                              <td>{{ $value['student']['name'] }}</td>
                              <td>{{ $value['year']['name'] }}</td>
                              <td>{{ $value['student_class']['name'] }}</td>
                              <td>{{ $value-['fee_category']['name'] }} </td>
                              <td>{{ $value->amount }}</td>
                              <td>{{ date('M Y',strtotime($value->date)) }}</td>
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