<?php

//login admin
Route::group(['namespace'=>'Auth','prefix'=>'admin/auth','middleware'=>'AdminGuest','as'=>'admin.auth.'],function(){
    Route::get('/login','AdminController@login')->name('login');
    Route::get('/register','AdminController@register')->name('register');
    Route::post('/register_submit','AdminController@register_submit')->name('register_submit');
    Route::post('/login','AdminController@login_submit')->name('login_submit');
});
//logout admin
Route::post('admin/logout','Auth\AdminController@logout')->name('admin.logout')->middleware('Admin');

//reset admin users password
Route::group(['namespace'=>'Auth','prefix'=>'admin/reset','as'=>'admin.reset.'],function(){
    Route::get('/mail','AdminController@mail')->name('mail');
    Route::post('/mail_submit','AdminController@mail_submit')->name('mail_submit');
    Route::get('/reset_password_form/{token}','AdminController@reset_password_form')->name('reset_password_form');
    Route::post('/reset_password_submit','AdminController@reset_password_submit')->name('reset_password_submit');
});

//admin controls 
Route::group(['prefix'=>'admin','as'=>'admin.','namespace'=>'Admin','middleware'=>['Admin','Branch']],function(){
    //dashboard
    Route::get('/','IndexController@index')->name('index'); 

    //change branch
    Route::get('change_branch/{lang}','IndexController@change_branch')->name('change_branch');

    //profile
    Route::group(['prefix'=>'profile','as'=>'profile.'],function(){
        Route::get('edit','ProfileController@edit')->name('edit');
        Route::post('update','ProfileController@update')->name('update');
    });

    //categories
    Route::resource('categories','CategoriesController');

    //tests and its components
    Route::resource('tests','TestsController');
    Route::get('get_tests','TestsController@ajax')->name('get_tests');//datatable
    Route::get('tests/consumptions/{id}','TestsController@consumptions')->name('tests.consumptions');//consumptions
    Route::post('tests/consumptions','TestsController@consumptions_submit')->name('tests.consumptions.submit');//consumptions
    Route::get('tests_export','TestsController@export')->name('tests.export'); 
    Route::get('tests_download_template','TestsController@download_template')->name('tests.download_template'); 
    Route::post('tests_import','TestsController@import')->name('tests.import'); 
    Route::post('tests/bulk/delete','TestsController@bulk_delete')->name('tests.bulk_delete');
    Route::get('get_component','TestsController@get_component')->name('get_component'); 

    //cultures
    Route::resource('cultures','CulturesController');
    Route::get('get_cultures','CulturesController@ajax')->name('get_cultures');//datatable
    Route::get('cultures_export','CulturesController@export')->name('cultures.export'); 
    Route::get('cultures_download_template','CulturesController@download_template')->name('cultures.download_template'); 
    Route::post('cultures_import','CulturesController@import')->name('cultures.import'); 
    Route::post('cultures/bulk/delete','CulturesController@bulk_delete')->name('cultures.bulk_delete');

    //packages
    Route::resource('packages','PackagesController');
    Route::post('packages/bulk/delete','PackagesController@bulk_delete')->name('packages.bulk_delete');

    //culture options
    Route::resource('culture_options','CultureOptionsController');
    Route::get('get_culture_options','CultureOptionsController@ajax')->name('culture_options.ajax');
    Route::post('culture_options/bulk/delete','CultureOptionsController@bulk_delete')->name('culture_options.bulk_delete');
    
    //antibiotics
    Route::resource('antibiotics','AntibioticsController');
    Route::get('get_antibiotics','AntibioticsController@ajax')->name('get_antibiotics');//datatable
    Route::get('antibiotics_export','AntibioticsController@export')->name('antibiotics.export'); 
    Route::get('antibiotics_download_template','AntibioticsController@download_template')->name('antibiotics.download_template'); 
    Route::post('antibiotics_import','AntibioticsController@import')->name('antibiotics.import'); 
    Route::post('antibiotics/bulk/delete','AntibioticsController@bulk_delete')->name('antibiotics.bulk_delete');

    //patients
    Route::resource('patients','PatientsController');
    Route::get('get_patients','PatientsController@ajax')->name('get_patients'); 
    Route::get('patients_export','PatientsController@export')->name('patients.export'); 
    Route::get('patients_download_template','PatientsController@download_template')->name('patients.download_template'); 
    Route::post('patients_import','PatientsController@import')->name('patients.import'); 
    Route::post('patients/bulk/delete','PatientsController@bulk_delete')->name('patients.bulk_delete');
    
    //groups
    Route::resource('groups','GroupsController');
    Route::post('groups/send_receipt_mail/{id}','GroupsController@send_receipt_mail')->name('groups.send_receipt_mail');
    Route::post('groups/delete_analysis/{id}','GroupsController@delete_analysis');
    Route::get('get_groups','GroupsController@ajax')->name('get_groups');
    Route::post('groups/print_barcode/{group_id}','GroupsController@print_barcode')->name('groups.print_barcode');
    Route::get('groups/working_paper/{group_id}','GroupsController@working_paper')->name('groups.working_paper');
    Route::post('groups/bulk/delete','GroupsController@bulk_delete')->name('groups.bulk_delete');
    Route::post('groups/bulk/print_barcode','GroupsController@bulk_print_barcode')->name('groups.bulk_print_barcode');
    Route::post('groups/bulk/print_receipt','GroupsController@bulk_print_receipt')->name('groups.bulk_print_receipt');
    Route::post('groups/bulk/print_working_paper','GroupsController@bulk_print_working_paper')->name('groups.bulk_print_working_paper');
    Route::post('groups/bulk/send_receipt_mail','GroupsController@bulk_send_receipt_mail')->name('groups.bulk_send_receipt_mail');
    Route::post('group/check/test/{id}','GroupsController@checkTest')->name('group.check.test');

    //Medical reports
    Route::resource('medical_reports','MedicalReportsController');
    Route::post('medical_reports/upload_report/{id}','MedicalReportsController@upload_report')->name('medical_reports.upload_report');
    Route::post('medical_reports/pdf/{id}','MedicalReportsController@pdf')->name('medical_reports.pdf');
    Route::post('medical_reports/update_culture/{id}','MedicalReportsController@update_culture')->name('medical_reports.update_culture');//update cultures
    Route::get('sign_medical_report/{id}','MedicalReportsController@sign')->name('medical_reports.sign');
    Route::get('medical_reports/print_report/{id}','MedicalReportsController@print_report')->name('medical_reports.print_report');
    Route::get('medical_reports/print_report_2/{id}','MedicalReportsController@print_report_2')->name('medical_reports.print_report_2');
    Route::post('medical_reports/send_report_mail/{id}','MedicalReportsController@send_report_mail')->name('medical_reports.send_report_mail');
    Route::post('medical_reports/bulk/delete','MedicalReportsController@bulk_delete')->name('groups.bulk_delete');
    Route::post('medical_reports/bulk/print_barcode','MedicalReportsController@bulk_print_barcode')->name('groups.bulk_print_barcode');
    Route::post('medical_reports/bulk/sign_report','MedicalReportsController@bulk_sign_report')->name('groups.bulk_sign_report');
    Route::post('medical_reports/bulk/print_report','MedicalReportsController@bulk_print_report')->name('groups.bulk_print_report');
    Route::post('medical_reports/bulk/send_report_mail','MedicalReportsController@bulk_send_report_mail')->name('groups.bulk_send_report_mail');
    Route::get('medical_report/get-comment','MedicalReportsController@getComment')->name('medical_report.get-comment');
    Route::get('medical_report/add_comment','MedicalReportsController@addComment')->name('medical_report.add_comment');
    Route::get('medical_report/save/reference/range','MedicalReportsController@saveReferenceRange')->name('medical_report.save.reference.range');
    Route::get('medical_report/include/history','MedicalReportsController@includeHistory')->name('medical_report.include.history');
    
    //doctors 
    Route::resource('doctors','DoctorsController');
    Route::get('get_doctors','DoctorsController@ajax')->name('get_doctors');
    Route::get('doctors_export','DoctorsController@export')->name('doctors.export'); 
    Route::get('doctors_download_template','DoctorsController@download_template')->name('doctors.download_template'); 
    Route::post('doctors_import','DoctorsController@import')->name('doctors.import'); 
    Route::post('doctors/bulk/delete','DoctorsController@bulk_delete')->name('doctors.bulk_delete');
    
    //roles
    Route::resource('roles','RolesController');
    Route::get('get_roles','RolesController@ajax')->name('get_roles');
    Route::post('roles/bulk/delete','RolesController@bulk_delete')->name('roles.bulk_delete');

    //users
    Route::resource('users','UsersController');
    Route::get('get_users','UsersController@ajax')->name('get_users');
    Route::post('users/bulk/delete','UsersController@bulk_delete')->name('users.bulk_delete');
   
    //tests price list
    Route::get('prices/tests','PricesController@tests')->name('prices.tests');
    Route::post('prices/tests','PricesController@tests_submit')->name('prices.tests_submit');
    Route::get('tests_prices_export','PricesController@tests_prices_export')->name('prices.tests_prices_export'); 
    Route::post('tests_prices_import','PricesController@tests_prices_import')->name('prices.tests_prices_import'); 
  
    //cultures price list
    Route::get('prices/cultures','PricesController@cultures')->name('prices.cultures');
    Route::post('prices/cultures','PricesController@cultures_submit')->name('prices.cultures_submit');
    Route::get('cultures_prices_export','PricesController@cultures_prices_export')->name('prices.cultures_prices_export'); 
    Route::post('cultures_prices_import','PricesController@cultures_prices_import')->name('prices.cultures_prices_import'); 

    //packages price list
    Route::get('prices/packages','PricesController@packages')->name('prices.packages');
    Route::post('prices/packages','PricesController@packages_submit')->name('prices.packages_submit');
    Route::get('packages_prices_export','PricesController@packages_prices_export')->name('prices.packages_prices_export'); 
    Route::post('packages_prices_import','PricesController@packages_prices_import')->name('prices.packages_prices_import'); 
    
    //accounting reports
    Route::resource('payment_methods','PaymentMethodsController');
    Route::get('accounting','AccountingController@index')->name('accounting.index');
    Route::get('generate_report','AccountingController@generate_report')->name('accounting.generate_report');
    Route::get('doctor_report','AccountingController@doctor_report')->name('accounting.doctor_report');
    Route::get('generate_doctor_report','AccountingController@generate_doctor_report')->name('accounting.generate_doctor_report');
    
    //chat
    Route::get('chat','ChatController@index')->name('chat.index');
   
    //visits
    Route::resource('visits','VisitsController');
    Route::get('visits/create_tests/{id}','VisitsController@create_tests')->name('visits.create_tests');
    Route::get('get_visits','VisitsController@ajax')->name('get_visits');
    Route::post('visits/bulk/delete','VisitsController@bulk_delete')->name('visits.bulk_delete');
   
    //branches
    Route::resource('branches','BranchesController');
    Route::get('get_branches','BranchesController@ajax')->name('get_branches');
    Route::post('branches/bulk/delete','BranchesController@bulk_delete')->name('branches.bulk_delete');
    
    //contracts
    Route::resource('contracts','ContractsController');
    Route::get('get_contracts','ContractsController@ajax')->name('get_contracts');
    Route::post('contracts/bulk/delete','ContractsController@bulk_delete')->name('contracts.bulk_delete');
   
    //labs
    Route::resource('labs','LabController');
    Route::get('get_labs','LabController@ajax')->name('get_labs');
    Route::post('labs/bulk/delete','LabController@bulk_delete')->name('labs.bulk_delete');
   
    //expenses
    Route::resource('expenses','ExpensesController');
    Route::get('get_expenses','ExpensesController@ajax')->name('get_expenses');
    Route::post('expenses/bulk/delete','ExpensesController@bulk_delete')->name('expenses.bulk_delete');
    
    //expense categories
    Route::resource('expense_categories','ExpenseCategoriesController');
    Route::get('get_expense_categories','ExpenseCategoriesController@ajax')->name('get_expense_categories');
    Route::post('expense_categories/bulk/delete','ExpenseCategoriesController@bulk_delete')->name('expense_categories.bulk_delete');

    //backups
    Route::resource('backups','BackupsController');

    //activity logs
    Route::resource('activity_logs','ActivityLogsController');
    Route::post('activity_logs_clear','ActivityLogsController@clear')->name('activity_logs.clear');
    Route::get('get_activity_logs','ActivityLogsController@ajax')->name('get_activity_logs');

    //settings
    Route::group(['prefix'=>'settings','as'=>'settings.'],function(){
        Route::get('/','SettingsController@index')->name('index');
        Route::post('info','SettingsController@info_submit')->name('info_submit');
        Route::post('emails','SettingsController@emails_submit')->name('emails_submit');
        Route::post('reports','SettingsController@reports_submit')->name('reports_submit');
        Route::post('sms','SettingsController@sms_submit')->name('sms_submit');
        Route::post('whatsapp','SettingsController@whatsapp_submit')->name('whatsapp_submit');
        Route::post('api_keys','SettingsController@api_keys_submit')->name('api_keys_submit');
        Route::post('barcode','SettingsController@barcode_submit')->name('barcode_submit');
    });

    //inventory module
    Route::group(['prefix'=>'inventory','as'=>'inventory.','namespace'=>'Inventory'],function(){
        Route::resource('suppliers','SuppliersController');
        Route::resource('products','ProductsController');
        Route::resource('purchases','PurchasesController');
        Route::resource('adjustments','AdjustmentsController');
        Route::resource('transfers','TransfersController');
        Route::get('product_alerts','ProductsController@product_alerts');
    });
    Route::post('adjustments/bulk/delete','Inventory\AdjustmentsController@bulk_delete')->name('adjustments.bulk_delete');
    Route::post('purchases/bulk/delete','Inventory\PurchasesController@bulk_delete')->name('purchases.bulk_delete');
    Route::post('suppliers/bulk/delete','Inventory\SuppliersController@bulk_delete')->name('suppliers.bulk_delete');
    Route::post('transfers/bulk/delete','Inventory\TransfersController@bulk_delete')->name('transfers.bulk_delete');
    Route::post('products/bulk/delete','Inventory\ProductsController@bulk_delete')->name('products.bulk_delete');

    //Reports module
    Route::group(['prefix'=>'reports','as'=>'reports.'],function(){
        Route::get('accounting','ReportsController@accounting')->name('accounting');
        Route::get('patient','ReportsController@patient')->name('patient');
        Route::get('doctor','ReportsController@doctor')->name('doctor');
        Route::get('supplier','ReportsController@supplier')->name('supplier');
        Route::get('purchase','ReportsController@purchase')->name('purchase');
        Route::get('inventory','ReportsController@inventory')->name('inventory');
        Route::get('product','ReportsController@product')->name('product');
        Route::get('branch_products','ReportsController@branch_products')->name('branch_products');
    });

    // update_patient_contract_id
    Route::get('update_patient_contract_id','GroupsController@updatePatientContractId')->name('update_patient_contract_id');
    // get_contract_user
    Route::get('get_contract_user','GroupsController@getContractUser')->name('get_contract_user');
    // add_point_sale
    Route::put('add_point_sale','IndexController@addPointSale')->name('add_point_sale');

    // tips and offers module
    Route::resource('tips','TipsController');
    Route::get('tip/get_tips','TipsController@ajax')->name('get_tips');
    // route bulk/delete
    Route::post('tips/bulk/delete','TipsController@bulk_delete')->name('tips.bulk_delete');

    // staticPages
    Route::resource('static_pages','StaticPagesController');
    // sliders
    Route::resource('sliders','SlidersController');
    Route::get('slider/get_sliders','SlidersController@ajax')->name('get_sliders');
    Route::post('sliders/bulk/delete','SlidersController@bulk_delete')->name('sliders.bulk_delete');

    // prescriptions
    Route::resource('prescriptions','PrescriptionsController');
    // get_prescriptions
    Route::get('prescription/get_prescriptions','PrescriptionsController@ajax')->name('get_prescriptions');
    Route::post('prescriptions/bulk/delete','PrescriptionsController@bulk_delete')->name('prescriptions.bulk_delete');

    //translations
    Route::resource('translations','TranslationsController');
    // bookings
    Route::resource('bookings','BookingController');
    Route::get('booking/get_bookings','BookingController@ajax')->name('get_bookings');
    Route::post('bookings/bulk/delete','BookingController@bulk_delete')->name('bookings.bulk_delete');
    
    // route
    Route::resource('fixed_assets','FixedAssetController');
    // fixed_asset/get_fixed_assets
    Route::get('fixed_asset/get_fixed_assets','FixedAssetController@ajax')->name('get_fixed_assets');
    Route::post('fixed_assets/bulk/delete','FixedAssetController@bulk_delete')->name('fixed_assets.bulk_delete');

    // governments
    Route::resource('governments','GovernmentController');
    // get_governments
    Route::get('government/get_governments','GovernmentController@ajax')->name('get_governments');
    // route bulk/delete
    Route::post('governments/bulk/delete','GovernmentController@bulk_delete')->name('governments.bulk_delete');
    // regions
    Route::resource('regions','RegionController');
    // get_regions
    Route::get('region/get_regions','RegionController@ajax')->name('get_regions');
    // route bulk/delete
    Route::post('regions/bulk/delete','RegionController@bulk_delete')->name('regions.bulk_delete');

});

// route get_regions
Route::get('get_region','Admin\RegionController@get_region_by_government')->name('get_region');