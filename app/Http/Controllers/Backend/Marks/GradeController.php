<?php

namespace App\Http\Controllers\Backend\Marks;

use App\Http\Controllers\Controller;
use App\Model\MarksGrade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function view()
    {
        $data['allData'] = MarksGrade::all();
        return view('backend.marks.marks_point.view-marks-point',$data);
    }
    public function add()
    {
        return view('backend.marks.marks_point.add-marks-point');
        
    }
    public function store(Request $request)
    {
        $data = new MarksGrade();
        $data->grade_name = $request->grade_name;
        $data->grade_point = $request->grade_point;
        $data->start_marks = $request->start_marks;
        $data->end_marks = $request->end_marks;
        $data->start_point = $request->start_point;
        $data->end_point = $request->end_point;
        $data->remarks = $request->remarks;
        $data->save();
        return redirect()->route('student.grade.point.view')->with('success','Store successfully');
    }

    public function edit($id)
    {
        // dd('edit');
        $editData = MarksGrade::find($id);
        return view('backend.marks.marks_point.add-marks-point',compact('editData'));

        
    }

    public function update(Request $request,$id)
    {
        $data = MarksGrade::find($id);
        $data->grade_name = $request->grade_name;
        $data->grade_point = $request->grade_point;
        $data->start_marks = $request->start_marks;
        $data->end_marks = $request->end_marks;
        $data->start_point = $request->start_point;
        $data->end_point = $request->end_point;
        $data->remarks = $request->remarks;
        $data->save();
        return redirect()->route('student.grade.point.view')->with('success','updated successfully');
    }







}
