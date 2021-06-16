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
                         Add/Edit Students Fee

                        <a class="btn btn-success btn-sm float-right" href="{{ route('accounts.fee.view') }} "> <i class="fa fa-list"></i> Student Fee List</a>
                      </h3>
                  </div>

                <div class="card-body">
                    <div class="form-row">
                        <div class="form form-group col-md-3">
                            <label for="year_id">Select Year</label>
                            <select name="year_id" id="year_id" class="form-control select2bs4">
                                @foreach ($years as $year)
                                    <option value="{{ $year->id }}"> {{ $year->name }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form form-group col-md-3">
                            <label for="class_id">Select Class</label>
                            <select name="class_id" id="class_id" class="form-control select2bs4">
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}"> {{ $class->name }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form form-group col-md-3">
                            <label for="fee_category_id">Exam Type</label>
                            <select name="fee_category_id" id="fee_category_id" class="form-control select2bs4">
                                @foreach ($fee_categories as $category)
                                    <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form form-group col-md-3">
                            <label for="date">Date</label>
                            <input type="text" name="date" id="date" class="form-control singledatepicker" autocomplete="off" autocomplete="off" placeholder="DD-MM-YY" readonly>
                        </div>
                        <div class="form form-group col-md-3">
                            <a id="search" name="search" class="btn btn-primary btn-sm">Search</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="DocumentResults"></div>
                    <script id="document-template" type="text/x-handlebars-template">
                        <form action="{{ route('accounts.fee.store') }}" method="post">
                            @csrf
                            <table class="table-sm table-striped table-bordered" style="width: 100%">
                                <thead>
                                    <tr>
                                        @{{{thsource}}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @{{#each this}}
                                    <tr>
                                        @{{{tdsource}}}
                                    </tr>
                                    @{{/each}}
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-success btn-sm" style="margin-top: 10px">submit</button>
                        </form>
                    </script>
                </div>

              </div>
          </section>
        </div>
        <script type="text/javascript">
            $(document).on('click','#search',function(){
                var year_id = $('#year_id').val();
                var class_id = $('#class_id').val();
                var fee_category_id = $('#fee_category_id').val();
                var date = $('#date').val();
                $('.notifyjs-corner').html('');
    
                if(year_id==''){
                    $.notify("year required",{globalPosition: 'top right',className: 'error'});
                    return false;
                }
                if(class_id==''){
                    $.notify("year required",{globalPosition: 'top right',className: 'error'});
                    return false;
                }
                if(fee_category_id==''){
                    $.notify("Subject required",{globalPosition: 'top right',className: 'error'});
                    return false;
                }
                if(date==''){
                    $.notify("Subject required",{globalPosition: 'top right',className: 'error'});
                    return false;
                }
                $.ajax({
                    url: "{{ route('accounts.fee.getstudent') }}",
                    type: "GET",
                    data: { 'year_id': year_id, 'class_id': class_id, 'fee_category_id': fee_category_id, 'date':date   },
                    beforSend: function() {
    
                    },
                    success: function(data) {
                        var source = $("#document-template").html();
                        var template = Handlebars.compile(source);
                        var html = template(data);
                        $('#DocumentResults').html(html);
                        $('[data-toggle="tooltip"]').tooltip();
                    }
                });
            });
        
        </script>
        <!-- /.row -->
        <!-- Main row -->
    </section>
    <!-- /.content -->
    
@endsection 