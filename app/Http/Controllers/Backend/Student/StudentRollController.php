<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Model\AsignStudent;
use App\Model\DiscountStudent;
use App\User;
use App\Model\StudentClass;
use App\Model\Group;
use App\Model\StudentShift;
use App\Model\Year;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Http\Request;

class StudentRollController extends Controller
{
    public function view()
    {
        
        $data['years'] = Year::orderBy('id','DESC')->get();
        $data['classes'] = StudentClass::all();
        return view('backend.student.student_roll.view-studentroll',$data);
    }

    public function getStudent(Request $request)
    {
       $allData = AsignStudent::with(['student'])->where('year_id',$request->year_id)->where('class_id',$request->class_id)->get();
        return response()->json($allData);
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
