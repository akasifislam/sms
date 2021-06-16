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
                      <h3> Manage roll generate
                       
                      </h3>
                      
                  </div>
                  <div class="card-body">
                    <form action="{{ route('students.roll.store') }}" method="POST" id="myForm">
                        @csrf
                        <div class="form-row">
                          <div class="form-group col-md-4">
                            <label for="address">Select Year<font style="color:red">*</font></label>
                            <select name="year_id" id="year_id" class="form-control form-control-sm">
                                <option value="">---select---</option>
                               @foreach ($years as $year)
                               <option value="{{ $year->id }}" >{{ $year->name }}</option>
                               @endforeach
                            </select>
                          </div>
                          <div class="form-group col-md-4">
                            <label for="address">Select Class<font style="color:red">*</font></label>
                            <select name="class_id" id="class_id" class="form-control form-control-sm">
                                <option value="">---select---</option>
                               @foreach ($classes as $class)
                               <option value="{{ $class->id }}">{{ $class->name }}</option>
                               @endforeach
                            </select>
                          </div>
                          <div class="form-group col-md-4" style="padding-top: 31px;">
                            <a id="search" name="search" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> search </a>
                          </div>
                        </div>
                        <br>
                        <hr>
                        <div class="row d-none" id="roll-generate">
                            <div class="col-md-12">
                                <table class="table table-bordered table-striped dt-responsive" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>ID NO</th>
                                            <th>Student Name</th>
                                            <th>Father Name</th>
                                            <th>Roll NO</th>
                                        </tr>
                                    </thead>
                                    <tbody id="roll-generate-tr">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-secondary btn-sm">roll generate</button>
                      </form>
                  </div>
                  {{--  carde body close   --}}
              </div>


          </section>
        </div>
        <!-- /.row -->
        <!-- Main row -->
       
    </section>
    <!-- /.content -->

    <script type="text/javascript">
        $(document).on('click','#search',function(){
            var year_id = $('#year_id').val();
            var class_id = $('#class_id').val();
            $('.notifyjs-corner').html('');

            if(year_id==''){
                $.notify("year required",{globalPosition: 'top right',className: 'error'});
                return false;
            }
            if(class_id==''){
                $.notify("year required",{globalPosition: 'top right',className: 'error'});
                return false;
            }
            $.ajax({
                url: "{{ route('students.roll.get-student') }}",
                type: "GET",
                data: { 'year_id': year_id, 'class_id': class_id},
                success: function(data) {
                    $('#roll-generate').removeClass('d-none');
                    var html = '';
                    $.each( data,function(key,v){
                        html +=
                        '<tr>'+
                        '<td>'+ v.student.id_no+'<input type="hidden" name="student_id[]" value="'+v.student_id+'"></td>'+
                        '<td>'+ v.student.name + '</td>'+
                        '<td>'+ v.student.fname + '</td>'+
                        '<td> <input type="text" class="form-control form-control-sm" required name="roll[]" value="'+v.roll+'"></td>'+
                        '</td>'+
                        '</tr>';
                    });
                    html = $('#roll-generate-tr').html(html);
                }
            });
        });
    
    </script>

    <script type="text/javascript">
      $(document).ready(function () {
          $('#myForm').validate({
          rules: {
              roll[]: {
              required: true,
              },
          },
          messages: {
            
             
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