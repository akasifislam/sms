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
                      <h3>Edit Profile
                        <a class="btn btn-success btn-sm float-right" href="{{ route('profiles.view') }} "> <i class="fa fa-user"></i> Profile</a>
                      </h3>
                  </div>
                  <div class="card-body">
                      <form method="post" action="{{ route('profiles.update') }}" enctype="multipart/form-data" id="myForm">
                          @csrf
                          <div class="form-row">
                              
                              <div class="form-group col-md-4">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" value="{{ $editData->name }}" name="name">
                                <font style="cilor: red"> {{ ($errors->has('name')) ? ($errors->first('name')): '' }} </font>  
                              </div>
                              <div class="form-group col-md-4">
                                <label for="email">E-mail</label>
                                <input type="email" class="form-control" value="{{ $editData->email }}" name="email">
                                <font style="cilor: red"> {{ ($errors->has('email')) ? ($errors->first('email')): '' }} </font>
                              </div>
                              <div class="form-group col-md-4">
                                <label for="mobile">Mobile</label>
                                <input type="text" class="form-control" value="{{ $editData->mobile }}" name="mobile">
                                <font style="cilor: red"> {{ ($errors->has('mobile')) ? ($errors->first('mobile')): '' }} </font>
                              </div>
                              <div class="form-group col-md-4">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" value="{{ $editData->address }}" name="address">
                                <font style="cilor: red"> {{ ($errors->has('address')) ? ($errors->first('address')): '' }} </font>
                              </div>
                              
                              <div class="form-group col-md-4">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender" class="form-control">
                                  <option value="">Gender</option>
                                  <option value="Male" {{ ($editData->gender=="Male")? "selected": "" }} >Male</option>
                                  <option value="Female" {{ ($editData->gender=="Female")?"selected":"" }} >Female</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="image">Image</label>
                              <input type="file" name="image" id="image" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                              <img id="showImage" src="{{ (!empty($editData->image))?url('/upload/user_images/'.$editData->image):url('/upload/default/default.png') }}" style=" width: 150px; height: 160px; border:1px solid #000;" alt="">
                            </div>
                              <div class="form-group col-md-12">
                                <input type="submit" value="update" class="btn btn-primary">    
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
                usertype: {
                required: true,
                },
                name: {
                required: true,
                },
                email: {
                required: true,
                email: true,
                },
                password: {
                    required: true,
                    minlength: 6
                },
                password2: {
                    required: true,
                    equalTo: '#password'
                },
                
            },
            messages: {
                usertype: {
                required: "Please select User Role",
                },
                name: {
                required: "Please enter name",
                },
                email: {
                required: "Please enter a email address",
                email: "Please enter a <em> vaild </em> email address",
                },
                password: {
                required: "Please enter a password",
                minlength: "Your password must be at least 6 characters",
                },
                password2: {
                required: "Please enter confirm password",
                equalTo: "Confirm password does not match",
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