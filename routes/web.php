<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', 'WelcomeController@index')->name('welcome');

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['role_or_permission:Administrador']], function () {
    Route::get('user/{user}/roles', 'UserController@roles')->name('user.roles');
    Route::put('user/{user}/roles/sync', 'UserController@rolesSync')->name('user.rolesSync');
    Route::resource('user', 'UserController');
    Route::any('/user/search', 'UserController@search')->name('user.search');
});

Route::group(['middleware' => ['role_or_permission:Administrador']], function () {
    Route::get('role/{role}/permissions', 'RoleController@permissions')->name('role.permissions');
    Route::put('role/{role}/permission/sync', 'RoleController@permissionsSync')->name('role.permissionsSync');
    Route::resource('role', 'RoleController');
    Route::any('/role/search', 'RoleController@search')->name('role.search');
});

Route::resource('permission', 'PermissionController')->middleware(['role_or_permission:Administrador']);
Route::any('/permission/search', 'PermissionController@search')->name('permission.search');

Route::get('/post', 'PostController@index')->name('post.index');

Route::get('/post/create', 'PostController@create')->name('post.create');
Route::post('/post', 'PostController@store')->name('post.store');

Route::match(['put', 'patch'], '/post/{post}', 'PostController@update')->name('post.update');

Route::get('/post/{post}', 'PostController@show')->name('post.show');
Route::delete('/post/{post}', 'PostController@destroy')->name('post.destroy');
Route::get('/post/{post}/edit', 'PostController@edit')->name('post.edit');


Route::resource('branch', 'BranchController');
Route::any('/branch/search', 'BranchController@search')->name('branch.search');

Route::resource('notice', 'NoticeController');

Route::resource('menu', 'MenuController');

Route::resource('birthday', 'BirthdayController');

Route::resource('compliment', 'ComplimentsController');

Route::resource('carousel', 'CarouselController');

Route::group(['prefix' => 'sectors'], function () {

    Route::get('/sector', 'SectorController@index')->name('sector');

    Route::resource('administrative', 'AdministrativeController');

    Route::resource('assistance', 'AssistanceController');

    Route::resource('personalDepartment', 'PersonalDepartmentController');

    Route::resource('humanResource', 'HumanResourceController');

    Route::resource('sesmt', 'SesmtController');

    Route::resource('technology', 'TechnologyController');

    Route::resource('marketing', 'MarketingController');

    Route::resource('quality', 'QualityController');

    Route::resource('sac', 'SacController');

    Route::resource('permanentEducation', 'PermanentEducationController');

    Route::resource('ccih', 'CcihController');

    Route::resource('controllership', 'ControllershipController');

    Route::resource('medicalRelationship', 'MedicalRelationshipController');

});


Route::group(['prefix' => 'sectors/homes'], function () {

    Route::get('list_trainings', 'ListTrainingController@index')->name('list_trainings');

    Route::resource('training', 'TrainingController');

    Route::resource('revenues', 'RevenuesController');;

    Route::resource('attendance', 'AttendanceController');

    Route::resource('financial', 'FinancialController');

    Route::resource('advice', 'AdviceController');

    Route::resource('supply', 'SupplyController');

    Route::resource('support', 'SupportController');
});
