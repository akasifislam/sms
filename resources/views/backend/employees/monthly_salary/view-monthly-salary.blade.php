@extends('backend.layouts.master')
@section('content')
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <section class="col-md-12">
              <div class="card">
                  <div class="card-header">
                      <h3> 
                          salary
                      </h3>
                  </div>
                  <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="control-label">Date</label>
                            <input type="text" name="date" id="date" class="form-control form-control-sm singledatepicker" autocomplete="off" placeholder="date" readonly>
                        </div>
                        <div class="form-group col-md-2">
                            <a class="btn btn-success btn-sm" id="search" style="margin-top: 31px; color: white">Search</a>
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

       
    </section>
    <script type="text/javascript">
        $(document).on('click','#search',function(){
            var date = $('#date').val();
            $('.notifyjs-corner').html('');
            if(date==''){
                $.notify("Date required",{globalPosition: 'top-right',className: 'error'});
                return false;
            }
            $.ajax({
                url: "{{ route('employees.moth.salary.get') }}",
                type: "GET",
                date: {'date': date},
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