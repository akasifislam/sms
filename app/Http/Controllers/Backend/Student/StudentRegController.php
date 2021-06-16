<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AsignStudent;
use App\Model\DiscountStudent;
use App\User;
use App\Model\StudentClass;
use App\Model\Group;
use App\Model\StudentShift;
use App\Model\Year;
use Illuminate\Support\Facades\DB;
use PDF;
class StudentRegController extends Controller
{
    public function view()
    {
        
        $data['years'] = Year::orderBy('id','DESC')->get();
        $data['year_id'] = Year::orderBy('id','DESC')->first()->id;
        $data['class_id'] = StudentClass::orderBy('id','asc')->first()->id;
        $data['classes'] = StudentClass::all();
        $data['allData'] = AsignStudent::where('year_id',$data['year_id'])->where('class_id',$data['class_id'])->get();
        return view('backend.student.student_reg_card.view-student',$data);
    }
    public function yearCalassWise(Request $request)
    {
        $data['years'] = Year::orderBy('id','DESC')->get();
        $data['year_id'] = $request->year_id;
        $data['class_id'] = $request->class_id;
        $data['classes'] = StudentClass::all();
        $data['allData'] = AsignStudent::where('year_id',$request->year_id)->where('class_id',$request->class_id)->get();
        return view('backend.student.student_reg_card.view-student',$data);
    }

    public function add()
    {
        $data['classes'] = StudentClass::all();
        $data['groups'] = Group::all();
        $data['shifts'] = StudentShift::all();
        $data['years'] = Year::orderBy('id','DESC')->get();
        return view('backend.student.student_reg_card.add-student',$data);
    }
    public function store(Request $request)
    {
        DB::transaction(function () use($request) {
            $checkYear = Year::find($request->year_id)->name;
            $student = User::where('usertype','student')->orderBy('id','DESC')->first();
            if($student == null){
                $firstReg = 0;
                $studentId = $firstReg+1;
                if($studentId < 10){
                    $id_no = '000'.$studentId;
                }elseif($studentId<100){
                    $id_no = '00'.$studentId;
                }elseif($studentId<1000){
                    $id_no = '0'.$studentId;
                }
            }else{
                $student = User::where('usertype','student')->orderBy('id','DESC')->first()->id;
                $studentId = $student+1;
                if($studentId<10){
                    $id_no = '000'.$studentId;
                }elseif($studentId<100){
                    $id_no = '00'.$studentId;
                }elseif($studentId<1000){
                    $id_no = '0'.$studentId;
                }
            }
            $final_id_no = $checkYear.$id_no;
            $user = new User();
            $code = rand(0000,9999);
            $user->id_no = $final_id_no;
            $user->password = bcrypt($code);
            $user->usertype= 'student';
            $user->code = $code;
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender= $request->gender;
            $user->dob= date('Y-m-d',strtotime($request->dob));
            if ($request->file('image')) {
                $file= $request->file('image');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/student_images'),$filename);
                $user['image'] = $filename;
            }
            $user->religion= $request->religion;
            $user->save();
            $asign_student = new AsignStudent();
            $asign_student->student_id = $user->id;
            $asign_student->year_id= $request->year_id;
            $asign_student->class_id= $request->class_id;
            $asign_student->group_id= $request->group_id;
            $asign_student->shift_id= $request->shift_id;
            $asign_student->save();

            $discount_student= new DiscountStudent();
            $discount_student->asign_student_id = $asign_student->id;
            $discount_student->fee_category_id = '1';
            $discount_student->discount= $request->discount;

            $discount_student->save();
            
            
        });
        return redirect()->route('students.reg.view')->with('success','Data Inserted');

        
    }

    public function edit($student_id)
    {
        $data['editData'] = AsignStudent::where('student_id',$student_id)->first();
        // dd($data['editData']->toArray());
        $data['classes'] = StudentClass::all();
        $data['groups'] = Group::all();
        $data['shifts'] = StudentShift::all();
        $data['years'] = Year::orderBy('id','DESC')->get();
        return view('backend.student.student_reg_card.add-student',$data);
    }

    public function update(Request $request,$student_id)
    {
       
        DB::transaction(function () use($request,$student_id) {
            
            $user = User::where('id',$student_id)->first();

            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender= $request->gender;
            $user->dob= date('Y-m-d',strtotime($request->dob));
            if ($request->file('image')) {
                $file= $request->file('image');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/student_images'),$filename);
                $user['image'] = $filename;
            }
            $user->religion= $request->religion;
            $user->save();
            $asign_student = AsignStudent::where('id',$request->id)->where('student_id',$student_id)->first();
            
            $asign_student->year_id= $request->year_id;
            $asign_student->class_id= $request->class_id;
            $asign_student->group_id= $request->group_id;
            $asign_student->shift_id= $request->shift_id;
            $asign_student->save();

            $discount_student= DiscountStudent::where('asign_student_id',$request->id)->first();
            $discount_student->discount= $request->discount;

            $discount_student->save();
            
            
        });
        return redirect()->route('students.reg.view')->with('success','Data Inserted');
        
    }

    public function promotion($student_id)
    {
        $data['editData'] = AsignStudent::with(['student','discount'])->where('student_id',$student_id)->first();
        $data['classes'] = StudentClass::all();
        $data['groups'] = Group::all();
        $data['shifts'] = StudentShift::all();
        $data['years'] = Year::orderBy('id','DESC')->get();
        return view('backend.student.student_reg_card.promotion-student',$data);
    }
    public function promotionStore(Request $request,$student_id)
    {
        DB::transaction(function () use($request,$student_id) {
            
            $user = User::where('id',$student_id)->first();

            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender= $request->gender;
            $user->dob= date('Y-m-d',strtotime($request->dob));
            if ($request->file('image')) {
                $file= $request->file('image');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/student_images'),$filename);
                $user['image'] = $filename;
            }
            $user->religion= $request->religion;
            $user->save();
            $asign_student =new AsignStudent();
            $asign_student->student_id= $student_id;
            $asign_student->year_id= $request->year_id;
            $asign_student->class_id= $request->class_id;
            $asign_student->group_id= $request->group_id;
            $asign_student->shift_id= $request->shift_id;
            $asign_student->save();

            $discount_student=new DiscountStudent();
            $discount_student->asign_student_id= $asign_student->id;
            $discount_student->fee_category_id= '1';
            $discount_student->discount= $request->discount;

            $discount_student->save();
            
            
        });
        return redirect()->route('students.reg.view')->with('success','Data Promoted');
        
    }

    public function details($student_id)
    {
        
        $data['details']= AsignStudent::with(['student','discount'])->where('student_id',$student_id)->first();
        // dd($data['details']->toArray());
        $pdf = \PDF::loadView('backend.student.student_reg_card.student-details-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }


    
        
    
    
    
    
    
    
    
    
    
    function generate_pdf() {
       
    }



}
