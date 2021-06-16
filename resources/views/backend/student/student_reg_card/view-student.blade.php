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
                      <h3> Student List
                        <a class="btn btn-success btn-sm float-right" href="{{ route('students.reg.add') }} "> <i class="fa fa-plus-circle"></i> Add student</a>
                      </h3>
                      
                  </div>
                  <div class="card-body">
                    @if(!@search)
                    <form action="{{ route('students.year.class.wise') }}" method="GET" id="myForm">
                      <div class="form-row">
                        <div class="form-group col-md-4">
                          <label for="address">Select Year<font style="color:red">*</font></label>
                          <select name="year_id" id="year_id" class="form-control form-control-sm">
                              <option value="">---select---</option>
                             @foreach ($years as $year)
                             <option value="{{ $year->id }}" {{ (@$year_id==$year->id)? "selected":"" }}>{{ $year->name }}</option>
                             @endforeach
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="address">Select Class<font style="color:red">*</font></label>
                          <select name="class_id" id="class_id" class="form-control form-control-sm">
                              <option value="">---select---</option>
                             @foreach ($classes as $class)
                             <option value="{{ $class->id }}"{{ (@$class_id==$class->id)? "selected":"" }}>{{ $class->name }}</option>
                             @endforeach
                          </select>
                        </div>
                        <div class="form-group col-md-4" style="padding-top: 31px;">
                          <button type="submit" name="search" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
                        </div>
                      </div>
                    </form>
                    @else
                    <form action="{{ route('students.year.class.wise') }}" method="GET" id="myForm">
                      <div class="form-row">
                        <div class="form-group col-md-4">
                          <label for="address">Select Year<font style="color:red">*</font></label>
                          <select name="year_id" id="year_id" class="form-control form-control-sm">
                              <option value="">---select---</option>
                             @foreach ($years as $year)
                             <option value="{{ $year->id }}" {{ (@$year_id==$year->id)? "selected":"" }}>{{ $year->name }}</option>
                             @endforeach
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="address">Select Class<font style="color:red">*</font></label>
                          <select name="class_id" id="class_id" class="form-control form-control-sm">
                              <option value="">---select---</option>
                             @foreach ($classes as $class)
                             <option value="{{ $class->id }}"{{ (@$class_id==$class->id)? "selected":"" }}>{{ $class->name }}</option>
                             @endforeach
                          </select>
                        </div>
                        <div class="form-group col-md-4" style="padding-top: 31px;">
                          <button type="submit" name="search" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> search </button>
                        </div>
                      </div>
                    </form>
                    @endif
                  </div>
                  <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th width="7%">Sl</th>
                          <th>Name</th>
                          <th>ID NO</th>
                          <th>Roll</th>
                          <th>Year</th>
                          <th>Class</th>
                          @if(Auth::user()->role=="Admin")
                          <th>Code</th>
                          @endif
                          <th>Image</th>
                          <th width="12%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($allData as $key => $value)
                            <tr class="{{ $value->id }}">
                                <td>{{ $key+1 }}</td>
                                <td>{{ $value['student']['name']  }}</td>
                                <td>{{ $value['student']['id_no']  }}</td>
                                <td>{{ $value->roll  }}</td>
                                <td>{{ $value['year']['name']  }}</td>
                                <td>{{ $value['student_class']['name']  }}</td>
                                @if(Auth::user()->role=="Admin")
                                <td>{{ $value['student']['code'] }}</td>
                                @endif
                                <td>
                                      <img src="{{ (!empty($value['student']['image'])) ? url('/upload/student_images/'.$value['student']['image']):url('/upload/default/default.png') }}" style=" width: 60px; height: 60px; border:1px solid #000;" alt="">
                                  
                                </td>
                                <td>
                                  <div class="btn-group" role="group" aria-label="Basic example">
                                      <a type="button" href="{{ route('students.reg.edit',$value->student_id) }}" class="btn btn-success btn-sm"> <i class="fa fa-edit"></i> </a>
                                      <a title="promotion" type="button" href="{{ route('students.reg.promotion',$value->student_id) }}" class="btn btn-primary btn-sm"> <i class="fa fa-check"></i> </a>
                                      <a target="_balank" title="details" type="button" href="{{ route('students.reg.details',$value->student_id) }}" class="btn btn-primary btn-sm"> <i class="fa fa-eye"></i> </a>
                                      
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

    <script type="text/javascript">
      $(document).ready(function () {
          $('#myForm').validate({
          rules: {
             
             
              class_id: {
              required: true,
              },
              year_id: {
              required: true,
              },
          },
          messages: {
            
              name: {
              required: "Please enter name",
              },
          },
          errorElement: 'span',
          errorPlacement: function (error, element) {
              error.addClass('invalid-feedback');
              element.closest('.form-group').append(error);
          },
          highlight: function (element, errorClass, validClass) {
              $(element).addClass('is-invalid');
          },
          unhighlight: function (element, errorClass, validClass) {
              $(element).removeClass('is-invalid');
          }
          });
      });
  </script>
@endsection