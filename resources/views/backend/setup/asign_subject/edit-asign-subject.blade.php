@extends('backend.layouts.master')
@section('content')
    <!-- Main content -->
    <div class="">
        <section class="content">
            <div class="container-fluid">
              <!-- Small boxes (Stat box) -->
              <div class="row">
                <section class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>
                                @if(isset($editData))
                                Edit Asign Subject
                                @else
                                Add Asign Subject 
                                @endif
      
                              <a class="btn btn-success btn-sm float-right" href="{{ route('setpus.asign.subject.view') }} "> <i class="fa fa-list"></i> Asign Subject List</a>
                            </h3>
                            
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('setpus.asign.subject.update',$editData['0']->class_id) }}"  id="myForm">
                              @csrf
                              <div class="add_item">
                                  {{-- form row 1 =========================================  --}}
                                  <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="name">Select Class</label>
                                        <select name="class_id" class="form-control" id="">
                                            <option value="">--- Select ---</option>
                                            @foreach ($classes as $cls)
                                            <option value="{{ $cls->id }}" {{ ($editData['0']->class_id == $cls->id? "selected":"") }} >{{ $cls->name }}</option>
                                            @endforeach 
                                        </select>  
                                    </div>
                                  </div>
                                  {{-- form row 2 ===========================================  --}}
                                  @foreach ($editData as $edit)
                                      
                                  <div class="delete_whole_extra_item" id="delete_whole_extra_item">
                                  <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="name">Subject</label>
                                        <select name="subject_id[]" class="form-control" id="">
                                            <option value="">--- Select subject ---</option>
                                            @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}" {{ ($edit->subject_id==$subject->id)?"selected":"" }} >{{ $subject->name }}</option>
                                            @endforeach
                                            
                                        </select>  
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="name">Full Mark</label>
                                        <input type="text" name="full_mark[]" value="{{ $edit->full_mark }}" class="form-control">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="name">Pass Mark</label>
                                        <input type="text" name="pass_mark[]" value="{{ $edit->pass_mark }}" class="form-control">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="name">Subjective Mark</label>
                                        <input type="text" name="subjective_mark[]" value="{{ $edit->subjective_mark }}" class="form-control">
                                    </div>
                                    <div class="form-group col-md-1" style="padding-top: 30px">
                                        <div class="form-row">
                                            <span class="btn btn-success addeventmore"> <i class="fa fa-plus-circle"></i> </span>
                                            <span class="btn btn-danger removeeventmore"> <i class="fa fa-minus-circle"></i> </span>
                                          </div>
                                    </div>
                                  </div>
                                  </div>
                                  @endforeach
                                  
                              </div>
                              <button type="submit" class="btn {{ (@$editData)?'btn-primary':'btn-success' }}">{{ (@$editData)?'Update':'Submit' }}</button>   
                              
                            </form>                    
                        </div>
                    </div>
                </section>
              </div>
              <!-- /.row -->
              <!-- Main row -->
             
          </section>
    </div>
    <!-- /.content -->
    <div style="visibility: hidden;">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="delete_whole_extra_item" id="delete_whole_extra_item">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="name">Subject</label>
                        <select name="subject_id[]" class="form-control" id="">
                            <option value="">--- Select subject ---</option>
                            @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                            
                        </select>  
                    </div>
                    <div class="form-group col-md-2">
                        <label for="name">Full Mark</label>
                        <input type="text" name="full_mark[]" class="form-control">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="name">Pass Mark</label>
                        <input type="text" name="pass_mark[]" class="form-control">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="name">Subjective Mark</label>
                        <input type="text" name="subjective_mark[]" class="form-control">
                    </div>
                    
                    <div class="form-group col-md-1" style="padding-top: 30px">
                      <div class="form-row">
                        <span class="btn btn-success addeventmore"> <i class="fa fa-plus-circle"></i> </span>
                        <span class="btn btn-danger removeeventmore"> <i class="fa fa-minus-circle"></i> </span>
                      </div>
                    </div>
                    
                  </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            var counter = 0;
            $(document).on("click",".addeventmore",function(){
                var whole_extra_item_add = $("#whole_extra_item_add").html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++
            });
            $(document).on("click",".removeeventmore",function(event){
                $(this).closest(".delete_whole_extra_item").remove();
                counter -=1
            });
        })
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#myForm').validate({
            rules: {
               
                class_id: {
                required: true,
                },
                "subject_id[]": {
                required: true,
                },
                "full_mark[]": {
                required: true,
                },
                "pass_mark[]": {
                required: true,
                },
                "subjective_mark[]": {
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