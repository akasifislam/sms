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
                      <h3>Profile List
                        {{-- <a class="btn btn-success btn-sm float-right" href="{{ route('users.add') }} "> <i class="fa fa-plus-circle"></i> Add</a> --}}
                      </h3>
                      
                  </div>
                  <div class="card-body">

                <div class="text-center">
                    {{-- <img class="profile-user-img img-fluid img-circle" src="https://bit.ly/3avocnL" alt="User profile picture"> --}}
                    <img class="profile-user-img img-fluid img-circle" src="{{ (!empty($user->image))?url('/upload/user_images/'.$user->image):url('/upload/default/default.png') }}" alt="User profile picture">
                  </div>
  
                  <h3 class="profile-username text-center">{{ Auth()->user()->name }}</h3>
  
                  <p class="text-muted text-center">Software Engineer</p>
  
                  <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                      <b>Name</b> <a class="float-right">{{ $user->name }}</a>
                    </li>
                    <li class="list-group-item">
                      <b>Email</b> <a class="float-right">{{ $user->email }}</a>
                    </li>
                    <li class="list-group-item">
                      <b>Mobile Number</b> <a class="float-right">{{ $user->mobile}}</a>
                    </li>
                    <li class="list-group-item">
                      <b>Address</b> <a class="float-right">{{ $user->address }}</a>
                    </li>
                    <li class="list-group-item">
                      <b>Role</b> <a class="float-right">{{ $user->usertype }}</a>
                    </li>
                  </ul>
  
                  <a href="{{ route('profiles.edit') }}" class="btn btn-primary btn-block"><b>Edit</b></a>
                
                    
                  </div>
              </div>


          </section>
        </div>
        <!-- /.row -->
        <!-- Main row -->
       
    </section>
    <!-- /.content -->
@endsection