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
                          Edit Student Year
                          @else
                          Add Student Year
                          @endif

                        <a class="btn btn-success btn-sm float-right" href="{{ route('setpus.student.year.view') }} "> <i class="fa fa-list"></i> Student Class List</a>
                      </h3>
                      
                  </div>
                  <div class="card-body">
                      <form method="post" action="{{ (@$editData)? route('setpus.student.year.update',$editData->id):route('setpus.student.year.store') }}"  id="myForm">
                          @csrf
                          <div class="form-row">
                              <div class="form-group col-md-8">
                                <label for="name">Name</label>
                                <input type="text" value="{{ (@$editData->name) }}" class="form-control" name="name">
                                <font style="cilor: red"> {{ ($errors->has('name')) ? ($errors->first('name')): '' }} </font>  
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
@endsection