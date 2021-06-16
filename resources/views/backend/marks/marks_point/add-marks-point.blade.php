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
                          @if(isset($editData))
                          Edit Grade Point
                          @else
                          Add  Grade Point
                          @endif

                        <a class="btn btn-success btn-sm float-right" href="{{ route('student.grade.point.view') }} "> <i class="fa fa-list"></i> Grade Point List</a>
                      </h3>
                      
                  </div>
                  <form method="POST" action="{{ (@$editData)? route('student.grade.point.update',$editData->id):route('student.grade.point.store') }}" id="myForm">
                      @csrf
                      <div class="card-body">
                          <div class="form-row">
                             
                              <div class="form-group col-md-4">
                                  <label for="">Grade Point</label>
                                  <input type="text" name="grade_name" value="{{ @$editData->grade_name }}"   class="form-control">
                              </div>
                              <div class="form-group col-md-4">
                                  <label for="">Grade Point</label>
                                  <input type="text" name="grade_point" value="{{ @$editData->grade_point }}"   class="form-control">
                              </div>
                              <div class="form-group col-md-4">
                                  <label for="">Start Marks</label>
                                  <input type="text" name="start_marks" value="{{ @$editData->start_marks }}"  class="form-control">
                              </div>
                              <div class="form-group col-md-4">
                                  <label for="">End Marks</label>
                                  <input type="text" name="end_marks" value="{{ @$editData->end_marks }}"  class="form-control">
                              </div>
                              <div class="form-group col-md-4">
                                  <label for="">Start Point</label>
                                  <input type="text" name="start_point" value="{{ @$editData->start_point }}"  class="form-control">
                              </div>
                              <div class="form-group col-md-4">
                                  <label for="">End Point</label>
                                  <input type="text" name="end_point" value="{{ @$editData->end_point }}"  class="form-control">
                              </div>
                              <div class="form-group col-md-4">
                                  <label for="">Remarks</label>
                                  <input type="text" name="remarks" value="{{ @$editData->remarks }}"  class="form-control">
                              </div>
                              <div class="col-md-12">
                                  <button type="submit" class="btn btn-sm btn-success"> {{ (@$editData) ? 'Update': 'Submit' }} </button>
                              </div>
                          </div>
                      </div>


                  </form>
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
               
                grade_name: {
                required: true,
                },
                grade_point: {
                required: true,
                },
                start_marks: {
                required: true,
                },
                end_marks: {
                required: true,
                },
                start_point: {
                required: true,
                },
                end_point: {
                required: true,
                },
                remarks: {
                required: true,
                },
            },
            messages: {
              
                date: {
                required: "স্যার ডেট টা সিলেক্ট করে দিন দয়াকরে...",
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