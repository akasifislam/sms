<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Model\StudentClass;
use App\Model\Year;
use Illuminate\Http\Request;
use DB;

class StudentYearController extends Controller
{
    public function view()
    {
        
        $data['allData'] = Year::all();
        return view('backend.setup.student_year.view-year',$data);
    }

    public function add()
    {
        
        return view('backend.setup.student_year.add-year');
    }
    public function store(Request $request)
    {
      

        $this->validate($request,[
            'name' => 'required|unique:years,name',
        ]);
        $data = new Year();
        $data->name = $request->name;
        $data->save();
        return redirect()->route('setpus.student.year.view')->with('success','Data Updated');
    }

    public function edit($id)
    {
        
        
        $editData = Year::find($id);
        return view('backend.setup.student_year.add-year',compact('editData'));
    }

    public function update(Request $request,$id)
    {
        
        $data =  Year::find($id);
        $data->name = $request->name;
        $data->save();
        return redirect()->route('setpus.student.year.view')->with('success','Data Updated');
    }

    public function deleteid($id)
    {
        
        $user = StudentClass::find($id);
        $user->delete();
        return redirect()->route('setpus.student.class.view')->with('success','Data Delete successfully');
    }
}
