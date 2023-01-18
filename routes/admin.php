

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LabAccount\staffController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminSectionAnalizController;
use App\Http\Controllers\Doctor\AuthDoctroController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\LabAccount\LabAccountController;
use App\Http\Controllers\LabAccount\DcotorAccountController;


///////////  start  admin endpoints ////////////

Route::prefix('admin-scope')->group(function () {


    /// login admin endpoint ///
    Route::controller(AdminAuthController::class)->group(function () {
        Route::get('auth-admin', 'auth');
        Route::put('auth-profile', 'profileAdmin');
    });
    //// end Endpoints


    ///Management account endpoints  ////

    Route::controller(AccountController::class)->middleware('auth:admin')->group(function () {

        Route::post('/account', 'create');

        Route::get('/accounts', 'accounts');
    });

    //// end Endpoints


    //Settings Admin endpoints

    Route::controller(AdminSettingController::class)->middleware('auth:admin')->group(function () {

        /// type of tupes //
        Route::get('tupes', 'getTupes');
        Route::post('typeOftupe', 'addTypeOfTupe');
        Route::delete('deleteTupe', 'deleteTupe');
        Route::put('updateTupe', 'updateTupe');
        ///end Tupes

        /// testMethods endpoints
        Route::get('get-TestMethods', 'testMethods');
        Route::post('create-TestMethod', 'createTestMethod');
        Route::put('update-TestMethod', 'updateTestMethod');
        Route::delete('delete-TestMethod', 'deleteTestMethod');
        // end testMethods endpoints

        /// testUnits endpoints
        Route::get('get-TestUnits', 'getTestUnits');
        Route::post('create-TestUnit', 'createTestUnit');
        Route::put('update-TestUnit', 'updateTestUnit');
        Route::delete('delete-TestUnit', 'deleteTestUnit');

        /// end  testUnits endpoints


        /// genders endpoints
        Route::get('get-genders', 'indexGender');
        Route::post('create-gender', 'storeGender');
        Route::put('update-gender', 'UpdateGender');
        Route::delete('delete-gender', 'DeleteGender');

        /// end  gender endpoints




    });


    /////// sections-analys ////
    Route::controller(AdminSectionAnalizController::class)->middleware('auth:admin')->group(function () {

        Route::get('sections', 'sections');
        Route::get('getAnalys', 'getAnalys');

        Route::post('create-section', 'createSections');

        Route::post('create-analyzSection', 'analyzForSection');

        Route::put('update-section', 'updateSection');

        Route::delete('delete-section', 'deleteSection');
    });
    //// end Endpoints
});

///////////////// end  admin endpoints////////////////
