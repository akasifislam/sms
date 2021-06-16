<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use App\Model\AccountStudentFee;
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
use App\Model\FeeCategory;
use App\Model\FeeCategoryAmount;
use App\Model\MarksGrade;
use App\Model\StudentShift;
use App\Model\Year;
use Illuminate\Support\Facades\DB;
use PDF;

class StudentFeeController extends Controller
{
    public function view()
    {
        $data['allData'] = AccountStudentFee::all();
        return view('backend.account.student.view-student-fee',$data);
    }
    public function add()
    {
        $data['years'] = Year::orderBy('id','DESC')->get();
        $data['classes'] = StudentClass::all();
        $data['fee_categories'] = FeeCategory::all();
        return view('backend.account.student.add-student-fee',$data);
        
    }
    public function getStudent(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $fee_category_id = $request->fee_category_id;
        $date = date('Y-m',strtotime($request->date));
        $data = AsignStudent::with(['discount'])->where('year_id',$year_id)->where('class_id',$class_id)->get();
        $html['thsource'] = '<th>ID No</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Father name</th>';
        $html['thsource'] .= '<th>Original Fee</th>';
        $html['thsource'] .= '<th>Discount Fee</th>';
        $html['thsource'] .= '<th>Fee (This Student)</th>';
        $html['thsource'] .= '<th>Select</th>';
        foreach ($data as $key => $std) {
            $studentfee = FeeCategoryAmount::where('fee_category_id',$fee_category_id)->where('class_id',$std->class_id)->first();
            $accountstudentfee = AccountStudentFee::where('student_id',$std->student_id)->where('year_id',$std->year_id)->where('class_id',$std->class_id)->where('fee_category_id',$fee_category_id)->where('date',$date)->first();
            if ($accountstudentfee != null) {
                $checked = 'checked';
            }else{
                $checked = '';
            }
            $color = 'success';
            $html[$key]['tdsource'] = '<td>' .$std['student']['id_no']. '<input type="hidden" name="fee_category_id" value="'.$std->fee_category_id.'">'.'</td>';

            $html[$key]['tdsource'] .= '<td>' .$std['student']['name']. '<input type="hidden" name="year_id" value="'.$std->year_id.'">'.'</td>';


            $html[$key]['tdsource'] .= '<td>' .$std['student']['fname']. '<input type="hidden" name="class_id" value="'.$std->class_id.'">'.'</td>';


            $html[$key]['tdsource'] .= '<td>' .$studentfee->amount. 'TK' . '<input type="hidden" name="date" value="'.$date.'">'.'</td>';


            $html[$key]['tdsource'] .= '<td>' .$std['discount']['discount'].'%'.'</td>';


            $originalfee = $studentfee->amount;
            $discount = $std['discount']['discount'];
            $discountablefee = $discount/100*$originalfee;
            $finalfee = (int)$originalfee-(int)$discountablefee;
            $html[$key]['tdsource'] .= '<td>'. '<input type="text" name="amount[]" value="'.$finalfee.'" class="form-control" readonly>' .'</td>';

            $html[$key]['tdsource'] .= '<td>'. '<input type="hidden" name="student_id[]" value="'.$std->student_id.'" >' . '<input type="checkbox" name="checkmanager[]" value="'.$key.'"'.$checked.' style="transform:scale(1.5);margin-left:10px;" >' .'</td>';

        }

        return response()->json(@$html);

    }

    public function store(Request $request)
    {    
        $date = date('Y-m',strtotime($request->date));
        AccountStudentFee::where('year_id',$request->year_id)
                        ->where('class_id',$request->class_id)
                        ->where('fee_category_id',$request->fee_category_id)
                        ->where('date',$date)->delete();
        $checkdata = $request->checkmanager;
        if ($checkdata != null) {
            for ($i=0; $i <count($checkdata) ; $i++) { 
                $data = new AccountStudentFee();
                $data->year_id = $request->year_id;
                $data->class_id = $request->class_id;
                $data->date = $date;
                $data->fee_category_id = $request->fee_category_id;
                $data->student_id = $request->student_id[$checkdata[$i]];
                $data->amount = $request->amount[$checkdata[$i]];
                dd($data->toArray());
                $data->save();

            }
        }
        if (!empty($data) || empty($checkdata)) {
            return redirect()->route('accounts.fee.view')->with('success','well done successfully');
        }else{
            return redirect()->back()->with('error','sorry data not save');
        }



    }













}
