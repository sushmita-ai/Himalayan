<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\Employee\EmployeeController;
use App\Http\Controllers\Admin\Attendance\AttendanceController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Subject\SubjectController;
use App\Http\Controllers\Admin\Student\StudentController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\SubCategory\SubCategoryController;
use App\Http\Controllers\Admin\Package\PackageController;


Route::get('/', [AdminLoginController::class, 'showLoginForm'])->name('login');
Route::post('admin/login', [AdminLoginController::class, 'login'])->name('admin.login');
Route::get('admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

Route::group([
    'as' => 'admin.', 'middleware' =>  ['admin'], 'prefix' => 'admin' // 'middleware' => ['role:ROLE_CANDIDATE'],
], function ($router) {

    $router->get('dashboard', [DashboardController::class, 'index'])->name('dashboard');


    $router->resource('/subject', SubjectController::class);
    $router->get('subject-data', [SubjectController::class, 'getData'])->name('subject.data');
    $router->get('subject-ajax', [SubjectController::class, 'subjectAjax'])->name('subject.ajax');
    $router->get('subject-select', [SubjectController::class, 'getSubjectList'])->name('student.subject');
    $router->get('subject/{id}/destroy', [SubjectController::class, 'destroy'])->name('subject.destroy');

    $router->resource('/student', StudentController::class);
    $router->get('student-data', [StudentController::class, 'getAllData'])->name('student.data');
    $router->get('student-ajax', [StudentController::class, 'studentAjax'])->name('student.ajax');

    $router->get('student/{id}/destroy', [StudentController::class, 'destroy'])->name('student.destroy');

    //customer
    $router->resource('/employee', EmployeeController::class);
    $router->get('employee-data', [EmployeeController::class, 'getAllData'])->name('employee.data');
    $router->get('employee-ajax', [EmployeeController::class, 'employeeAjax'])->name('employee.ajax');
    $router->get('employee-search', [EmployeeController::class, 'employeeSearch'])->name('employee.search');

    $router->resource('/attendance', AttendanceController::class);
    $router->get('attendance-data', [AttendanceController::class, 'getAllData'])->name('attendance.data');
    $router->post('update-payment', [AttendanceController::class, 'updateAttendanceAjax'])->name('attendance.payment');
    $router->post('create-attendance', [AttendanceController::class, 'createAttendanceAjax'])->name('attendance.create.ajax');

    $router->resource('/category', CategoryController::class);
    $router->get('category-data', [CategoryController::class, 'getAllData'])->name('category.data');
    $router->get('category-ajax', [CategoryController::class, 'categoryAjax'])->name('category.ajax');
    $router->get('category-select', [CategoryController::class, 'getCategoryList'])->name('category.subcategory');
    $router->get('category/{id}/destroy', [CategoryController::class, 'destroy'])->name('category.destroy');


    $router->resource('/subcategory', SubCategoryController::class);
    $router->get('subcategory-data', [SubCategoryController::class, 'getAllData'])->name('subcategory.data');
    $router->get('subcategory-ajax', [SubCategoryController::class, 'subcategoryAjax'])->name('subcategory.ajax');
    $router->get('subcategory-select', [SubCategoryController::class, 'getSubCategoryList'])->name('subcategory.package');
    $router->get('subcategory/{id}/destroy', [SubCategoryController::class, 'destroy'])->name('subcategory.destroy');



    $router->resource('/package', PackageController::class);
    $router->get('package-data', [PackageController::class, 'getAllData'])->name('package.data');
    $router->get('package-ajax', [PackageController::class, 'packageAjax'])->name('package.ajax');

    $router->get('package/{id}/destroy', [PackageController::class, 'destroy'])->name('package.destroy');



});
