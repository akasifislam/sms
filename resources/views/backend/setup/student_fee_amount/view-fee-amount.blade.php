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
                      <h3>Student Fee Amount
                        <a class="btn btn-success btn-sm float-right" href="{{ route('setpus.fee.amount.add') }} "> <i class="fa fa-plus-circle"></i> Add Amount</a>
                      </h3>
                      
                  </div>
                  <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Sl</th>
                          <th>Fee Category</th>
                          <th>Fee</th>
                          <th>Fee</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($allData as $key => $value)
                            <tr class="{{ $value->id }}">
                                <td>{{ $key+1 }}</td>
                                <td>{{ $value['fee_category']['name']  }}</td>
                                <td>{{ $value['fee_category']['amount']  }}</td>
                                <td>{{ $value->amount  }}</td>
                                <td>
                                  <div class="btn-group" role="group" aria-label="Basic example">
                                      <a type="button" href="{{ route('setpus.fee.amount.details',$value->fee_category_id) }}" class="btn btn-primary btn-sm"> <i class="fa fa-eye"></i> </a>
                                      <a type="button" href="{{ route('setpus.fee.amount.edit',$value->fee_category_id) }}" class="btn btn-success btn-sm"> <i class="fa fa-edit"></i> </a>
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