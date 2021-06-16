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
                      <h3>Manage Password
                        {{-- <a class="btn btn-success btn-sm float-right" href="{{ route('profiles.password.update') }} "> <i class="fa fa-list"></i> List</a> --}}
                      </h3>
                      
                  </div>
                  <div class="card-body">
                      <form method="post" action="{{ route('profiles.password.update') }}" id="myForm">
                          @csrf
                          <div class="form-row">
                              <div class="form-group col-md-4">
                                <label for="current_password">Current Password</label>
                                <input type="password" class="form-control" name="current_password" id="current_password">
                                <font style="cilor: red"> {{ ($errors->has('current_password')) ? ($errors->first('current_password')): '' }} </font>    
                              </div>
                              <div class="form-group col-md-4">
                                <label for="password1">New Password</label>
                                <input type="password" class="form-control" name="new_password" id="new_password">
                                <font style="cilor: red"> {{ ($errors->has('new_password')) ? ($errors->first('new_password')): '' }} </font>    
                              </div>
                              <div class="form-group col-md-4">
                                <label for="again_new_password">Again New Password</label>
                                <input type="password" class="form-control" name="again_new_password">    
                              </div>
                              <div class="form-group col-md-6">
                                <input type="submit" value="Update" class="btn btn-primary">    
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
                current_password: {
                    required: true,
                },
                new_password: {
                    required: true,
                    minlength: 6
                },
                again_new_password: {
                    required: true,
                    equalTo: '#new_password'
                },
                
            },
            messages: {
                current_password: {
                required: "Please enter current password",
                },
                new_password: {
                required: "Please enter new password",
                minlength: "more than 6 chrecter",
                },
                again_new_password: {
                required: "Please enter Again New password",
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