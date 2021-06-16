<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Model\ExamType;
use App\Model\StudentClass;
use App\Model\Year;
use Illuminate\Http\Request;

class ExamTypeController extends Controller
{
    public function view()
    {
        // dd('exam view');
        $data['allData'] = ExamType::all();
        return view('backend.setup.exam_type.view-exam-type',$data);
    }

    public function add()
    {
        
        return view('backend.setup.exam_type.add-exam-type');
    }
    public function store(Request $request)
    {
      

        $this->validate($request,[
            'name' => 'required|unique:exam_types,name',
        ]);
        $data = new ExamType();
        $data->name = $request->name;
        $data->save();
        return redirect()->route('setpus.exam.type.view')->with('success','Data Updated');
    }

    public function edit($id)
    {
        
        
        $editData = ExamType::find($id);
        return view('backend.setup.exam_type.add-exam-type',compact('editData'));
    }

    public function update(Request $request,$id)
    {
        
        $data =  ExamType::find($id);
        $data->name = $request->name;
        $data->save();
        return redirect()->route('setpus.exam.type.view')->with('success','Data Updated');
    }

    public function deleteid($id)
    {
        
        $user = StudentClass::find($id);
        $user->delete();
        return redirect()->route('setpus.student.class.view')->with('success','Data Delete successfully');
    }
}
