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
                      <h1>Manage Employee Salary</h1>
                      <h3>   
                          Increment Employee Salary

                        <a class="btn btn-success btn-sm float-right" href="{{ route('employees.salary.view') }} "> <i class="fa fa-list"></i> Employee List</a>
                      </h3>
                      
                  </div>
                  <div class="card-body">
                      <form method="post" action="{{ route('employees.salary.store',$editData->id) }}"  id="myForm">
                          @csrf
                          <div class="form-row">
                              <div class="form-group col-md-4 offset-4">
                                <label for="name">Salary Amount</label>
                                <input type="text" class="form-control" name="increment_salary">  
                              </div>
                              <div class="form-group col-md-4 offset-4">
                                <label for="name">Effected Date</label>
                                <input type="text" placeholder="Date" class="form-control singledatepicker" name="effected_date">  
                              </div>
                              <div class="form-group col-md-4 offset-4">
                                
                                <button type="submit" class="btn {{ (@$editData)?'btn-primary':'btn-success' }}">submit</button>   
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
               
                increment_salary: {
                required: true,
                },
                effected_date: {
                required: true,
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