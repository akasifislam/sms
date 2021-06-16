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
use App\Model\StudentShift;
use App\Model\Year;
use Illuminate\Support\Facades\DB;
use PDF;

class EmployeeSalaryController extends Controller
{
    public function view()
    {        
        $data['allData'] = User::where('usertype','employee')->get();
        return view('backend.employees.employees_salary.view-salary',$data);
    }
    

    

    public function increment($id)
    {
        // dd('dbfdkj');
        $data['editData'] = User::find($id);
        return view('backend.employees.employees_salary.add-employee-salary',$data);
    }

    public function store(Request $request,$id)
    {
    //    dd('defdf');  
        $user = User::find($id);
        $previous_salary = $user->salary;
        $present_Salary = (float)$previous_salary+(float)$request->increment_salary;
        $user->salary = $present_Salary;
        $user->save();
        
        $salaryData = new EmployeeSalaryLog();
        $salaryData->employee_id = $id;
        $salaryData->previous_salary = $previous_salary;
        $salaryData->increment_Salary = $request->increment_salary;
        $salaryData->present_salary = $present_Salary;
        $salaryData->effected_date = date('Y-m-d',strtotime($request->effected_date));
        $salaryData->save();
        return redirect()->route('employees.salary.view');
        
       
       
        
    }

    public function details($id)
    {
        $data['details'] = User::find($id);
        $data['salary_log'] = EmployeeSalaryLog::where('employee_id',$data['details']->id)->get();
        // dd($data['salary_log']->toArray());
        return view('backend.employees.employees_salary.employee-salary-details',$data);
    }
}
