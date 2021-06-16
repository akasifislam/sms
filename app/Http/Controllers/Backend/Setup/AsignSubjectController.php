<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Model\AsignSubject;
use App\Model\ExamType;
use App\Model\FeeCategory;
use App\Model\FeeCategoryAmount;
use App\Model\StudentClass;
use App\Model\StudentSubject;
use Illuminate\Http\Request;

class AsignSubjectController extends Controller
{
    public function view()
    {
    
        // dd('dsfdf');
        $data['allData'] = AsignSubject::select('class_id')->groupBy('class_id')->get();
        return view('backend.setup.asign_subject.view-asign-subject',$data);
    }

    public function add()
    {  
        // dd('dfsdfsdfs');
        $data['subjects'] = StudentSubject::all();
        $data['classes'] = StudentClass::all();

       
        return view('backend.setup.asign_subject.add-asign-subject',$data);
    }
    public function store(Request $request)
    { 
        
        
        $subjectCount = count($request->subject_id);
        if($subjectCount != NULL){

            for ($i=0; $i <$subjectCount; $i++) { 
                $asign_subject = new AsignSubject();
                $asign_subject->class_id = $request->class_id;
                $asign_subject->subject_id = $request->subject_id[$i];
                $asign_subject->full_mark = $request->full_mark[$i];
                $asign_subject->pass_mark = $request->pass_mark[$i];
                $asign_subject->subjective_mark = $request->subjective_mark[$i];
                $asign_subject->save();
            }
            return redirect()->route('setpus.asign.subject.view')->with('success','Data Updated');
        }
    }

    public function edit($class_id)
    {
        
        // dd('ffd');
        $data['editData'] = AsignSubject::where('class_id',$class_id)->get();
        $data['subjects'] = StudentSubject::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.asign_subject.edit-asign-subject',$data);
    }
    public function update(Request $request,$class_id)
    {
        if ($request->subject_id==NULL) {
            return redirect()->back()->with('error','sorry');
        }else{
            AsignSubject::whereNotIn('subject_id',$request->subject_id)->where('class_id',$request->class_id)->delete();

            foreach ($request->subject_id as $key => $value) {
                $asign_subject_exist = AsignSubject::where('subject_id',$request->subject_id[$key])->where('class_id',$request->class_id)->first();
                    if ($asign_subject_exist) {
                        $asignSubjects = $asign_subject_exist;
                    }else{
                        $asignSubjects = new AsignSubject();
                    }
                    $asignSubjects->class_id = $request->class_id;
                    $asignSubjects->subject_id = $request->subject_id[$key];
                    $asignSubjects->full_mark = $request->full_mark[$key];
                    $asignSubjects->pass_mark = $request->pass_mark[$key];
                    $asignSubjects->subjective_mark = $request->subjective_mark[$key]; 
                    $asignSubjects->save();
                }
        }
        return redirect()->route('setpus.asign.subject.view')->with('success','successfully');


        


            
        



















        
    }

    



















    public function details($class_id)
    {
        
        $data['editData'] = AsignSubject::where('class_id',$class_id)->get();
        return view('backend.setup.asign_subject.details-asign-subject',$data);
        
    }
}
