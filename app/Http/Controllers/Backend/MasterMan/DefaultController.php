<?php

namespace App\Http\Controllers\Backend\MasterMan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AsignStudent;
use App\Model\AsignSubject;
use App\Model\DiscountStudent;
use App\User;
use App\Model\EmployeeSalaryLog;
use App\Model\Designation;
use App\Model\StudentClass;
use App\Model\Group;
use App\Model\LeavePurPose;
use App\Model\EmployeeAttendance;
use App\Model\EmployeeLeave;
use App\Model\StudentShift;
use App\Model\Year;
use Illuminate\Support\Facades\DB;
use PDF;

class DefaultController extends Controller
{
    public function getStudent(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $allData = AsignStudent::with(['student'])->where('year_id',$year_id)->where('class_id',$class_id)->get();
        return response()->json($allData);

    }
    public function getSubject(Request $request)
    {
        $class_id = $request->class_id;
        $allData = AsignSubject::with(['subject'])->where('class_id',$class_id)->get();
        return response()->json($allData);
    }
}
