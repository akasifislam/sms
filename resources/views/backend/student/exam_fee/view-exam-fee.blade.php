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
                      <h3> Manage student Exam fee
                    
                      </h3>
                      
                  </div>
                  <div class="card-body">
                        <div class="form-row">
                          <div class="form-group col-md-3">
                            <label for="address">Select Year<font style="color:red">*</font></label>
                            <select name="year_id" id="year_id" class="form-control form-control-sm">
                                <option value="">---select---</option>
                               @foreach ($years as $year)
                               <option value="{{ $year->id }}" >{{ $year->name }}</option>
                               @endforeach
                            </select>
                          </div>
                          <div class="form-group col-md-3">
                            <label for="address">Select Class<font style="color:red">*</font></label>
                            <select name="class_id" id="class_id" class="form-control form-control-sm">
                                <option value="">---select---</option>
                               @foreach ($classes as $class)
                               <option value="{{ $class->id }}">{{ $class->name }}</option>
                               @endforeach
                            </select>
                          </div>
                          <div class="form-group col-md-3">
                            <label for="address">Select Exam<font style="color:red">*</font></label>
                            <select name="exam_type_id" id="exam_type_id" class="form-control form-control-sm" required>
                                <option value="">---select---</option>
                               
                                @foreach ($exam_types as $exam)
                                <option value="{{ $exam->id }}">{{ $exam->name }}</option>
                                @endforeach
                               
                            </select>
                          </div>
                          <div class="form-group col-md-3" style="padding-top: 31px;">
                            <a id="search" name="search" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> search </a>
                          </div>
                        </div>
                        
                  </div>
               
                  <div class="card-body">
                      <div id="DocumentResults"></div>
                      <script id="document-template" type="text/x-handlebars-template">
                        <table class="table-sm table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    @{{{ thsource }}}
                                </tr>
                            </thead>
                            <tbody>
                                @{{#each this}}
                                <tr>
                                    @{{{ tdsource }}}
                                </tr>
                                @{{/each}}
                            </tbody>
                        </table>                    
                      </script>

                   


                        
                  </div>
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
            var exam_type_id = $('#exam_type_id').val();
            $('.notifyjs-corner').html('');

            if(year_id==''){
                $.notify("year required",{globalPosition: 'top right',className: 'error'});
                return false;
            }
            if(class_id==''){
                $.notify("class required",{globalPosition: 'top right',className: 'error'});
                return false;
            }
            if(exam_type_id==''){
                $.notify("Exam required",{globalPosition: 'top right',className: 'error'});
                return false;
            }
            $.ajax({
                url: "{{ route('students.exam.fee.get.student') }}",
                type: "GET",
                data: { 'year_id': year_id, 'class_id': class_id,'exam_type_id': exam_type_id},
                beforeSend: function(){

                },
                success: function(data) {
                    var source = $("#document-template").html();
                    var template = Handlebars.compile(source);
                    var html = template(data);
                    $("#DocumentResults").html(html);
                    $(['data-toggle="tooltip"']).tooltip();
                }
            });
        });
    
    </script>

    
@endsection