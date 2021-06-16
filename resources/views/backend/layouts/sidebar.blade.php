@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
@endphp
    

<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ (!empty(Auth::user()->image))?url('/upload/user_images/'.Auth::user()->image):url('/upload/default/default.png') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @if (Auth::user()->role=='Admin')
        <li class="nav-item has-treeview {{ ($prefix=='/users')? 'menu-open':'' }}">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-cogs"></i>
            <p>
              User management
              <i class="fa fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('users.view') }}" class="nav-link {{ ($route=='users.view')?'active':'' }} ">
                <i class="fa fa-users"></i>
                <p>User</p>
              </a>
            </li>
          </ul>
        </li>
        @endif
        <li class="nav-item has-treeview {{ ($prefix=='/profiles')? 'menu-open':'' }}">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-cogs"></i>
            <p>
              Profile management
              <i class="fa fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('profiles.view') }}" class="nav-link {{ ($route=='profiles.view')?'active':'' }}">
                <i class="nav-icon fa fa-user"></i>
                <p>Profile</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('profiles.password.view') }}" class="nav-link {{ ($route=='profiles.password.view')?'active':'' }}">
                <i class="fa fa-unlock-alt nav-icon"></i>
                <p>Change Password</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview {{ ($prefix=='/setpus')? 'menu-open':'' }}">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-cogs"></i>
            <p>
              Setup management
              <i class="fa fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('setpus.student.class.view') }}" class="nav-link {{ ($route=='setpus.student.class.view')?'active':'' }}">
                <i class="nav-icon fa fa-user"></i>
                <p>Student Class</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('setpus.student.year.view') }}" class="nav-link {{ ($route=='setpus.student.year.view')?'active':'' }}">
                <i class="nav-icon fa fa-user"></i>
                <p>Student Year</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('setpus.student.gropu.view') }}" class="nav-link {{ ($route=='setpus.student.gropu.view')?'active':'' }}">
                <i class="nav-icon fa fa-users"></i>
                <p>Student Group</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('setpus.student.shift.view') }}" class="nav-link {{ ($route=='setpus.student.shift.view')?'active':'' }}">
                <i class="nav-icon fa fa-users"></i>
                <p>Student Shift</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('setpus.fee.category.view') }}" class="nav-link {{ ($route=='setpus.fee.category.view')?'active':'' }}">
                <i class="nav-icon fa fa-users"></i>
                <p>Fee Category</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('setpus.fee.amount.view') }}" class="nav-link {{ ($route=='setpus.fee.amount.view')?'active':'' }}">
                <i class="nav-icon fa fa-users"></i>
                <p>Fee Category Amount</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('setpus.exam.type.view') }}" class="nav-link {{ ($route=='setpus.exam.type.view')?'active':'' }}">
                <i class="nav-icon fa fa-users"></i>
                <p>Exam Type</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('setpus.subject.view') }}" class="nav-link {{ ($route=='setpus.subject.view')?'active':'' }}">
                <i class="nav-icon fa fa-users"></i>
                <p>Subject</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('setpus.asign.subject.view') }}" class="nav-link {{ ($route=='setpus.asign.subject.view')?'active':'' }}">
                <i class="nav-icon fa fa-users"></i>
                <p>Asign Subject</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('setpus.designation.view') }}" class="nav-link {{ ($route=='setpus.designation.view')?'active':'' }}">
                <i class="nav-icon fa fa-users"></i>
                <p>Designation</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview {{ ($prefix=='/students')? 'menu-open':'' }}">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-cogs"></i>
            <p>
              Student management
              <i class="fa fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('students.reg.view') }}" class="nav-link {{ ($route=='students.reg.view')?'active':'' }}">
                <i class="nav-icon fa fa-user"></i>
                <p>Student Registration</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('students.roll.view') }}" class="nav-link {{ ($route=='students.roll.view')?'active':'' }}">
                <i class="nav-icon fa fa-user"></i>
                <p>Roll Generate</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('students.reg.fee.view') }}" class="nav-link {{ ($route=='students.reg.fee.view')?'active':'' }}">
                <i class="nav-icon fa fa-user"></i>
                <p>Registration fee</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('students.month.fee.view') }}" class="nav-link {{ ($route=='students.month.fee.view')?'active':'' }}">
                <i class="nav-icon fa fa-user"></i>
                <p>Month fee</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('students.exam.fee.view') }}" class="nav-link {{ ($route=='students.exam.fee.view')?'active':'' }}">
                <i class="nav-icon fa fa-user"></i>
                <p>Exam fee</p>
              </a>
            </li>
            
          </ul>
          
        </li>


        <li class="nav-item has-treeview {{ ($prefix=='/employees')? 'menu-open':'' }}">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-cogs"></i>
            <p>
              Employee management
              <i class="fa fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('employees.reg.view') }}" class="nav-link {{ ($route=='employees.reg.view')?'active':'' }}">
                <i class="nav-icon fa fa-user"></i>
                <p>Employee Registration</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('employees.salary.view') }}" class="nav-link {{ ($route=='employees.salary.view')?'active':'' }}">
                <i class="nav-icon fa fa-user"></i>
                <p>Employee Salary</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('employees.leave.view') }}" class="nav-link {{ ($route=='employees.leave.view')?'active':'' }}">
                <i class="nav-icon fa fa-user"></i>
                <p>Employee Leave</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('employees.attendance.view') }}" class="nav-link {{ ($route=='employees.attendance.view')?'active':'' }}">
                <i class="nav-icon fa fa-user"></i>
                <p>Employee Attendance</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('employees.moth.salary.view') }}" class="nav-link {{ ($route=='employees.moth.salary.view')?'active':'' }}">
                <i class="nav-icon fa fa-user"></i>
                <p>Employee Monthly Salary</p>
              </a>
            </li>
          </ul>
          
        </li>
        <li class="nav-item has-treeview {{ ($prefix=='/marks')? 'menu-open':'' }}">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-cogs"></i>
            <p>
              Marks Management
              <i class="fa fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('student.marks.add') }}" class="nav-link {{ ($route=='student.marks.add')?'active':'' }}">
                <i class="nav-icon fa fa-user"></i>
                <p>Marks Entry</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('students.marks.edit') }}" class="nav-link {{ ($route=='students.marks.edit')?'active':'' }}">
                <i class="nav-icon fa fa-edit"></i>
                <p>Marks Edit</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('student.grade.point.view') }}" class="nav-link {{ ($route=='student.grade.point.view')?'active':'' }}">
                <i class="nav-icon fa fa-edit"></i>
                <p>Grade Point</p>
              </a>
            </li>
          </ul>
          
        </li>
        <li class="nav-item has-treeview {{ ($prefix=='/marks')? 'menu-open':'' }}">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-cogs"></i>
            <p>
              Account Management
              <i class="fa fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('accounts.fee.view') }}" class="nav-link {{ ($route=='accounts.fee.view')?'active':'' }}">
                <i class="nav-icon fa fa-user"></i>
                <p>Students Fee</p>
              </a>
            </li>
          </ul>
          
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>