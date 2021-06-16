<?php

namespace App\Http\Controllers\Backend\Marks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AsignStudent;
use App\Model\DiscountStudent;
use App\Model\ExamType;
use App\User;
use App\Model\StudentClass;
use App\Model\Group;
use App\Model\StudentMarks;
use App\Model\StudentShift;
use App\Model\Year;
use Illuminate\Support\Facades\DB;
use PDF;

class MarksController extends Controller
{
    public function add()
    {
        $data['years'] = Year::orderBy('id','DESC')->get();
        $data['classes'] = StudentClass::all();
        $data['exam_type'] = ExamType::all();
        return view('backend.marks.add-marks',$data);
    }

    public function store(Request $request)
    {
        $studentcount = $request->student_id;
        if ($studentcount) {
            for ($i=0; $i <count($request->student_id) ; $i++) { 
                $data = new StudentMarks();
                $data->year_id = $request->year_id;
                $data->class_id = $request->class_id;
                $data->asign_subject_id = $request->asign_subject_id;
                $data->exam_type_id = $request->exam_type_id;
                $data->student_id = $request->student_id[$i];
                $data->id_no = $request->id_no[$i];
                $data->marks = $request->marks[$i];
                $data->save();
                
            }
        }
        return redirect()->back()->with('success','marks inserted succressfully');
        
    }


    public function edit()
    {
        $data['years'] = Year::orderBy('id','DESC')->get();
        $data['classes'] = StudentClass::all();
        $data['exam_type'] = ExamType::all();
        return view('backend.marks.edit-marks',$data);
        
    }

    public function marksEdit(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $asign_subject_id = $request->asign_subject_id;
        $exam_type_id = $request->exam_type_id;

        $getSyudent = StudentMarks::with(['student'])->where('year_id',$year_id)
                                                    ->where('class_id',$class_id)
                                                    ->where('asign_subject_id',$asign_subject_id)
                                                    ->where('exam_type_id',$exam_type_id)->get();
        return response()->json($getSyudent);
        
    }

    public function update(Request $request)
    {
        StudentMarks::where('year_id',$request->year_id)
                                    ->where('class_id',$request->class_id)
                                    ->where('asign_subject_id',$request->asign_subject_id)
                                    ->where('exam_type_id',$request->exam_type_id)->delete();
        $studentcount = $request->student_id;
        if ($studentcount) {
            for ($i=0; $i <count($request->student_id) ; $i++) { 
                $data = new StudentMarks();
                $data->year_id = $request->year_id;
                $data->class_id = $request->class_id;
                $data->asign_subject_id = $request->asign_subject_id;
                $data->exam_type_id = $request->exam_type_id;
                $data->student_id = $request->student_id[$i];
                $data->id_no = $request->id_no[$i];
                $data->marks = $request->marks[$i];
                $data->save();
                
            }
        }
        return redirect()->back()->with('success','marks inserted succressfully');
        
    }













}
