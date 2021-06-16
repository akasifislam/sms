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
                                Edit Amount fee
                                @else
                                Add Amount fee 
                                @endif
      
                              <a class="btn btn-success btn-sm float-right" href="{{ route('setpus.fee.amount.view') }} "> <i class="fa fa-list"></i> Student Group List</a>
                            </h3>
                            
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{  route('setpus.fee.amount.update',$editData[0]->fee_category_id) }}"  id="myForm">
                              @csrf
                              <div class="add_item">
                                  {{-- form row 1 =========================================  --}}
                                  <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Fee Category</label>
                                        <select name="fee_category_id" class="form-control" id="">
                                            <option value="">--- Select ---</option>
                                            @foreach ($fee_categories as $category)
                                            <option {{ ($editData['0']->fee_category_id==$category->id)?"selected":"" }} value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach 
                                        </select>  
                                    </div>
                                  </div>
                                  {{-- form row 2 ===========================================  --}}
                                  @foreach ($editData as $edit)
                                  <div class="delete_whole_extra_item" id="delete_whole_extra_item">
                                    <div class="form-row">
                                        <div class="form-group col-md-8">
                                            <label for="name">Class Name</label>
                                            <select name="class_id[]" class="form-control" id="">
                                                <option value="">--- Select ---</option>
                                                @foreach ($classes as $class)
                                                <option value="{{ $class->id }}" {{ ($edit->class_id==$class->id)?"selected":"" }} >{{ $class->name }}</option>
                                                @endforeach
                                                
                                            </select>  
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="name">Amount</label>
                                            <input type="text" value="{{ $edit->amount }}" name="amount[]" class="form-control">
                                            <font style="cilor: red"> {{ ($errors->has('amount')) ? ($errors->first('amount')): '' }} </font>
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
                              {{-- <div class="form-group col-md-12"> --}}
                                      
                                  <button type="submit" class="btn {{ (@$editData)?'btn-primary':'btn-success' }}">{{ (@$editData)?'Update':'Submit' }}</button>   
                                {{-- </div> --}}
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
                    <div class="form-group col-md-8">
                        <label for="name">Class Name</label>
                        <select name="class_id[]" class="form-control" id="">
                            <option value="">--- Select ---</option>
                            @foreach ($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>  
                    </div>
                    <div class="form-group col-md-5">
                        <label for="name">Amount</label>
                        <input type="text" name="amount[]" class="form-control">
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
               
                fee_category_id: {
                required: true,
                },
                "class_id[]": {
                required: true,
                },
                "amount[]": {
                required: true,
                },
            },
            messages: {
              
                fee_category_id: {
                required: "Please enter category",
                },
                "class_id[]": {
                required: "Please enter Class",
                },
                "amount[]": {
                required: "Please enter Amount",
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