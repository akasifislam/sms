<?php

namespace App\Http\Controllers\Backend\setup;

use App\Http\Controllers\Controller;
use App\Model\StudentClass;
use App\Model\Year;
use App\Model\Group;
use DB;
use Illuminate\Http\Request;

class StudentGroupController extends Controller
{
    public function view()
    {
        $data['allData'] = Group::all();
        return view('backend.setup.student_group.view-group',$data);
    }

    public function add()
    {
        // dd('df');
        return view('backend.setup.student_group.add-group');
    }
    public function store(Request $request)
    {
      

        $this->validate($request,[
            'name' => 'required|unique:groups,name',
        ]);
        $data = new Group();
        $data->name = $request->name;
        $data->save();
        return redirect()->route('setpus.student.gropu.view')->with('success','Data Updated');
    }

    public function edit($id)
    {
        $editData = Group::find($id);
        return view('backend.setup.student_group.add-group',compact('editData'));
    }

    public function update(Request $request,$id)
    {
        
        $data =  Group::find($id);
        $data->name = $request->name;
        $data->save();
        return redirect()->route('setpus.student.gropu.view')->with('success','Data Updated');
    }

    public function deleteid($id)
    {
        
        $user = StudentClass::find($id);
        $user->delete();
        return redirect()->route('setpus.student.class.view')->with('success','Data Delete successfully');
    }
}
