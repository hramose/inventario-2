<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});




# Rutas de Inicio de sesión
Route::get('login', 'AuthController@showLogin');

Route::get('admin/login', 'AuthController@showLogin');
Route::post('admin/login', 'AuthController@postLogin');


Route::group(array('before' => 'auth'), function()
{
    Route::get('admin/', function(){
    	return View::make('admin/index');
    });

    Route::get('admin/logout', 'AuthController@logOut');
    
    # Administración de usuarios
	Route::resource('admin/users', 'UserController');
	Route::resource('admin/proveedores', 'ProveedorController');
	Route::resource('admin/clientes', 'ClienteController');
	Route::resource('admin/datos', 'DatoController');
	Route::resource('admin/productos', 'ProductoController');
	Route::resource('admin/vehiculos', 'VehiculoController');

	#Registro de Compra y actualización de stock
	Route::resource('admin/compras','CompraController');

	#Registro de Venta, lista de productos y stock
	Route::resource('admin/ventas','VentaController');	


});
