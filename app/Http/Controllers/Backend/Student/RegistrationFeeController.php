<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AsignStudent;
use App\Model\DiscountStudent;
use App\Model\FeeCategoryAmount;
use App\User;
use App\Model\StudentClass;
use App\Model\Group;
use App\Model\StudentShift;
use App\Model\Year;
use Illuminate\Support\Facades\DB;
use PDF;

class RegistrationFeeController extends Controller
{
    public function view()
    {
        
        $data['years'] = Year::orderBy('id','DESC')->get();
        $data['classes'] = StudentClass::all();
        return view('backend.student.registration_fee.view-reg-fee',$data);
    }

    public function getStudent(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        if ($year_id != '') {
            $where[] = ['year_id','like',$year_id.'%'];
        }
        if ($class_id != '') {
            $where[] = ['class_id','like',$class_id.'%'];
        }

        $all_student = AsignStudent::with(['discount'])->where($where)->get();

        $html['thsource'] =  '<th> SL </th>' ;
        $html['thsource'] .= '<th> ID No  </th>' ;
        $html['thsource'] .= '<th> Student Name </th>' ;
        $html['thsource'] .= '<th> Roll No </th>' ;
        $html['thsource'] .= '<th> Registration fee </th>' ;
        $html['thsource'] .= '<th> Discount Amount </th> ';
        $html['thsource'] .= '<th> Fee (This student) </th>' ;
        $html['thsource'] .= '<th> Action </th>' ;

        foreach ($all_student as $key => $v) {
            $registrationfee = FeeCategoryAmount:: where('fee_category_id','1')->where('class_id',$v->class_id)->first();
            $color = 'success';
                $html[$key]['tdsource'] = '<td>' . ($key+1) . '</td>';
                $html[$key]['tdsource'] .= '<td>' . $v['student']['id_no'] . '</td>';
                $html[$key]['tdsource'] .= '<td>' . $v['student']['name'] . '</td>';
                $html[$key]['tdsource'] .= '<td>' . $v->roll . '</td>';
                $html[$key]['tdsource'] .= '<td>' . $registrationfee->amount . 'TK' .'</td>';
                $html[$key]['tdsource'] .= '<td>' . $v['discount']['discount'] .'%' .'</td>';

                $originalfee = $registrationfee->amount;
                $discount = $v['discount']['discount'];
                $discountablefee = $discount/100*$originalfee;
                $finalfee = (float)$originalfee-(float)$discountablefee;
                $html[$key]['tdsource'] .= '<td>' . $finalfee .  '</td>';
                $html[$key]['tdsource'] .= '<td>';
                $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-'.$color.'" title="Payship" target="_blank" href="'.route("students.reg.fee.paysleep").'?class_id='.$v->class_id.'&student_id='.$v->student_id.'">Fee Slip</a>';
                $html[$key]['tdsource'] .= '</td>';                
        }

        return response()->json(@$html);

       
    }

    public function paysleep(Request $request)
    {
        $studennt_id = $request->student_id;
        $class_id = $request->class_id;
        $all_student['details'] =  AsignStudent::with(['discount','student'])->where('student_id',$studennt_id)->where('class_id',$class_id)->first();
        $pdf = \PDF::loadView('backend.student.registration_fee.reg-fee-pay-pdf',$all_student);
        $pdf->SetProtection(['copy','print'],'','pass');
        return $pdf->stream('document.pdf');

    }

    public function store(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;

        if ($request->student_id != null) {
            for ($i=0; $i <count($request->student_id) ; $i++) { 
                AsignStudent::where('year_id',$request->year_id)->where('class_id',$request->class_id)->where('student_id',$request->student_id[$i])->update(['roll' => $request->roll[$i]]);
            }
        }else{
            return redirect()->back()->with('error','sorry there ar no stdnt');
        }
        return redirect()->route('students.roll.view')->with('success','successfully roll generatedly');


    }
}
