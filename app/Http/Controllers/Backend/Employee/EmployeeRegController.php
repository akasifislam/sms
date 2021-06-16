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

class EmployeeRegController extends Controller
{
    public function view()
    {

        
        $data['allData'] = User::where('usertype','employee')->get();
        return view('backend.employees.employees_reg.view-employee',$data);
    }
    

    public function add()
    {
        
        $data['designations'] = Designation::all();
        return view('backend.employees.employees_reg.add-employee',$data);
    }
    public function store(Request $request)
    {
        DB::transaction(function () use($request) {
            $checkYear = date('Ym',strtotime($request->join_date));
            // dd($checkYear);
            $employee = User::where('usertype','employee')->orderBy('id','DESC')->first();
            if($employee == null){
                $firstReg = 0;
                $employeeId = $firstReg+1;
                if($employeeId < 10){
                    $id_no = '000'.$employeeId;
                }elseif($employeeId<100){
                    $id_no = '00'.$employeeId;
                }elseif($employeeId<1000){
                    $id_no = '0'.$employeeId;
                }
            }else{
                $employee = User::where('usertype','employee')->orderBy('id','DESC')->first()->id;
                $employeeId = $employee+1;
                if($employeeId<10){
                    $id_no = '000'.$employeeId;
                }elseif($employeeId<100){
                    $id_no = '00'.$employeeId;
                }elseif($employeeId<1000){
                    $id_no = '0'.$employeeId;
                }
            }
            $final_id_no = $checkYear.$id_no;
            $user = new User();
            $code = rand(0000,9999);
            $user->id_no = $final_id_no;
            $user->password = bcrypt($code);
            $user->usertype= 'employee';
            $user->code = $code;
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender= $request->gender;
            $user->salary= $request->salary;
            $user->designation_id= $request->designation_id;
            $user->dob= date('Y-m-d',strtotime($request->dob));
            $user->join_date= date('Y-m-d',strtotime($request->join_date));
            if ($request->file('image')) {
                $file= $request->file('image');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/employee_images'),$filename);
                $user['image'] = $filename;
            }
            $user->religion= $request->religion;
            $user->save();
            $employee_salary = new EmployeeSalaryLog();
            $employee_salary->employee_id = $user->id;
            $employee_salary->effected_date = date('Y-m-d',strtotime($request->join_date));
            $employee_salary->previous_salary = $request->salary;
            $employee_salary->present_salary =  $request->salary;
            $employee_salary->increment_salary = '0';
            $employee_salary->save();
            
            
            
        });
        return redirect()->route('employees.reg.view')->with('success','Data Inserted');

        
    }

    public function edit($id)
    {
        $data['editData'] = User::find($id);
       
        $data['designations'] = Designation::all();
        return view('backend.employees.employees_reg.add-employee',$data);
    }

    public function update(Request $request,$id)
    {
       
        $user = User::find($id);
        
        
        $user->name = $request->name;
        $user->fname = $request->fname;
        $user->mname = $request->mname;
        $user->mobile = $request->mobile;
        $user->address = $request->address;
        $user->gender= $request->gender;
        
        $user->designation_id= $request->designation_id;
        $user->dob= date('Y-m-d',strtotime($request->dob));
        
        if ($request->file('image')) {
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/employee_images'),$filename);
            $user['image'] = $filename;
        }
        $user->religion= $request->religion;
        $user->save();
        return redirect()->route('employees.reg.view')->with('success','Data Inserted');
       
       
        
    }

    public function details($id)
    {

        $data['details']= User::find($id);
        // dd($data['details']->toArray());
        $pdf = \PDF::loadView('backend.employees.employees_reg.employee-details-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    
}
