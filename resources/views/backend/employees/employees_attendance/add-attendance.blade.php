@extends('backend.layouts.master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('backend/css/attend.css')}}">
<style type="text/css">
    .switch_toggle {
        width: auto;
    }
    .switch_toggle {
        cursor: pointer;
    }
    .switch_candy{
        border: 1px solid #333;
        border-radius: 3px;
        box-shadow: 0 1px rgba(0, 0, 0, 0.2), inset 0 1px rgba(255, 255, 255, 0.986);
        background-color:white;
        background-image: -webkit-linear-gradient(top,rgba(255,255,255,0.2),transparent);
        background-image: linear-gradient(to bottom,rgba(255,255,255,0.2),transparent);
    }
    .switch_toggle.switch_candy, .switch_light.switch_candy{
        background-color: #132336b9;
        border-radius: 3px;
            
    } 
</style>
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
                          Edit Employee Attendance
                          @else
                          Add  Employee Attendance
                          @endif

                        <a class="btn btn-success btn-sm float-right" href="{{ route('employees.leave.view') }} "> <i class="fa fa-list"></i> Student Group List</a>
                      </h3>
                      
                  </div>
                  <form method="POST" action="{{ route('employees.attendance.store') }}" id="myForm">
                      @csrf
                      @if(isset($editData))
                        <div class="card-body">
                            <div class="form-group col-md-4">
                                <label for="control-label">Attendance Date</label>
                                <input type="text" name="date" id="date" value="{{$editData['0']['date']}} " class="checkdate form-control form-control-sm readonly" placeholder="Attendance Date" autocomplete="off">
                            </div>
                            <table class="table-sm table-bordered table-striped dt-responsive" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center" style="vertical-align: middle;">SL</th>
                                        <th rowspan="2" class="text-center" style="vertical-align: middle;">Employee Name</th>
                                        <th colspan="3" class="text-center" style="background-color: rgb(139, 238, 153); vertical-align:  middle; width: 26%">Attendance Status</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center btn present_all" style="display: table-cell; background-color: rgb(154, 47, 255);" >present</th>
                                        <th class="text-center btn leave_all" style="display: table-cell; background-color: rgb(140, 228, 8);" >leave</th>
                                        <th class="text-center btn absent_all" style="display: table-cell; background-color: rgb(214, 8, 145);" >absent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($editData as $key => $data)
                                    <tr id="div{{ $data->id }}" class="text-center">
                                        <input type="hidden" name="employee_id[]" value="{{$data->employee_id}}" class="employee_id">
                                        <td>{{$key+1}} </td>
                                        <td>{{ $data['user']['name'] }} </td>
                                        <td colspan="3">
                                            <div class="switch_toggle switch-3 switch_candy">
                                                <input class="present" id="present{{$key}}" name="attendance_status{{$key}}" value="Present" {{ ($data->attendance_status== 'Present')? 'checked':'' }}  type="radio">
                                                <label for="present{{$key}}">Present</label>

                                                <input class="leave" id="leave{{$key}}" name="attendance_status{{$key}}" value="Leave" type="radio" {{ ($data->attendance_status== 'Leave')? 'checked':'' }}>
                                                <label for="leave{{$key}}">Leave</label>

                                                <input type="radio" class="absent" id="absent{{$key}}" name="attendance_status{{$key}}" value="Absent" {{ ($data->attendance_status== 'Absent')? 'checked':'' }}>
                                                <label for="absent{{$key}}">Absent</label>
                                                

                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="form-group col-md-12 mt-2">
                                
                                <button type="submit" class="btn float-right {{ (@$editData)?'btn-primary':'btn-success' }}">{{ (@$editData)?'Update':'Submit' }}</button>   
                            </div>
                        </div>
                      @else
                        <div class="card-body">
                            <div class="form-group col-md-4">
                                <label for="control-label">Attendance Date</label>
                                <input type="text" name="date" id="date" class="checkdate form-control form-control-sm singledatepicker" placeholder="Attendance Date" autocomplete="off">
                            </div>
                            <table class="table-sm table-bordered table-striped dt-responsive" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center" style="vertical-align: middle;">SL</th>
                                        <th rowspan="2" class="text-center" style="vertical-align: middle;">Employee Name</th>
                                        <th colspan="3" class="text-center" style="background-color: rgb(139, 238, 153); vertical-align:  middle; width: 26%">Attendance Status</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center btn present_all" style="display: table-cell; background-color: rgb(154, 47, 255);" >present</th>
                                        <th class="text-center btn leave_all" style="display: table-cell; background-color: rgb(140, 228, 8);" >leave</th>
                                        <th class="text-center btn absent_all" style="display: table-cell; background-color: rgb(214, 8, 145);" >absent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $key => $employee)
                                    <tr id="div{{ $employee->id }}" class="text-center">
                                        <input type="hidden" name="employee_id[]" value="{{$employee->id}}" class="employee_id">
                                        <td>{{$key+1}} </td>
                                        <td>{{ $employee->name }} </td>
                                        <td colspan="3">
                                            <div class="switch_toggle switch-3 switch_candy">
                                                <input class="present" id="present{{$key}}" name="attendance_status{{$key}}" value="Present" type="radio" checked="checked">
                                                <label for="present{{$key}}">Present</label>

                                                <input class="leave" id="leave{{$key}}" name="attendance_status{{$key}}" value="Leave" type="radio">
                                                <label for="leave{{$key}}">Leave</label>

                                                <input type="radio" class="absent" id="absent{{$key}}" name="attendance_status{{$key}}" value="Absent">
                                                <label for="absent{{$key}}">Absent</label>

                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="form-group col-md-12 mt-2">
                                
                                <button type="submit" class="btn float-right {{ (@$editData)?'btn-primary':'btn-success' }}">{{ (@$editData)?'Update':'Submit' }}</button>   
                            </div>
                        </div>
                      @endif
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
               
                date: {
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

    <script>
        $(document).on('click','.present',function(){
            $(this).present('tr').find('.datetime').css('pointer-events','none').css('background-color','#dee2e6').css('color','#dee2e6');
        });

        $(document).on('click','.leave',function(){
            $(this).present('tr').find('.datetime').css('pointer-events','none').css('background-color','#dee2e6').css('color','#dee2e6');
        });

        $(document).on('click','.absent',function(){
            $(this).present('tr').find('.datetime').css('pointer-events','none').css('background-color','#dee2e6').css('color','#dee2e6');
        });
    </script>
    <script>

        $(document).on('click','.present_all',function(){
            $("input[value=Present]").prop('checked',true);
            $('.datetime').css('pointer-events','none').css('background-color','#dee2e6').css('color','#dee2e6');
        });
        $(document).on('click','.absent_all',function(){
            $("input[value=Absent]").prop('checked',true);
            $('.datetime').css('pointer-events','none').css('background-color','#dee2e6').css('color','#dee2e6');
        });
        $(document).on('click','.leave_all',function(){
            $("input[value=Leave]").prop('checked',true);
            $('.datetime').css('pointer-events','none').css('background-color','#dee2e6').css('color','#dee2e6');
        });
    </script>
@endsection 