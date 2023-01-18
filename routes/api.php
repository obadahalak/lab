<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnalyzController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\LabAccount\billController;
use App\Http\Controllers\LabAccount\labsController;
use App\Http\Controllers\LabAccount\staffController;
use App\Http\Controllers\Doctor\AuthDoctroController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\LabAccount\accountingController;
use App\Http\Controllers\LabAccount\PatientController;
use App\Http\Controllers\LabAccount\supplierController;
use App\Http\Controllers\LabAccount\LabAccountController;
use App\Http\Controllers\LabAccount\DcotorAccountController;
use App\Http\Controllers\LabAccount\reportingController;
use App\Http\Controllers\LabAccount\Settings\genderController;
use App\Http\Controllers\LabAccount\Settings\companyController;
use App\Http\Controllers\LabAccount\Settings\jobTitleController;
use App\Http\Controllers\LabAccount\Settings\TestUnitAndMethodController;
use App\Http\Controllers\LabAccount\Settings\SendMethodController;
use App\Http\Controllers\LabAccount\Settings\payemntMethodContoller;
use App\Http\Controllers\LabAccount\Settings\specializationController;
use App\Http\Controllers\LabAccount\storeController;

Route::prefix('lab-scope')->group(function () {

    ///auth labs endpoints//////////
    Route::controller(LabAccountController::class)->group(function () {

        Route::get('auth-lab', 'accountAuth');


        Route::middleware('auth:lab')->group(function () {

            Route::get('account', 'account');

            Route::post('updateLab', 'updateLab');
        });
    });
    /// end auth labs endpoints//////////


    ////////////////  # DcotorAccoun Routes # ///////////////////////
    Route::controller(DcotorAccountController::class)->middleware('auth:lab')->group(function () {

        Route::post('createDoctor', 'storeDoctor');

        Route::get('myDoctors', 'Docotors');

        Route::get('doctor/{id}', 'show');

        Route::post('doctor-update/{id}', 'update');

        Route::post('doctor-delete/{id}', 'destroy');
    });
    ////////////////  # end of DcotorAccoun Routes # ///////////////////////


    ////////////////  # Analyz Routes # ///////////////////////
    Route::controller(AnalyzController::class)->middleware('auth:lab')->group(function () {
        Route::get('get-sections', 'sections');
        Route::post('create-section', 'store');
        Route::post('create-analyzForSection', 'analyzForSection')->name('analyzForSection');
    });
    ////////////////  # end of Analyz Routes # ///////////////////////


    ////////////////  # Patien Routes # ///////////////////////
    Route::controller(PatientController::class)->middleware('auth:lab')->group(function () {
        Route::post('patient-create', 'store');
        Route::delete('patient-delete', 'delete');
        Route::get('patient-show/{id}', 'show');
    });
    ////////////////  # end of Patien Routes # ///////////////////////





    ////////////////  # staff Routes # ///////////////////////
    Route::controller(staffController::class)->middleware('auth:lab')->group(function () {
        Route::get('/staff', 'index');
        Route::post('/staff-store', 'store');
        Route::get('/staff-show/{id}', 'show');
        Route::post('/staff-update/{id}', 'update');
        Route::delete('/staff-delete/{id}', 'destroy');
    });
    ////////////////  # end of staff Routes # ///////////////////////



    ////////////////  # supplier Routes # ///////////////////////
    Route::controller(supplierController::class)->middleware('auth:lab')->group(function () {
        Route::get('/suppliers', 'index');
        Route::post('/supplier-store', 'store');
        Route::get('/supplier-show/{id}', 'show');
        Route::post('/supplier-update/{id}', 'update');
        // Route::post('/supplier-update/{id}','update_quantity');
        Route::delete('/supplier-delete/{id}', 'destroy');
    });
    ////////////////  # end of supplier Routes # ///////////////////////


    ////////////////  # bill Routes # ///////////////////////
    Route::controller(billController::class)->middleware('auth:lab')->group(function () {
        Route::get('/bills', 'get_bills');
        Route::post('/bill-store', 'addBillToOffice');
        Route::get('/pays', 'get_pays');
        Route::post('/pay-store', 'addPay');
    });
    ////////////////  # end of bill Routes # ///////////////////////



    ////////////////  # labs Routes # ///////////////////////
    Route::controller(labsController::class)->middleware('auth:lab')->group(function () {
        Route::get('/labs', 'index');
        Route::post('/lab-store', 'store');
        Route::get('/lab-show/{id}', 'show');
        Route::post('/lab-update/{id}', 'update');
        Route::delete('/lab-delete/{id}', 'destroy');
    });
    ////////////////  # end of labs Routes # ///////////////////////


    ////////////////  # accountings Routes # ///////////////////////
    Route::controller(accountingController::class)->middleware('auth:lab')->group(function () {
        Route::get('/accounting-export', 'exports');
        Route::get('/accounting-rev', 'outcome');
        Route::post('/accounting-store', 'store');
        Route::get('/accounting-show/{id}', 'show');
        Route::put('/accounting-update/{id}', 'update');
        Route::delete('/accounting-delete/{id}', 'destroy');
    });
    ////////////////  # end of accounting Routes # ///////////////////////


    ////////////////  # store Routes # ///////////////////////
    Route::controller(storeController::class)->middleware('auth:lab')->group(function(){
        Route::get('/store','index');
        Route::post('/store-store','store');
        Route::get('/store-show/{id}','show');
        Route::post('/store-update/{id}','update');
        Route::post('/quantity-update/{id}','update_quantity');
        Route::delete('/store-delete/{id}','destroy');
    });
    ////////////////  # end of store Routes # ///////////////////////


    ////////////////  # specialization Routes # ///////////////////////
    Route::controller(specializationController::class)->middleware('auth:lab')->group(function () {
        Route::get('/specializations', 'index');
        Route::post('/specialization-store', 'store');
        Route::get('/specialization-show/{id}', 'show');
        Route::post('/specialization-update/{id}', 'update');
        Route::delete('/specialization-delete/{id}', 'destroy');
    });
    ////////////////  # end of specialization Routes # ///////////////////////



    ////////////////  # job title Routes # ///////////////////////
    Route::controller(jobTitleController::class)->middleware('auth:lab')->group(function () {
        Route::get('/job-titles', 'index');
        Route::post('/job-title-store', 'store');
        Route::get('/job-title-show/{id}', 'show');
        Route::post('/job-title-update/{id}', 'update');
        Route::delete('/job-title-delete/{id}', 'destroy');
    });
    ////////////////  # end of job title Routes # ///////////////////////




    ///  start genders Routes //////
    Route::controller(genderController::class)->middleware('auth:lab')->group(function () {

        Route::get('genders', 'index');
        Route::post('create-gender', 'store');
        Route::put('gender-update', 'update');
        Route::delete('gender-delete', 'delete');
    });
    ///  end genders Routes //////


    ///  start company Routes //////
    Route::controller(companyController::class)->middleware('auth:lab')->group(function () {

        Route::get('companies', 'index');
        Route::post('create-company', 'store');
        Route::put('company-update', 'update');
        Route::delete('company-delete', 'delete');
    });

    ///  end  company Routes //////




    ///  start payemntMethod Routes //////
    Route::controller(payemntMethodContoller::class)->middleware('auth:lab')->group(function () {

        Route::get('paymentMethods', 'index');
        Route::post('create-paymentMethods', 'store');
        Route::put('paymentMethods-update', 'update');
        Route::delete('paymentMethods-delete', 'delete');
    });

    ///  end  payemntMethod Routes //////



    ///  start sendMethod Routes //////
    Route::controller(SendMethodController::class)->middleware('auth:lab')->group(function () {

        Route::get('sendMethods', 'index');
        Route::post('create-sendMethod', 'store');
        Route::put('sendMethod-update', 'update');
        Route::delete('sendMethod-delete', 'delete');
    });
    ///  end sendMethod Routes //////

    Route::controller(TestUnitAndMethodController::class)->middleware('auth:lab')->group(function () {
        /// testUnits endpoints
        Route::get('get-TestUnits', 'getTestUnits');
        Route::post('create-TestUnit', 'createTestUnit');
        Route::put('update-TestUnit', 'updateTestUnit');
        Route::delete('delete-TestUnit', 'deleteTestUnit');



        /// testMethods endpoints
        Route::get('get-TestMethods', 'testMethods');
        Route::post('create-TestMethod', 'createTestMethod');
        Route::put('update-TestMethod', 'updateTestMethod');
        Route::delete('delete-TestMethod', 'deleteTestMethod');
        // end testMethods endpoints

        /// end  testUnits endpoints
    });
});



///auth Doctor endpoints//////////


Route::prefix('doctor-scope')->group(function () {

    Route::controller(AuthDoctroController::class)->group(function () {
        Route::get('doctor-login', 'doctorAuth');
        Route::get('doctor-profile', 'doctorProfile')->middleware('auth:doctor');
    });
});




//// end auth Doctor  Endpoints


/////// Reporting //////
Route::controller(reportingController::class)->middleware('auth:lab')->group(function () {

    Route::get('AnalysisCount', 'AnalysisCount');
    Route::get('AnalysisCount-filter', 'AnalysisCountFilter');

});

/////////////
