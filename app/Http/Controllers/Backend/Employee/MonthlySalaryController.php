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
use Illuminate\Notifications\Action;
use Illuminate\Support\Facades\DB;

class MonthlySalaryController extends Controller
{
    public function view()
    {
        return view('backend.employees.monthly_salary.view-monthly-salary');
    }

    public function getSalary(Request $request)
    {
        // dd('ok asif');


        $date = date('Y-m',strtotime($request->date));
            if ($date != '') {
                $where[] = ['date','like',$date.'%'];
            }
        $data = EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with(['user'])->where($where)->get();
        $html['thsource'] = '<th>SL</th>';
        $html['thsource'] .= '<th>Employee Name</th>';
        $html['thsource'] .= '<th>Basic Salary</th>';
        $html['thsource'] .= '<th>Salary (This month)</th>';
        $html['thsource'] .= '<th>Action</th>';
        foreach ($data as $key => $attend) {
            $totalattend = EmployeeAttendance::with('user')->where($where)->where('employee_id',$attend->employee_id)->get();
            $absentCount = count($totalattend->where('attendance_status','Absent'));
            $color = 'success';
            $html[$key]['tdsource'] = '<td>'.  ($key+1)  .'</td>';
            $html[$key]['tdsource'] .=  '<td>'. $attend['user']['name'].'</td>';
            $html[$key]['tdsource'] .=  '<td>'.  $attend['user']['salary']  .'</td>';
            $salary = (float)$attend['user']['salary'];
            $salaryperday = (float)$salary/30;
            $totalsalaryminus = (float)$absentCount * (float)$salaryperday;
            $totalsalary = (float)$salary - (float)$totalsalaryminus;

            $html[$key]['tdsource'] .= '<td>' . $totalsalary .  '</td>';
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-'.$color.'" title="Payship" target="_blank" href="'.route("employees.moth.salary.payslip",$attend->employee_id).'">Fee Slip</a>';
            $html[$key]['tdsource'] .= '</td>';
        }
        return response()->json(@$html);
    }
}
