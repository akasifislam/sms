<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Model\ExamType;
use App\Model\StudentClass;
use App\Model\StudentSubject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function view()
    {
        $data['allData'] = StudentSubject::all();
        return view('backend.setup.student_subject.view-student-subject',$data);
    }

    public function add()
    {
        
        return view('backend.setup.student_subject.add-student-subject');
    }
    public function store(Request $request)
    {
      

        $this->validate($request,[
            'name' => 'required|unique:student_subjects,name',
        ]);
        $data = new StudentSubject();
        $data->name = $request->name;
        $data->save();
        return redirect()->route('setpus.subject.view')->with('success','Data Updated');
    }

    public function edit($id)
    {
        
        
        $editData = StudentSubject::find($id);
        return view('backend.setup.student_subject.add-student-subject',compact('editData'));
    }

    public function update(Request $request,$id)
    {
        
        $data =  StudentSubject::find($id);
        $data->name = $request->name;
        $data->save();
        return redirect()->route('setpus.subject.view')->with('success','Data Updated');
    }

    public function deleteid($id)
    {
        
        $user = StudentClass::find($id);
        $user->delete();
        return redirect()->route('setpus.student.class.view')->with('success','Data Delete successfully');
    }
}
