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
                      <h3>Asign Subject
                        <a class="btn btn-success btn-sm float-right" href="{{ route('setpus.asign.subject.view') }} "> <i class="fa fa-list"></i> Asign Subject List</a>
                      </h3>
                      
                  </div>
                  <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                          <th>Sl</th>
                          <th>Subject Name</th>
                          <th>Full Mark</th>
                          <th>Pass Mark</th>
                          <th>Subjective Mark</th>

                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($editData as $key => $value)
                            <tr class="{{ $value->id }}">
                                <td>{{ $key+1 }}</td>
                                <td>{{ $value['subject']['name']  }}</td>
                                <td>{{ $value->full_mark  }}</td>
                                <td>{{ $value->pass_mark  }}</td>
                                <td>{{ $value->subjective_mark  }}</td>
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