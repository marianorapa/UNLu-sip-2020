<?php

use Illuminate\Support\Facades\Route;

/*
 * Rutas de autenticación
 */
Route::get('/', function() {
    return view('welcome');
});

Route::get('/register', 'Auth\RegisterController@getRegisterUser')->name('register');
Route::post('/register', 'Auth\RegisterController@RegisterUser')->middleware('checkUserExistence');

    //Route::get('/register', 'Auth\RegisterController@CheckUserExistence');

Route::get('/login', 'Auth\LoginController@login')->name('auth.login');
Route::post('/login', 'Auth\LoginController@authenticate')->name('login');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

    //Auth::routes()->middleware('checkUserExistence');

/*
 * Rutas protegidas
 */
Route::get('/main', 'HomeController@index')->name('main');

Route::get('/admin', 'AdminController@index')->name('admin.menu');

Route::resource('users', 'UserController');

Route::get('users/activate/{id}', 'UserController@activate')->name('users.activate');
Route::get('personas/activate/{id}', 'PersonaController@activate')->name('personas.activate');
Route::get('permisos/activate/{id}', 'PermisoController@activate')->name('permisos.activate');
Route::get('roles/activate/{id}', 'RoleController@activate')->name('roles.activate');

Route::resource('roles', 'RoleController');
Route::resource('permisos', 'PermisoController');
Route::resource('personas', 'PersonaController');

Route::get('balanzas', 'BalanzaController@index');

Route::resource('ingresos', 'IngresoController');


/*
 * TODO: Rutas de usuario balanza/administración
 */

// GUARDA ACA!!! PORQUE EL USERCONTROLLER GESTIONA USUARIOS, NO NOT_ADMIN! <---
Route::get('/usuario', 'NoAdminController@index')->name('not.admin');


// Rutas de errores
Route::get('/error/not_allowed', 'ErrorController@notAllowed')->name('error.not_permission');


//views hechas a partir de los wareframe

Route::get('/registroinsumoini', function() {
    return view('balanzas/ingresos/registroinsumo');
});

Route::get('/registroinsumofin', function() {
    return view('balanzas/ingresos/registroinsumofinal');
});