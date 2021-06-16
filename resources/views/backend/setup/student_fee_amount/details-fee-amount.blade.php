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
                      <h3>Student Amount Details
                        <a class="btn btn-success btn-sm float-right" href="{{ route('setpus.fee.amount.view') }} "> <i class="fa fa-list"></i> Fee Amount List</a>
                      </h3>
                      
                  </div>
                  <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Sl</th>
                          <th>Class</th>
                          <th>Amount</th>

                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($editData as $key => $value)
                            <tr class="{{ $value->id }}">
                                <td>{{ $key+1 }}</td>
                                <td>{{ $value['student_class']['name']  }}</td>
                                <td>{{ $value->amount  }}</td>
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