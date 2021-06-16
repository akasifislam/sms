<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Model\FeeCategory;
use Illuminate\Http\Request;

class FeeCategoryController extends Controller
{
    public function view()
    {
        // dd('srfsrg');
        $data['allData'] = FeeCategory::all();
        return view('backend.setup.student_fee.view-fee-category',$data);
    }

    public function add()
    {
        
        return view('backend.setup.student_fee.add-fee-category');
    }
    public function store(Request $request)
    {
      

        $this->validate($request,[
            'name' => 'required|unique:fee_categories,name',
        ]);
        $data = new FeeCategory();
        $data->name = $request->name;
        $data->save();
        return redirect()->route('setpus.fee.category.view')->with('success','Data Updated');
    }

    public function edit($id)
    {
        
        
        $editData = FeeCategory::find($id);
        return view('backend.setup.student_fee.add-fee-category',compact('editData'));
    }

    public function update(Request $request,$id)
    {
        
        $data =  FeeCategory::find($id);
        $data->name = $request->name;
        $data->save();
        return redirect()->route('setpus.fee.category.view')->with('success','Data Updated');
    }
}
