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

Route::get('/', function () {
    return view('tela_login');
})->name('/');

Route::get('/cadastro', function(){
    return view('cadastro');
});

route::get('/teste', function(){
    return view('teste');
});


Route::post('cadastro', 'Auth\RegisterController@create')->name('create');      
Route::post('registro', 'Auth\RegisterController@registrar')->name('registro');


Route::group(['middleware'=>['auth']], function()
{
    Route::resource('suspeitos', 'SuspeitoController');
    Route::resource('policial', 'PolicialController');
    Route::resource('inicio', 'HomeController');
    Route::resource('dispensa', 'DispensaController');
    Route::resource('abono', 'AbonoController');
    Route::resource('inicial', 'Auth\LoginController');
    Route::resource('permutas', 'PermutarController');
    Route::resource('crimes', 'CrimeController');

    //ROTA TELA INICIAL

    Route::get('home', 'HomeController@home')->name('home');

    //ROTA SUSPEITO

    Route::get('suspeito/{id}', 'SuspeitoController@Listacrimes')->name('crimes');
    Route::get('/registrar_crime/{suspeito}', 'CrimeController@registrar')->name('registrar');

    //ROTA PERMUTA
    Route::get('permuta', 'PermutarController@indexer')->name('index');
    Route::get('excluirpermuta/{id}', 'PermutarController@deletar')->name('deletar');
    Route::get('confirma/{id}', 'PermutarController@atualizarStatus')->name('atualizarStatus');
    Route::get('confirmaSPO/{id}', 'PermutarController@SPO')->name('spo');
    Route::get('SPOregeitada/{id}', 'PermutarController@nao')->name('nao');
    Route::get('CMDregeitada/{id}', 'PermutarController@naoCMD')->name('naoCMD');
    Route::get('imprimirPermuta/{permuta}', 'PermutarController@imprimir')->name('imprimirPermuta');
    Route::get('aceitar/{id}', 'PermutarController@aceitar')->name('aceitar');
    Route::get('refazer/{id}', 'PermutarController@refazer')->name('refazer');
    Route::get('confirmaCMD/{id}', 'PermutarController@CMD')->name('cmd');
    Route::get('teste', 'PermutarController@teste')->name('teste');
    Route::get('Atualizarpermuta/{id}, PermutarController@refazerPermuta')->name('refazerPermuta');

    //ROTA DISPENSA

    Route::get('confirmaSPO/{id}', 'DispensaController@SPO')->name('spoDispensa');
    Route::get('SPOregeitada/{id}', 'DispensaController@nao')->name('naoDispensa');
    Route::get('CMDregeitada/{id}', 'DispensaController@naoCMD')->name('naoCMDDispensa');
    Route::get('imprimirDispensa/{dispensa}', 'DispensaController@imprimir')->name('imprimirDispensa');
    Route::get('refazer/{id}', 'DispensaController@refazer')->name('refazerDispensa');
    Route::get('confirmaCMD/{id}', 'DispensaController@CMD')->name('cmdDispensa');
    Route::get('imprimirDispensa/{dispensa}', 'DispensaController@imprimir')->name('imprimirDispensa');
    
    //Route::get('abono_sub/{id}', 'AbonoController')->name('sub');
});

Route::Auth();



