<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Model\StudentClass;
use App\Model\StudentShift;
use App\Model\Year;
use DB;
use Illuminate\Http\Request;

class StudentShiftController extends Controller
{
    public function view()
    {
        
        $data['allData'] = StudentShift::all();
        return view('backend.setup.student_shift.view-shift',$data);
    }

    public function add()
    {
        return view('backend.setup.student_shift.add-shift');
    }
    public function store(Request $request)
    {
      

        $this->validate($request,[
            'name' => 'required|unique:student_shifts,name',
        ]);
        $data = new StudentShift();
        $data->name = $request->name;
        $data->save();
        return redirect()->route('setpus.student.shift.view')->with('success','Data Updated');
    }

    public function edit($id)
    {
               
        
        $editData = StudentShift::find($id);
        return view('backend.setup.student_shift.add-shift',compact('editData'));
    }

    public function update(Request $request,$id)
    {
        
        $data =  StudentShift::find($id);
        $data->name = $request->name;
        $data->save();
        return redirect()->route('setpus.student.shift.view')->with('success','Data Updated');
    }

    public function deleteid($id)
    {
        
        $user = StudentClass::find($id);
        $user->delete();
        return redirect()->route('setpus.student.class.view')->with('success','Data Delete successfully');
    }
}
