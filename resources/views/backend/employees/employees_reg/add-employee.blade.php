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
                          Edit Employee 
                          @else
                          Add Employee
                          @endif

                        <a class="btn btn-success btn-sm float-right" href="{{ route('employees.reg.view') }} "> <i class="fa fa-list"></i> Employee List</a>
                      </h3>
                      
                  </div>
                  <div class="card-body">
                      <form method="post" enctype="multipart/form-data" action="{{ (@$editData)? route('employees.reg.update',$editData->id):route('employees.reg.store') }}"  id="myForm">
                          @csrf
                          <div class="form-row">
                            <div class="form-group col-md-4">
                              <label for="name">Student Name <font style="color:red">*</font></label>
                              <input type="text" value="{{ (@$editData->name) }}" class="form-control form-control-sm" name="name">
                              <font style="cilor: red"> {{ ($errors->has('name')) ? ($errors->first('name')): '' }} </font>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="fname">Father's Name<font style="color:red">*</font></label>
                              <input type="text" value="{{ (@$editData->fname) }}" class="form-control form-control-sm" name="fname">
                              <font style="cilor: red"> {{ ($errors->has('fname')) ? ($errors->first('fname')): '' }} </font>
                            </div>
                          
                            <div class="form-group col-md-4">
                              <label for="mname">Mother's Name<font style="color:red">*</font></label>
                              <input type="text" value="{{ (@$editData->mname) }}" class="form-control form-control-sm" name="mname">
                              <font style="cilor: red"> {{ ($errors->has('mname')) ? ($errors->first('mname')): '' }} </font>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="mobile">Mobile Number</label>
                              <input type="text" value="{{ (@$editData->mobile) }}" class="form-control form-control-sm" name="mobile">
                              <font style="cilor: red"> {{ ($errors->has('mobile')) ? ($errors->first('mobile')): '' }} </font>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="address">Address<font style="color:red">*</font></label>
                              <input type="text" value="{{ (@$editData->address) }}" class="form-control form-control-sm" name="address">
                              <font style="cilor: red"> {{ ($errors->has('address')) ? ($errors->first('address')): '' }} </font>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="address">Select Gender<font style="color:red">*</font></label>
                              <select name="gender" id="gender" class="form-control form-control-sm">
                                  <option value="">---select---</option>
                                  <option value="male" {{ (@$editData->gender =='male')? 'selected':'' }}>male</option>
                                  <option value="female" {{ (@$editData->gender =='female')? 'selected':'' }}>female</option>
                              </select>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="religion">Select Religion<font style="color:red">*</font></label>
                              <select name="religion" id="religion" class="form-control form-control-sm">
                                  <option value="">---select---</option>
                                  <option value="muslim" {{ (@$editData->religion =='muslim')? 'selected':'' }}>Muslim</option>
                                  <option value="khristan" {{ (@$editData->religion =='khristan')? 'selected':'' }}>Khristan</option>
                                  <option value="hindu"  {{ (@$editData->religion =='hindu')? 'selected':'' }} >Hindu</option>
                                  <option value="buddho" {{ (@$editData->religion =='buddho')? 'selected':'' }}>Buddho</option>
                              </select>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="dob">Date of Birth<font style="color:red">*</font></label>
                              <input type="text" value="{{ (@$editData->dob) }}" class="form-control singledatepicker form-control-sm" name="dob" autocomplete="off">
                              <font style="cilor: red"> {{ ($errors->has('dob')) ? ($errors->first('dob')): '' }} </font>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="designation_id">Designation<font style="color:red">*</font></label>
                              <select name="designation_id" id="designation_id" class="form-control form-control-sm">
                                  <option value="">---select---</option>
                                 @foreach ($designations as $designation)
                                 <option value="{{ $designation->id }}" {{ (@$editData->designation_id==$designation->id)?'selected':'' }}>{{ $designation->name }}</option>
                                 @endforeach
                              </select>
                            </div>
                            @if(!@$editData)
                            <div class="form-group col-md-4">
                              <label for="salary">Salary</label>
                              <input type="number" value="{{ (@$editData->salary) }}" class="form-control  form-control-sm" name="salary">
                              <font style="cilor: red"> {{ ($errors->has('discount')) ? ($errors->first('discount')): '' }} </font>
                            </div>
                           
                            <div class="form-group col-md-4">
                              <label for="dob">Join Date<font style="color:red">*</font></label>
                              <input type="text" value="{{ (@$editData->join_date) }}" class="form-control singledatepicker form-control-sm" name="join_date" autocomplete="off">
                              <font style="cilor: red"> {{ ($errors->has('dob')) ? ($errors->first('dob')): '' }} </font>
                            </div>
                            @endif
                           
                            
                            
                            
                            <div class="form-group col-md-4">
                              <label for="name">Student Image <font style="color:red">*</font></label>
                              <input type="file" name="image" class="form-control form-control-sm" id="image">
                            </div>
                            <div class="form-group col-md-4">
                              <img id="showImage" src="{{ (!empty($editData->image)) ? url('/upload/employee_images/'.$editData->image):url('/upload/default/default.png') }}" style=" width: 150px; height: 160px; border:1px solid #000;" alt="">
                            </div>
                            <div class="form-group col-md-12">
                              <button type="submit" class="btn btn-sm {{ (@$editData)?'btn-primary':'btn-success' }}">{{ (@$editData)?'Update':'Submit' }}</button>   
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
                join_date: {
                required: true,
                },
                designation_id: {
                required: true,
                },
                salary: {
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