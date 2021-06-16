<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AsignStudent;
use App\Model\DiscountStudent;
use App\User;
use App\Model\EmployeeSalaryLog;
use App\Model\Designation;
use App\Model\StudentClass;
use App\Model\Group;
use App\Model\LeavePurPose;
use App\Model\EmployeeAttendance;
use App\Model\EmployeeLeave;
use App\Model\StudentShift;
use App\Model\Year;
use Illuminate\Support\Facades\DB;
use PDF;

class EmployeeAttendanceController extends Controller
{
    public function view()
    {
        // dd('asif');
        $data['allData'] = EmployeeAttendance::select('date')->groupBy('date')->orderBy('id','DESC')->get();
        // dd($data['allData']->toArray());
        return view('backend.employees.employees_attendance.view-attendance',$data);
    }
    

    public function add()
    {

        $data['employees'] = User::where('usertype','employee')->get();
        $data['leave_purposes'] = LeavePurPose::all();
        return view('backend.employees.employees_attendance.add-attendance',$data);
    }
    public function store(Request $request)
    {
        EmployeeAttendance::where('date',date('Y-m-d',strtotime($request->date)))->delete();


       $countemployee = count($request->employee_id);
    //    dd($countemployee);
       for ($i=0; $i <$countemployee ; $i++) { 
           $attendance_status = 'attendance_status'.$i;
           $attendance = new EmployeeAttendance();
           $attendance->date = date('Y-m-d',strtotime($request->date));
           $attendance->employee_id = $request->employee_id[$i];
           $attendance->attendance_status = $request->$attendance_status;
        //    dd($attendance->toArray());
           $attendance->save();
       }
       return redirect()->route('employees.attendance.view')->with('success','Data Inserted');


        
    }

    public function edit($date)
    {

        $data['editData'] = EmployeeAttendance::where('date',$date)->get();
        $data['employees'] = User::where('usertype','employee')->get();
        return view('backend.employees.employees_attendance.add-attendance',$data);
    }

    public function details($date)
    {
        // dd('dsgdhf');
        $data['details'] = EmployeeAttendance::where('date',$date)->get();
        return view('backend.employees.employees_attendance.details-attendance',$data);   
    }

}
