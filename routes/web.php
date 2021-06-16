<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// backend routing

Route::group(['middleware' => ['auth']], function () {
    Route::prefix('users')->group(function(){

        Route::get('/view','Backend\UserController@view')->name('users.view');
        Route::get('/add','Backend\UserController@add')->name('users.add');
        Route::post('/store','Backend\UserController@store')->name('users.store');
        Route::get('/edit/{id}','Backend\UserController@edit')->name('users.edit');
        Route::post('/update/{id}','Backend\UserController@update')->name('users.update');
        Route::get('/delete/{id}','Backend\UserController@delete')->name('users.delete');

    });

    Route::prefix('profiles')->group(function(){

        Route::get('/store','Backend\ProfileController@view')->name('profiles.view');
        Route::get('/view','Backend\ProfileController@edit')->name('profiles.edit');
        Route::post('/add','Backend\ProfileController@update')->name('profiles.update');
        Route::get('/password/view','Backend\ProfileController@passwordView')->name('profiles.password.view');
        Route::post('/password/update','Backend\ProfileController@passwordUpdate')->name('profiles.password.update');
        
    });

    Route::prefix('setpus')->group(function(){
        //student class routing
        Route::get('/student/class/view','Backend\Setup\StudentClassController@view')->name('setpus.student.class.view');
        Route::get('/student/class/add','Backend\Setup\StudentClassController@add')->name('setpus.student.class.add');
        Route::post('/student/class/store','Backend\Setup\StudentClassController@store')->name('setpus.student.class.store');
        Route::get('/student/class/edit/{id}','Backend\Setup\StudentClassController@edit')->name('setpus.student.class.edit');
        Route::post('/student/class/update/{id}','Backend\Setup\StudentClassController@update')->name('setpus.student.class.update');
        Route::get('/student/class/delete/{id}','Backend\Setup\StudentClassController@deleteid')->name('setpus.student.class.delete');
        //student year routing
        Route::get('/student/year/view','Backend\Setup\StudentYearController@view')->name('setpus.student.year.view');
        Route::get('/student/year/add','Backend\Setup\StudentYearController@add')->name('setpus.student.year.add');
        Route::post('/student/year/store','Backend\Setup\StudentYearController@store')->name('setpus.student.year.store');
        Route::get('/student/year/edit/{id}','Backend\Setup\StudentYearController@edit')->name('setpus.student.year.edit');
        Route::post('/student/year/update/{id}','Backend\Setup\StudentYearController@update')->name('setpus.student.year.update');
        Route::get('/student/year/delete/{id}','Backend\Setup\StudentYearController@deleteid')->name('setpus.student.year.delete');
        //student group routing
        Route::get('/student/group/view','Backend\Setup\StudentGroupController@view')->name('setpus.student.gropu.view');
        Route::get('/student/group/add','Backend\Setup\StudentGroupController@add')->name('setpus.student.gropu.add');
        Route::post('/student/group/store','Backend\Setup\StudentGroupController@store')->name('setpus.student.gropu.store');
        Route::get('/student/group/edit/{id}','Backend\Setup\StudentGroupController@edit')->name('setpus.student.gropu.edit');
        Route::post('/student/group/update/{id}','Backend\Setup\StudentGroupController@update')->name('setpus.student.gropu.update');
        Route::get('/student/group/delete/{id}','Backend\Setup\StudentGroupController@deleteid')->name('setpus.student.gropu.delete');
        //student shift routing
        Route::get('/student/shift/view','Backend\Setup\StudentShiftController@view')->name('setpus.student.shift.view');
        Route::get('/student/shift/add','Backend\Setup\StudentShiftController@add')->name('setpus.student.shift.add');
        Route::post('/student/shift/store','Backend\Setup\StudentShiftController@store')->name('setpus.student.shift.store');
        Route::get('/student/shift/edit/{id}','Backend\Setup\StudentShiftController@edit')->name('setpus.student.shift.edit');
        Route::post('/student/shift/update/{id}','Backend\Setup\StudentShiftController@update')->name('setpus.student.shift.update');
        Route::get('/student/shift/delete/{id}','Backend\Setup\StudentShiftController@deleteid')->name('setpus.student.shift.delete');
        //student fee category routing
        Route::get('/student/fee/category/view','Backend\Setup\FeeCategoryController@view')->name('setpus.fee.category.view');
        Route::get('/student/fee/category/add','Backend\Setup\FeeCategoryController@add')->name('setpus.fee.category.add');
        Route::post('/student/fee/category/store','Backend\Setup\FeeCategoryController@store')->name('setpus.fee.category.store');
        Route::get('/student/fee/category/edit/{id}','Backend\Setup\FeeCategoryController@edit')->name('setpus.fee.category.edit');
        Route::post('/student/fee/category/update/{id}','Backend\Setup\FeeCategoryController@update')->name('setpus.fee.category.update');
        Route::get('/student/fee/category/delete/{id}','Backend\Setup\FeeCategoryController@deleteid')->name('setpus.fee.category.delete');
        //student fee category amount routing
        Route::get('/student/fee/amount/view','Backend\Setup\FeeAmountController@view')->name('setpus.fee.amount.view');
        Route::get('/student/fee/amount/add','Backend\Setup\FeeAmountController@add')->name('setpus.fee.amount.add');
        Route::post('/student/fee/amount/store','Backend\Setup\FeeAmountController@store')->name('setpus.fee.amount.store');
        Route::get('/student/fee/amount/edit/{fee_category_id}','Backend\Setup\FeeAmountController@edit')->name('setpus.fee.amount.edit');
        Route::post('/student/fee/amount/update/{fee_category_id}','Backend\Setup\FeeAmountController@update')->name('setpus.fee.amount.update');
        Route::get('/student/fee/amount/details/{fee_category_id}','Backend\Setup\FeeAmountController@details')->name('setpus.fee.amount.details');
        //exam type routing
        Route::get('/student/exam/type/view','Backend\Setup\ExamTypeController@view')->name('setpus.exam.type.view');
        Route::get('/student/exam/type/add','Backend\Setup\ExamTypeController@add')->name('setpus.exam.type.add');
        Route::post('/student/exam/type/store','Backend\Setup\ExamTypeController@store')->name('setpus.exam.type.store');
        Route::get('/student/exam/type/edit/{fee_category_id}','Backend\Setup\ExamTypeController@edit')->name('setpus.exam.type.edit');
        Route::post('/student/exam/type/update/{fee_category_id}','Backend\Setup\ExamTypeController@update')->name('setpus.exam.type.update');
        //subject
        Route::get('/subject/type/view','Backend\Setup\SubjectController@view')->name('setpus.subject.view');
        Route::get('/subject/type/add','Backend\Setup\SubjectController@add')->name('setpus.subject.add');
        Route::post('/subject/type/store','Backend\Setup\SubjectController@store')->name('setpus.subject.store');
        Route::get('/subject/type/edit/{fee_category_id}','Backend\Setup\SubjectController@edit')->name('setpus.subject.edit');
        Route::post('/subject/type/update/{fee_category_id}','Backend\Setup\SubjectController@update')->name('setpus.subject.update');
        //asign subject
        Route::get('/asign/subject/type/view','Backend\Setup\AsignSubjectController@view')->name('setpus.asign.subject.view');
        Route::get('/asign/subject/type/add','Backend\Setup\AsignSubjectController@add')->name('setpus.asign.subject.add');
        Route::post('/asign/subject/type/store','Backend\Setup\AsignSubjectController@store')->name('setpus.asign.subject.store');
        Route::get('/asign/subject/type/edit/{class_id}','Backend\Setup\AsignSubjectController@edit')->name('setpus.asign.subject.edit');
        Route::post('/asign/subject/type/update/{class_id}','Backend\Setup\AsignSubjectController@update')->name('setpus.asign.subject.update');
        Route::get('/asign/subject/type/details/{class_id}','Backend\Setup\AsignSubjectController@details')->name('setpus.asign.subject.details');
        //asign subject
        Route::get('/asign/subject/type/view','Backend\Setup\AsignSubjectController@view')->name('setpus.asign.subject.view');
        Route::get('/asign/subject/type/add','Backend\Setup\AsignSubjectController@add')->name('setpus.asign.subject.add');
        Route::post('/asign/subject/type/store','Backend\Setup\AsignSubjectController@store')->name('setpus.asign.subject.store');
        Route::get('/asign/subject/type/edit/{class_id}','Backend\Setup\AsignSubjectController@edit')->name('setpus.asign.subject.edit');
        Route::post('/asign/subject/type/update/{class_id}','Backend\Setup\AsignSubjectController@update')->name('setpus.asign.subject.update');
        Route::get('/asign/subject/type/details/{class_id}','Backend\Setup\AsignSubjectController@details')->name('setpus.asign.subject.details');
        //asign subject
        Route::get('/designation/type/view','Backend\Setup\DesignationController@view')->name('setpus.designation.view');
        Route::get('/designation/type/add','Backend\Setup\DesignationController@add')->name('setpus.designation.add');
        Route::post('/designation/type/store','Backend\Setup\DesignationController@store')->name('setpus.designation.store');
        Route::get('/designation/type/edit/{class_id}','Backend\Setup\DesignationController@edit')->name('setpus.designation.edit');
        Route::post('/designation/type/update/{class_id}','Backend\Setup\DesignationController@update')->name('setpus.designation.update');
        Route::get('/designation/type/details/{class_id}','Backend\Setup\DesignationController@details')->name('setpus.designation.details');
    });

    Route::prefix('students')->group(function(){
        // student registration 
        Route::get('/reg/view','Backend\Student\StudentRegController@view')->name('students.reg.view');
        Route::get('/reg/add','Backend\Student\StudentRegController@add')->name('students.reg.add');
        Route::post('/reg/store','Backend\Student\StudentRegController@store')->name('students.reg.store');
        Route::get('/reg/edit/{student_id}','Backend\Student\StudentRegController@edit')->name('students.reg.edit');
        Route::post('/reg/update/{student_id}','Backend\Student\StudentRegController@update')->name('students.reg.update');
        Route::get('/reg/promotion/{student_id}','Backend\Student\StudentRegController@promotion')->name('students.reg.promotion');
        Route::get('/reg/details/{student_id}','Backend\Student\StudentRegController@details')->name('students.reg.details');
        Route::post('/reg/promotion/store/{student_id}','Backend\Student\StudentRegController@promotionStore')->name('students.reg.promotion.store');
        Route::get('/year-class-wise','Backend\Student\StudentRegController@yearCalassWise')->name('students.year.class.wise');
        // student roll generate 
        Route::get('/roll/view','Backend\Student\StudentRollController@view')->name('students.roll.view');
        Route::get('/roll/get-student','Backend\Student\StudentRollController@getStudent')->name('students.roll.get-student');
        Route::post('/roll/store','Backend\Student\StudentRollController@store')->name('students.roll.store');
        // student registration fee
        Route::get('/reg/fee/view','Backend\Student\RegistrationFeeController@view')->name('students.reg.fee.view');
        Route::get('/reg/fee/get/student','Backend\Student\RegistrationFeeController@getStudent')->name('students.reg.fee.get.student');
        Route::get('/reg/fee/paysleep/student','Backend\Student\RegistrationFeeController@paysleep')->name('students.reg.fee.paysleep');
        // student monthly fee
        Route::get('/month/fee/view','Backend\Student\MonthlyFeeController@view')->name('students.month.fee.view');
        Route::get('/month/fee/get/student','Backend\Student\MonthlyFeeController@getStudent')->name('students.month.fee.get.student');
        Route::get('/month/fee/paysleep/student','Backend\Student\MonthlyFeeController@paysleep')->name('students.month.fee.paysleep');
        // student Exam fee
        Route::get('/exam/fee/view','Backend\Student\ExamFeeController@view')->name('students.exam.fee.view');
        Route::get('/exam/fee/get/student','Backend\Student\ExamFeeController@getStudent')->name('students.exam.fee.get.student');
        Route::get('/exam/fee/paysleep/student','Backend\Student\ExamFeeController@paysleep')->name('students.exam.fee.paysleep');


    });

    Route::prefix('employees')->group(function(){
        // Employee Registration
        Route::get('/reg/view','Backend\Employee\EmployeeRegController@view')->name('employees.reg.view');
        Route::get('/reg/add','Backend\Employee\EmployeeRegController@add')->name('employees.reg.add');
        Route::post('/reg/store','Backend\Employee\EmployeeRegController@store')->name('employees.reg.store');
        Route::get('/reg/edit/{id}','Backend\Employee\EmployeeRegController@edit')->name('employees.reg.edit');
        Route::get('/reg/details/{id}','Backend\Employee\EmployeeRegController@details')->name('employees.reg.details');
        Route::post('/reg/update/{id}','Backend\Employee\EmployeeRegController@update')->name('employees.reg.update');
        Route::get('/reg/delete/{id}','Backend\Employee\EmployeeRegController@delete')->name('employees.reg.delete');
        // Employee Salary
        Route::get('/salary/view','Backend\Employee\EmployeeSalaryController@view')->name('employees.salary.view');
        Route::get('/salary/increment/{id}','Backend\Employee\EmployeeSalaryController@increment')->name('employees.salary.increment');
        Route::get('/salary/details/{id}','Backend\Employee\EmployeeSalaryController@details')->name('employees.salary.details');
        Route::post('/salary/store/{id}','Backend\Employee\EmployeeSalaryController@store')->name('employees.salary.store');

        // Employee Leave
        Route::get('/leave/view','Backend\Employee\EmployeeLeaveController@view')->name('employees.leave.view');
        Route::get('/leave/add','Backend\Employee\EmployeeLeaveController@add')->name('employees.leave.add');
        Route::post('/leave/store','Backend\Employee\EmployeeLeaveController@store')->name('employees.leave.store');
        Route::get('/leave/edit/{id}','Backend\Employee\EmployeeLeaveController@edit')->name('employees.leave.edit');
        Route::post('/leave/update/{id}','Backend\Employee\EmployeeLeaveController@update')->name('employees.leave.update');

        // Employee Attendance
        Route::get('/attendance/view','Backend\Employee\EmployeeAttendanceController@view')->name('employees.attendance.view');
        Route::get('/attendance/add','Backend\Employee\EmployeeAttendanceController@add')->name('employees.attendance.add');
        Route::post('/attendance/store','Backend\Employee\EmployeeAttendanceController@store')->name('employees.attendance.store');
        Route::get('/attendance/edit/{date}','Backend\Employee\EmployeeAttendanceController@edit')->name('employees.attendance.edit');
        Route::get('/attendance/details/{date}','Backend\Employee\EmployeeAttendanceController@details')->name('employees.attendance.details');
        // Employee Attendance
        Route::get('/month/salary/view','Backend\Employee\MonthlySalaryController@view')->name('employees.moth.salary.view');
        Route::get('/month/salary/get','Backend\Employee\MonthlySalaryController@getSalary')->name('employees.moth.salary.get');
        Route::get('/month/salary/payslip/{employee_id}','Backend\Employee\MonthlySalaryController@paySlip')->name('employees.moth.salary.payslip');
    });

    Route::prefix('marks')->group(function(){ 

        // student marks entry and edit
        Route::get('/marks/add','Backend\Marks\MarksController@add')->name('student.marks.add');
        Route::post('/marks/store','Backend\Marks\MarksController@store')->name('students.marks.store');
        Route::get('/marks/edit','Backend\Marks\MarksController@edit')->name('students.marks.edit');
        Route::get('/marks/edit/edit','Backend\Marks\MarksController@marksEdit')->name('get.marks.student.marks.edit');
        Route::post('/marks/update','Backend\Marks\MarksController@update')->name('students.marks.update');

        //student marks grede point
        Route::get('/student/grade/point/view','Backend\Marks\GradeController@view')->name('student.grade.point.view');
        Route::get('/student/grade/point/add','Backend\Marks\GradeController@add')->name('student.grade.point.add');
        Route::post('/student/grade/point/store','Backend\Marks\GradeController@store')->name('student.grade.point.store');
        Route::get('/student/grade/point/edit/{id}','Backend\Marks\GradeController@edit')->name('student.grade.point.edit');
        Route::post('/student/grade/point/update/{id}','Backend\Marks\GradeController@update')->name('student.grade.point.update');
        Route::get('/student/grade/point/delete/{id}','Backend\Marks\GradeController@deleteid')->name('student.grade.point.delete');
    });
    Route::get('/get-student-mark','Backend\MasterMan\DefaultController@getStudent')->name('get.marks.student');
    Route::get('/get-student-subject','Backend\MasterMan\DefaultController@getSubject')->name('get.subjects.student');



    Route::prefix('accounts')->group(function(){ 
        //student fee
        Route::get('/student/fee/view','Backend\Account\StudentFeeController@view')->name('accounts.fee.view');
        Route::get('/student/fee/add','Backend\Account\StudentFeeController@add')->name('accounts.fee.add');
        Route::post('/student/fee/store','Backend\Account\StudentFeeController@store')->name('accounts.fee.store');
        Route::get('/student/getstudent','Backend\Account\StudentFeeController@getStudent')->name('accounts.fee.getstudent');
    });




    










});
