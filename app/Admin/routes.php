<?php

use Illuminate\Routing\Router;

Admin::routes();
Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
    'as' => config('admin.route.prefix') . '.',
], function (Router $router) {
    $MANAGE_INTERVENTIONS = 'ManageController@interventions';
    $MANAGE_INTS = 'ManageController@ints';
    $router->middleware('area');
    $router->get('/', 'HomeController@index')->name('home')->middleware('area');
    $router->get('/auth/login', 'HomeController@login')->name('login');
    $router->get('/auth/changePassword', 'HomeController@changePassword')->name('changePassword');
    $router->post('/auth/changePassword', 'HomeController@changePasswordSubmit')->name('submit.changePassword');
    $router->get('/dashboard', 'AdminFormsController@dashboard')->name('dashboard');
    $router->get('/transferCase', 'AdminFormsController@transferCase')->name('transferCase');

    // Development Routes
    $router->get('/development/dashboard', 'DevelopmentController@index')->name('development');
    $router->get('/development/transferCase', 'DevelopmentController@transferCase')->name('transferCaseDevelopment');
    $router->get('/development/interventions', $MANAGE_INTERVENTIONS)->name('interventionsDevelopment');
    $router->get('/development/supported', 'ManageController@supported')->name('supportedDevelopment');
    $router->get('/development/ints/{details_id}', $MANAGE_INTS)->name('interventionsGeneric');
    $router->get('/development/supported_ints/{details_id}', 'ManageController@supportedInts')->name('supportedInterventionsGeneric');
    $router->get('/development/executed', 'ManageController@executed')->name('executedDevelopment');
    $router->get('/development/executed_ints/{details_id}', 'ManageController@executedInts')->name('executedDevelopmentInterventionsGeneric');
    $router->get('/development/returned', 'ManageController@returned')->name('returnedDevelopment');
    $router->get('/development/returned_ints/{details_id}', 'ManageController@returnedInts')->name('returnedDevelopmentInterventionsGeneric');
    $router->post('/development/intsTransfer', 'DevelopmentController@intsTransfer')->name('intsTransfer')->middleware('CaptureTransactionHistory');
    $router->post('/development/intsRejectTransfer', 'DevelopmentController@intsRejectTransfer')->name('intsRejectTransfer')->middleware('CaptureTransactionHistory');
    $router->post('/development/doTransfer', 'DevelopmentController@doTransfer')->name('doTransferDevelopment')->middleware('CaptureTransactionHistory');
    $router->get('/development/trackIntsExecution', 'DevelopmentController@trackIntsExecution')->name('trackIntsExecutionDevelopment');
    $router->get('/development/tracking', 'DevelopmentController@tracking')->name('tracking');
    $router->get('/development/oneTrack/{id}', 'DevelopmentController@oneTrack')->name('oneTrack');
    $router->get('/development/imagesCases', 'ManageController@imagesCases')->name('imagesCases');
    $router->get('/development/supporterDetails', 'ManageController@supportDetails')->name('supporterDetails');
    $router->get('/development/notCompleted', 'ManageController@notCompleted')->name('notCompleted');
    $router->post('/development/reactiveUrl', 'DevelopmentController@reactiveUrl')->name('reactiveUrl');
    $router->get('/development/NotCompletedCasesModal', 'ManageController@NotCompletedCasesModal')->name('NotCompletedCasesModal');
    $router->get('/development/orphans', 'DevelopmentController@orphans')->name('development.orphans');
    $router->post('/development/orphans/load', 'DevelopmentController@loadorphans')->name('development.loadorphans');
    $router->get('/development/stages', 'StageController@index')->name('development.stages');
    $router->post('/development/stages/post', 'StageController@store')->name('development.stages.store');
    $router->get('/development/stages/add', 'StageController@create')->name('development.stages.create');
    $router->get('/development/stages/edit', 'StageController@edit')->name('development.stages.edit');
    $router->post('/development/stages/update', 'StageController@update')->name('development.stages.update');
    $router->post('/development/submit_orphan_age_equivalent_degree', 'DevelopmentController@submit_orphan_age_equivalent_degree')->name('submit_orphan_age_equivalent_degree');
    $router->get('/development/orphan/HistoryStages', 'DevelopmentController@orphan_history_stages')->name('orphan_history_stages');
    $router->get('/development/orphan/HistoryOrphans/Stage/{stage_id}', 'DevelopmentController@orphan_history_orphans')->name('orphan_history_orphans');
    $router->get('/development/orphan/HistoryOrphan/Stage/{stage_id}/FormId/{form_id}', 'DevelopmentController@orphan_history_orphan_pathes')->name('orphan_history_orphan_pathes');
    $router->get('/development/orphan/HistoryOrphan/Stage/{stage_id}/FormId/{form_id}/PathId/{path_id}', 'DevelopmentController@orphan_history_orphan_details')->name('orphan_history_orphan_details');

    // Partnerts Routes
    $router->get('/partners/dashboard', 'PartnersController@index')->name('partners');
    $router->get('/partners/providers', 'ProvidersController@index')->name('providers');
    $router->get('/partners/providerDetails', 'ProvidersController@providerDetails')->name('providerDetails');
    $router->post('/partners/providers/add', 'ProvidersController@addProvider')->name('addProvider');
    $router->get('/partners/editProvider', 'ProvidersController@editProvider')->name('editProvider');
    $router->post('/partners/updateProvider', 'ProvidersController@updateProvider')->name('updateProvider');
    $router->get('/partners/deleteProvider/{id}', 'ProvidersController@deleteProvider')->name('deleteProvider');
    $router->get('/partners/interventions', $MANAGE_INTERVENTIONS)->name('interventionsPartners');
    $router->get('/partners/ints/{details_id}', $MANAGE_INTS)->name('interventionsPartnersDetails');
    $router->get('/partners/moveFormToWaiting', 'ManageController@moveFormToWaiting')->name('moveFormToWaiting')->middleware('CaptureTransactionHistory');
    $router->post('/partners/attachProvider', 'ProvidersController@attachProvider')->name('attachProvider')->middleware('CaptureTransactionHistory');
    $router->get('/partners/approvedSupport', 'ManageController@approvedSupport')->name('approvedSupport');
    $router->get('/partners/approvedSupports/{details_id}', 'ManageController@approvedSupports')->name('approvedSupports');
    $router->get('/partners/rejectedSupport', 'ManageController@rejectedSupport')->name('rejectedSupport');
    $router->get('/partners/rejectedSupports/{details_id}', 'ManageController@rejectedSupports')->name('rejectedSupports');
    $router->get('/partners/approveDetails', 'ManageController@approveDetails')->name('approveDetails');
    $router->get('/partners/reasonDetails', 'ManageController@reasonDetails')->name('reasonDetails');
    $router->post('/partners/ints/Export', 'ManageController@PartnersExportInterventions')->name('PartnersExportInterventionsCases');
    $router->get('/partners/imagesCases', 'ManageController@imagesCases')->name('imagesCasesPart');

    // Operation Routes
    $router->get('/operation/dashboard', 'OperationController@index')->name('operation');
    $router->get('/operation/transferCase', 'OperationController@transferCase')->name('transferCaseOperation');
    $router->get('/operation/interventions', $MANAGE_INTERVENTIONS)->name('interventionsOperation');
    $router->get('/operation/ints/{details_id}', $MANAGE_INTS)->name('interventionsGenericOper');
    $router->get('/operation/operationIntsExecuted', 'OperationController@operationDoExecution')->name('operationIntsExecuted')->middleware('CaptureTransactionHistory');
    $router->post('/operation/operationDoExecution', 'OperationController@operationDoExecution')->name('operationDoExecution')->middleware('CaptureTransactionHistory');
    $router->post('/operation/operationDoHang', 'OperationController@operationDoHang')->name('operationDoHang')->middleware('CaptureTransactionHistory');
    $router->get('/operation/supportDetails', 'ManageController@supportDetails')->name('supportDetails');
    $router->get('/operation/hangged', 'ManageController@hangged')->name('hangged');
    $router->get('/operation/hanggedInts/{details_id}', 'ManageController@hanggedInts')->name('hanggedInts');
    $router->get('/operation/operationHangreasonDetails', 'ManageController@operationHangreasonDetails')->name('operationHangreasonDetails');
    $router->get('/operation/imagesCases', 'ManageController@imagesCases')->name('imagesCasesOper');

    // Director Routes
    $router->get('/director/dashboard', 'DirectorController@index')->name('director');
    $router->get('/director/interventions', $MANAGE_INTERVENTIONS)->name('interventionsDirector');
    $router->get('/director/ints/{details_id}', $MANAGE_INTS)->name('interventionsGenericDir');
    $router->get('/director/directorIntsExecuted', 'DirectorController@directorDoExecution')->name('directorIntsExecuted')->middleware('CaptureTransactionHistory');
    $router->post('/director/directorDoExecution', 'DirectorController@directorDoExecution')->name('directorDoExecution')->middleware('CaptureTransactionHistory');
    $router->get('/director/supporterDetails', 'ManageController@supportDetails')->name('supporterDetailsDir');
    $router->get('/director/users', 'UsersController@index')->name('users');
    $router->post('/director/users/add', 'UsersController@addUser')->name('addUser');
    $router->get('/director/userDetails', 'UsersController@userDetails')->name('userDetails');
    $router->get('/director/editUser', 'UsersController@editUser')->name('editUserDir');
    $router->post('/director/updateUser', 'UsersController@updateUser')->name('updateUser');
    $router->get('/director/changePassword', 'UsersController@changePassword')->name('changePasswordDir');
    $router->post('/director/updateUserPassword', 'UsersController@updateUserPassword')->name('updateUserPassword');
    $router->get('/director/deleteUser/{id}', 'UsersController@deleteUser')->name('deleteUser');
    $router->get('/director/imagesCases', 'ManageController@imagesCases')->name('imagesCasesDir');

    // Orphan Routes
    $router->get('/orphan', 'OrphanController@index')->name('orphan');
    $router->get('/orphan/dashboard', 'OrphanController@dashboard')->name('orphan.dashboard');
    $router->get('/orphan/details/{id}', 'OrphanController@details')->name('orphan_details');
    $router->get('/orphan/get_degree_history', 'OrphanController@get_degree_history')->name('orphan_age_equivalent_degree_history');
    $router->get('/orphan/answers/{id}', 'OrphanController@get_answers')->name('orphan.get_answers');
    $router->get('/orphan/HistoryRecords', 'OrphanHistoryController@index')->name('orphan.history.records');
    $router->get('/orphan/HistoryRecords/Orphans/{stage_id}', 'OrphanHistoryController@orphans')->name('orphan.history.records.orphans');
    $router->get('/orphan/HistoryRecords/Orphan/{stage_id}/{form_id}', 'OrphanHistoryController@orphan')->name('orphan.history.records.orphan');
    $router->post('/orphans/submit_orphan_path_category', 'OrphanController@submit_orphan_path_category')->name('submit_orphan_path_category');
    $router->post('/orphans/submit_orphan_answers/{form_id}', 'OrphanController@submit_orphan_answers')->name('submit_orphan_answers');

    //objectives
    $router->get('/orphan/objectives', 'ObjectiveController@index')->name('orphan.objectives');
    $router->post('/orphan/objective/store', 'ObjectiveController@store')->name('orphan.objectives.store');
    $router->get('/orphan/objective/edit', 'ObjectiveController@edit')->name('orphan.objectives.edit');
    $router->post('/orphan/objective/update', 'ObjectiveController@update')->name('orphan.objectives.update');
    $router->post('/orphan/objective/delete', 'ObjectiveController@delete')->name('orphan.objectives.delete');
});