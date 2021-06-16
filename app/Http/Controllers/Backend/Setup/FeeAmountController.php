<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Model\FeeCategory;
use App\Model\FeeCategoryAmount;
use App\Model\Group;
use App\Model\StudentClass;
use DB;
use Illuminate\Http\Request;

class FeeAmountController extends Controller
{
    public function view()
    {
        // dd('srfsrg');
        $data['allData'] = FeeCategoryAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
        return view('backend.setup.student_fee_amount.view-fee-amount',$data);
    }

    public function add()
    {  
        $data['fee_categories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();

       
        return view('backend.setup.student_fee_amount.add-fee-amount',$data);
    }
    public function store(Request $request)
    { 
        
        
        $countClass = count($request->class_id);
        if($countClass != NULL){
            for ($i=0; $i <$countClass; $i++) { 
                $fee_amount = new FeeCategoryAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();
                return redirect()->route('setpus.fee.amount.view')->with('success','Data Updated');
            }
        }
    }

    public function edit($fee_category_id)
    {
        
        
        $data['editData'] = FeeCategoryAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id','asc')->get();
        $data['fee_categories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.student_fee_amount.edit-fee-amount',$data);
    }

    public function update(Request $request,$fee_category_id)
    {
        if ($request->class_id==NULL) {
            return redirect()->back()->with('error','sorry');
        }else{
            FeeCategoryAmount::where('fee_category_id',$fee_category_id)->delete();
            $countClass = count($request->class_id);
            
                for ($i=0; $i < $countClass; $i++) { 
                    $fee_amount = new FeeCategoryAmount();
                    $fee_amount->fee_category_id = $request->fee_category_id;
                    $fee_amount->class_id = $request->class_id[$i];
                    $fee_amount->amount = $request->amount[$i];
                    $fee_amount->save();
                }
            
        }

        return redirect()->route('setpus.fee.amount.view')->with('success','Data Updated');
    }
    public function details($fee_category_id)
    {
        
        $data['editData'] = FeeCategoryAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id','asc')->get();
        return view('backend.setup.student_fee_amount.details-fee-amount',$data);
        
    }
}
