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
                          Promotion Student 
                          @else
                          Add Student
                          @endif

                        <a class="btn btn-success btn-sm float-right" href="{{ route('students.reg.view') }} "> <i class="fa fa-list"></i> Student Class List</a>
                      </h3>
                      
                  </div>
                  <div class="card-body">
                      <form method="post" enctype="multipart/form-data" action="{{  route('students.reg.promotion.store',$editData->student_id) }}"  id="myForm">
                          @csrf
                          <input type="hidden" name="id" value="{{ @$editData->id }}">
                          <div class="form-row">
                              <div class="form-group col-md-4">
                                <label for="name">Student Name <font style="color:red">*</font></label>
                                <input type="text" value="{{ (@$editData['student']['name']) }}" class="form-control form-control-sm" name="name">
                                <font style="cilor: red"> {{ ($errors->has('name')) ? ($errors->first('name')): '' }} </font>
                              </div>
                              <div class="form-group col-md-4">
                                <label for="fname">Father's Name<font style="color:red">*</font></label>
                                <input type="text" value="{{ (@$editData['student']['fname']) }}" class="form-control form-control-sm" name="fname">
                                <font style="cilor: red"> {{ ($errors->has('fname')) ? ($errors->first('fname')): '' }} </font>
                              </div>
                              <div class="form-group col-md-4">
                                <label for="mname">Mother's Name<font style="color:red">*</font></label>
                                <input type="text" value="{{ (@$editData['student']['mname']) }}" class="form-control form-control-sm" name="mname">
                                <font style="cilor: red"> {{ ($errors->has('mname')) ? ($errors->first('mname')): '' }} </font>
                              </div>
                              <div class="form-group col-md-4">
                                <label for="mobile">Mobile Number</label>
                                <input type="text" value="{{ (@$editData['student']['mobile']) }}" class="form-control form-control-sm" name="mobile">
                                <font style="cilor: red"> {{ ($errors->has('mobile')) ? ($errors->first('mobile')): '' }} </font>
                              </div>
                              <div class="form-group col-md-4">
                                <label for="address">Address<font style="color:red">*</font></label>
                                <input type="text" value="{{ (@$editData['student']['address']) }}" class="form-control form-control-sm" name="address">
                                <font style="cilor: red"> {{ ($errors->has('address')) ? ($errors->first('address')): '' }} </font>
                              </div>
                              <div class="form-group col-md-4">
                                <label for="address">Select Gender<font style="color:red">*</font></label>
                                <select name="gender" id="gender" class="form-control form-control-sm">
                                    <option value="">---select---</option>
                                    <option value="male" {{ (@$editData['student']['gender']=='male')? 'selected':'' }}>male</option>
                                    <option value="female" {{ (@$editData['student']['gender']=='female')? 'selected':'' }}>female</option>
                                </select>
                              </div>
                              <div class="form-group col-md-4">
                                <label for="religion">Select Religion<font style="color:red">*</font></label>
                                <select name="religion" id="religion" class="form-control form-control-sm">
                                    <option value="">---select---</option>
                                    <option value="muslim" {{ (@$editData['student']['religion']=='muslim')? 'selected':'' }}>Muslim</option>
                                    <option value="khristan" {{ (@$editData['student']['religion']=='khristan')? 'selected':'' }}>Khristan</option>
                                    <option value="hindu"  {{ (@$editData['student']['religion']=='hindu')? 'selected':'' }} >Hindu</option>
                                    <option value="buddho" {{ (@$editData['student']['religion']=='buddho')? 'selected':'' }}>Buddho</option>
                                </select>
                              </div>
                              <div class="form-group col-md-4">
                                <label for="dob">Date of Birth<font style="color:red">*</font></label>
                                <input type="text" value="{{ (@$editData['student']['dob']) }}" class="form-control singledatepicker form-control-sm" name="dob" autocomplete="off">
                                <font style="cilor: red"> {{ ($errors->has('dob')) ? ($errors->first('dob')): '' }} </font>
                              </div>
                              <div class="form-group col-md-4">
                                <label for="discount">Discount</label>
                                <input type="number" value="{{ (@$editData['discount']['discount']) }}" class="form-control  form-control-sm" name="discount">
                                <font style="cilor: red"> {{ ($errors->has('discount')) ? ($errors->first('discount')): '' }} </font>
                              </div>
                              <div class="form-group col-md-4">
                                <label for="address">Select Year<font style="color:red">*</font></label>
                                <select name="year_id" id="year_id" class="form-control form-control-sm">
                                    <option value="">---select---</option>
                                   @foreach ($years as $year)
                                   <option value="{{ $year->id }}" {{ (@$editData->year_id==$year->id)?'selected':'' }}>{{ $year->name }}</option>
                                   @endforeach
                                </select>
                              </div>
                              <div class="form-group col-md-4">
                                <label for="address">Select Class<font style="color:red">*</font></label>
                                <select name="class_id" id="class_id" class="form-control form-control-sm">
                                    <option value="">---select---</option>
                                   @foreach ($classes as $class)
                                   <option value="{{ $class->id }}" {{ (@$editData->class_id==$class->id)?'selected':'' }}>{{ $class->name }}</option>
                                   @endforeach
                                </select>
                              </div>
                              <div class="form-group col-md-4">
                                <label for="group_id">---Select Group---</label>
                                <select name="group_id" id="group_id" class="form-control form-control-sm">
                                    <option value="">select</option>
                                   @foreach ($groups as $group)
                                   <option value="{{ $group->id }}" {{ (@$editData->group_id==$group->id)?'selected':'' }}>{{ $group->name }}</option>
                                   @endforeach
                                </select>
                              </div>
                              <div class="form-group col-md-4">
                                <label for="address">---Select Shift---</label>
                                <select name="shift_id" id="shift_id" class="form-control form-control-sm">
                                    <option value="">select</option>
                                   @foreach ($shifts as $shift)
                                   <option value="{{ $shift->id }}" {{ (@$editData->shift_id==$shift->id)?'selected':'' }}>{{ $shift->name }}</option>
                                   @endforeach
                                </select>
                              </div>
                              <div class="form-group col-md-4">
                                <label for="name">Student Image <font style="color:red">*</font></label>
                                <input type="file" name="image" class="form-control form-control-sm" id="image">
                              </div>
                              <div class="form-group col-md-4">
                                <img id="showImage" src="{{ (!empty($editData['student']['image'])) ? url('/upload/student_images/'.$editData['student']['image']):url('/upload/default/default.png') }}" style=" width: 150px; height: 160px; border:1px solid #000;" alt="">
                              </div>
                              <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-sm {{ (@$editData)?'btn-primary':'btn-success' }}">{{ (@$editData)?'Promotion':'Submit' }}</button>   
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
                fname: {
                required: true,
                },
                mname: {
                required: true,
                },
                mobile: {
                required: true,
                },
                address: {
                required: true,
                },
                gender: {
                required: true,
                },
                religion: {
                required: true,
                },
                dob: {
                required: true,
                },
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