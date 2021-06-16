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
use App\Model\EmployeeLeave;
use App\Model\StudentShift;
use App\Model\Year;
use Illuminate\Support\Facades\DB;
use PDF;

class EmployeeLeaveController extends Controller
{
    public function view()
    {
        // dd('asif');

        
        $data['allData'] = EmployeeLeave::orderBy('id','DESC')->get();
        // dd($data['allData']->toArray());
        return view('backend.employees.employees_leave.view-leave',$data);
    }
    

    public function add()
    {

        $data['employees'] = User::where('usertype','employee')->get();
        $data['leave_purposes'] = LeavePurPose::all();
        return view('backend.employees.employees_leave.add-leave',$data);
    }
    public function store(Request $request)
    {
        if ($request->leave_purpose_id == '0') {
            $leavepurpose = new LeavePurPose();
            $leavepurpose->name = $request->name;
            $leavepurpose->save();
            $leave_purpose_id = $leavepurpose->id;
        }else{
            $leave_purpose_id = $request->leave_purpose_id;
        }
        $employee_leave = new EmployeeLeave();
        $employee_leave->employee_id = $request->employee_id;
        $employee_leave->start_date = date('Y-m-d',strtotime($request->start_date));
        $employee_leave->end_date = date('Y-m-d',strtotime($request->end_date));
        $employee_leave->leave_purpose_id = $leave_purpose_id;
        $employee_leave->save();

       
        return redirect()->route('employees.leave.view')->with('success','Data Inserted');

        
    }

    public function edit($id)
    {
        // dd('dfhjgdhjgds');
        $data['editData'] = EmployeeLeave::find($id);
        $data['employees'] = User::where('usertype','employee')->get();
        $data['leave_purposes'] = LeavePurPose::all();
        return view('backend.employees.employees_leave.add-leave',$data);
    }

    public function update(Request $request,$id)
    {
       
        if ($request->leave_purpose_id == '0') {
            $leavepurpose = new LeavePurPose();
            $leavepurpose->name = $request->name;
            $leavepurpose->save();
            $leave_purpose_id = $leavepurpose->id;
        }else{
            $leave_purpose_id = $request->leave_purpose_id;
        }
        $employee_leave = EmployeeLeave::find($id);
        $employee_leave->employee_id = $request->employee_id;
        $employee_leave->start_date = date('Y-m-d',strtotime($request->start_date));
        $employee_leave->end_date = date('Y-m-d',strtotime($request->end_date));
        $employee_leave->leave_purpose_id = $leave_purpose_id;
        $employee_leave->save();

       
        return redirect()->route('employees.leave.view')->with('success','Data Updated');
       
       
        
    }

    public function details($id)
    {

        
    }
}
