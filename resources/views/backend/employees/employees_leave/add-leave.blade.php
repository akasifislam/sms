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
                          Edit Employee leave
                          @else
                          Add  Employee leave
                          @endif

                        <a class="btn btn-success btn-sm float-right" href="{{ route('employees.leave.view') }} "> <i class="fa fa-list"></i> Student Group List</a>
                      </h3>
                      
                  </div>
                  <div class="card-body">
                      <form method="post" action="{{ (@$editData)? route('employees.leave.update',$editData->id):route('employees.leave.store') }}"  id="myForm">
                          @csrf
                          <div class="form-row">
                              <div class="form-group col-md-10">
                                <label for="employee_id">Employee Name</label>
                                <select name="employee_id" id="employee_id" class="form-control form-control-sm">
                                    <option value="">---select employee---</option>
                                   @foreach ($employees as $employee)
                                   <option value="{{ $employee->id }}" {{ (@$editData->employee_id==$employee->id)?'selected':'' }}>{{ $employee->name }}</option>
                                   @endforeach
                                </select>  
                              </div>
                              <div class="form-group col-md-5">
                                <label for="start_date">Start Date</label>
                                <input type="text" value="{{date('d-m-Y',strtotime( @$editData->start_date ))}}" name="start_date" id="start_date" class="form-control singledatepicker form-control-sm" >
                              </div>
                              <div class="form-group col-md-5">
                                <label for="end_date">End Date</label>
                                <input type="text" value="{{date('d-m-Y',strtotime( @$editData->start_date ))}}" name="end_date" id="end_date" class="form-control singledatepicker form-control-sm" autocomplete="off" >
                              </div>
                              <div class="form-group col-md-10">
                                <label for="leave_purpose_id">Leave Purpose</label>
                                <select name="leave_purpose_id" id="leave_purpose_id" class="form-control form-control-sm">
                                    <option value="">---select employee---</option>
                                   @foreach ($leave_purposes as $leave_purpose)
                                   <option value="{{ $leave_purpose->id }}" {{ (@$editData->leave_purpose_id==$leave_purpose->id)?'selected':'' }}>{{ $leave_purpose->name }}</option>
                                   @endforeach
                                   <option value="0">New Purpose</option>
                                </select>
                                <input type="text" style="display: none" name="name" id="add_others" class="form-control form-control-sm" placeholder="Write New Purpose">
                              </div>
                              <div class="form-group col-md-12">
                                
                                <button type="submit" class="btn {{ (@$editData)?'btn-primary':'btn-success' }}">{{ (@$editData)?'Update':'Submit' }}</button>   
                              </div>
        
                          </div>
                      </form>
                    
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
               
                name: {
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
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('change','#leave_purpose_id',function(){
                var leave_purpose_id = $(this).val();
                if(leave_purpose_id == '0'){
                    $('#add_others').show();
                }else{
                    $('#add_others').hide();
                }
            });
        });
    </script>
@endsection