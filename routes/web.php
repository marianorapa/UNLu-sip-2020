<?php

use Illuminate\Support\Facades\Route;

/*
 * Rutas de autenticación
 */
Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', 'Auth\RegisterController@getRegisterUser')->name('register');
Route::post('/register', 'Auth\RegisterController@RegisterUser')->middleware('checkUserExistence');


Route::get('/login', 'Auth\LoginController@login')->name('auth.login');
Route::post('/login', 'Auth\LoginController@authenticate')->name('login');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

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

/* Rutas de balanzas, ingresos y despachos --------------------------------------------------------------------------*/

Route::get('balanzas', 'BalanzaController@index')->name('balanzas.menu');

Route::resource('ingresos', 'EntradaController');
Route::get('/balanzas/ingreso/destroy/{id}', 'EntradaController@destroy')->name('balanzas.ingresos.destroy');

Route::get('/balanzas/ingreso/inicial', 'EntradaController@registroInsumoInicial')
    ->name('balanzas.ingresos.inicial');

Route::post('/balanzas/ingreso/inicial', 'EntradaController@guardarEntradaInicial')
    ->name('balanzas.ingresos.inicial.guardar');

Route::get('/balanzas/ingreso/finalizar/{id}', 'EntradaController@registroInsumoFinal')
    ->name('balanzas.ingresos.final');

Route::post('/balanzas/ingreso/finalizar', 'EntradaController@finalizarEntradaInsumo')
    ->name('balanzas.ingresos.final.guardar');


Route::resource('despachos', 'DespachoController');
Route::get('despachos/finalize/{id}', 'DespachoController@finalizeView')->name('despachos.finalize.view');
Route::post('despachos/finalize', 'DespachoController@finalizeDespacho')->name('despachos.finalize.post');
Route::get('despachos/cancel/{id}', 'DespachoController@destroy')->name('despachos.destroy');


/*
 *  Rutas de administracion, pedidos, empresas -----------------------------------------------------------------------
 * */


Route::get('/administracion', 'AdministracionController@index')->name('administracion.menu');

Route::get('/administracion/stock', 'StockController@index')->name('administracion.stock');
Route::get('/administracion/stock/insumos', 'StockController@indexInsumos')->name('administracion.stock.insumos');
Route::get('/administracion/stock/productos', 'StockController@indexProductos')->name('administracion.stock.productos');

Route::get('/administracion/stock/insumos/aumentarNoTrazable/{id}/{cliente}',
    'StockController@actualizarStockInsumoNoTrazable')->name('administracion.stock.insumos.ajustarNoTrazable');

Route::get('/administracion/stock/insumos/aumentarTrazable/{lote}/{cliente}',
    'StockController@actualizarStockInsumoTrazable')->name('administracion.stock.insumos.ajustarTrazable');

Route::post('/administracion/stock/insumos/registrarAjusteTrazable/{lote}/{cliente}',
    'StockController@registrarAjusteTrazable')
    ->name('administracion.stock.insumos.ajustarInsumoTrazable.post');

Route::post('/administracion/stock/insumos/registrarAjusteNoTrazable/{lote}/{cliente}',
    'StockController@registrarAjusteNoTrazable')
    ->name('administracion.stock.insumos.ajustarInsumoNoTrazable.post');

Route::get('/administracion/stock/productos/aumentar/{id}',
    'StockController@actualizarStockProducto')->name('administracion.stock.productos.ajustar');

Route::post('/administracion/stock/productos/registrarAumento/{id}',
    'StockController@registrarAjusteStockProducto')->name('administracion.stock.productos.ajustar.post');


Route::get('/administracion/empresas', 'EmpresasController@index')
    ->name('administracion.empresas');



Route::get('/showpedidos', function () {
    return view('administracion.pedidos.verPedido');
});


Route::resource('empresas', 'EmpresasController');

Route::resource('pedidos', 'OrdenProduccionController');
Route::get('pedidos/finalize/{id}', 'OrdenProduccionController@finalize')->name('pedidos.finalize');
Route::get('pedidos/cancel/{id}', 'OrdenProduccionController@cancel')->name('pedidos.cancel');

Route::get('administracion/prestamos', 'PrestamoController@index')->name('administracion.prestamos.index');


Route::get('/insumos', 'InsumoController@index')->name('insumos.index');
Route::get('/insumos/crear', 'InsumoController@createNormal')->name('insumos.create.normal');
Route::get('/insumos/especifico/crear', 'InsumoController@createEspecifico')->name('insumos.create.especifico');

Route::post('/insumos/guardar', 'InsumoController@storeNormal')->name('insumos.store.normal');
Route::post('/insumos/especifico/guardar', 'InsumoController@storeEspecifico')->name('insumos.store.especifico');

/*
    * Rutas de gerencia, informes, parametros -----------------------------------------------------------------------
*/

Route::get('gerencia', function () {
    return view('gerencia.index');
})->name('gerencia.index')->middleware('permission'); //Agregar junto a permiso


Route::get('/informes/estadistico', 'InformesController@informeEstadistico')->name('informes.estadistico');
Route::post('/informes/estadistico/generar', 'InformesController@generarInformeEstadistico')
    ->name('informes.estadistico.generar');

Route::get('/parametros', 'ParametrosController@index')->name('parametros.index');

Route::get('/parametros/precio/definir', 'ParametrosController@definirPrecio')->name('parametros.precio.view');
Route::post('/parametros/precio/guardar', 'ParametrosController@registrarPrecio')->name('parametros.precio.post');
Route::get('/parametros/precio', 'ParametrosController@indexPrecio')->name('parametros.precio.index');


Route::get('/parametros/capacidad/definir', 'ParametrosController@definirCapacidad')
    ->name('parametros.capacidad.view');
Route::post('/parametros/capacidad/guardar', 'ParametrosController@registrarCapacidad')
    ->name('parametros.capacidad.post');

Route::get('/parametros/capacidad', 'ParametrosController@indexCapacidad')->name('parametros.capacidad.index');

Route::get('/parametros/credito', 'ParametrosController@indexCredito')->name('parametros.credito.index');
Route::get('/parametros/credito/{id}', 'ParametrosController@renewCredito')->name('parametros.credito.edit');
Route::post('/parametros/credito/save', 'ParametrosController@renewCreditoPost')->name('parametros.credito.post');


// Rutas de errores
Route::get('/error/not_allowed', 'ErrorController@notAllowed')->name('error.not_permission');


// TODO Revisar si estas rutas siguen siendo necesarias o se pueden sacar pq las cubren los controllers de arriba

//definir precio x kg
Route::get('/precioXkg', function () {
    return view('/gerencia/parametrosProductivos/precioXkg');
})->name('pp.precio');

//gestion parametros productivos
Route::get('/gestionParametrosProductivos', function () {
    return view('/gerencia/parametrosProductivos/gestionParametrosProductivos');
});

//definir capacidad productiva
Route::get('/capacidadProductiva', function () {
    return view('gerencia/parametrosProductivos/capacidadProductiva');
})->name('pp.capacidadProductiva');


//gestion ordenes de produccion
Route::get('/gestionPedidos', function () {
    return view('administracion/pedidos/gestionPedidos');
});

//alta de pedido de produccion
/*Route::get('/altaPedidos', function() {
    return view('/administracion/pedidos/altaPedidosNew');
})->name('administracion.pedidos.altaPedidos');*/
/*Route::get('/altaPedidosnew', function() {
    return view('/administracion/pedidos/altaPedidosNew');
})->name('altaPedidosNew');*/

//finalizar ordenes
Route::get('/finalizarPedidos', function () {
    return view('/administracion/pedidos/finalizarPedidos');
})->name('finPedido');


//gestion despachos
Route::get('/gestionDespachos', function () {
    return view('/balanzas/despachos/gestionDespachos');
});

//inicializar despachos
Route::get('/pesajeInicialDespacho', function () {
    return view('/balanzas/despachos/pesajeInicialDespacho');
})->name('inicioDespacho');

//finalizar despachos
Route::get('/pesajeFinalDespacho', function () {
    return view('/balanzas/despachos/pesajeFinalDespacho');
})->name('finDespacho');


///peticiones asincrionas js
route::get('/insumosasinc', 'EntradaController@getInsumosTrazables')->name("asinc.insumosTrazabes");
route::get('/insumostodosasinc', 'EntradaController@getInsumosNoTrazables')->name("asinc.insumosNoTrazables");
route::get('/localidades', 'LocalidadController@getLocalidad')->name("asinc.localidades"); //cambiar a un controlador o ponerlo en el controlador de persona.
route::get('/getProductoCliente', 'OrdenProduccionController@getProductoCliente')->name("asinc.productos");
route::get('/getFormulaProducto', 'FormulaController@getFormulaProducto')->name("asinc.formulaProductos"); // este es el que se usa
route::get('/getCreditoCliente', 'PrestamoController@getCreditoCliente')->name('asinc.creditoCliente');
//route::get('/getFabricaProdForm', 'OrdenProduccionController@getFabricaProdForm')->name("asinc.fabricaProducto");
route::get('/getCapacidadProductivaRestante', 'ParametrosController@getCapacidadRestante')->name("asinc.capacidadProductivaRestante");
//peticion asincronica para despacho
route::get('/getOP', 'DespachoController@getOP')->name("asinc.ordenProduccion");
route::get('/getSaldoOp', 'OrdenProduccionController@getSaldoOp')->name("asinc.saldoOp");

//pdf
route::get('/personapdf', 'PersonaController@getPdfAll')->name('persona.pdf');
//pdf informe pedidos

route::get('/pedidopdf/{cliente?}/{producto?}', 'OrdenProduccionController@getPdfAll')->name('pedido.pdf');
//pdf ticket salida
route::get('/ticketSalidapdf/{id}', 'DespachoController@getPdfAll')->name('ticketSalida.pdf');
//pdf ticket entrada
route::get('/ticketEntradapdf/{id}', 'EntradaController@getPdfAll')->name('ticketEntrada.pdf');
//pdf pedido salida unitaria
route::get('/oppdf/{id}', 'OrdenProduccionController@getPdfOne')->name('op.pdf');


//peticion asincrona para create user
route::get('/autocompletar', 'PersonaController@autocompletar')->name('autocompletarPersonas');


//vistas para formula
//Route::get('/createFormula', function() {
//    return view('formula.createFormula');
//});
Route::resource('formula', 'FormulaController');
//route::get('/formulaIndex','FormulaController@index')->name('formula.index');
//route::get('/formulaCreate','FormulaController@create')->name('formula.create');
route::get('/getAllInsumos', 'FormulaController@getAllInsumos')->name('allInsumos');


//pedidos asincronico

route::get('/getpedidosjs', 'OrdenProduccionController@getpedidosjs')->name('allPedidos');


//productocreate
/*Route::get('/createProducto', function () {
    return view('/administracion.producto.createProducto');
})->name('producto.create');*/
//productoIndex
Route::resource('producto', 'AlimentoController');


//prueba validacion pedidos
route::get('/validar', 'OrdenProduccionController@validacionAsincrona')->name("asinc.validacionop");


