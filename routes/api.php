<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function(){
	
	Route::post('login','LoginController@store');
	
	Route::group(['middleware' => 'authtoken'], function(){
		
		Route::group(['prefix' => 'saldo'], function(){

			Route::get('/','SaldoController@getFavoriteSaldo');
			Route::get('info','SaldoController@getInfoAllSaldo');
		});

		Route::group(['prefix' => 'mutasisaldo'], function(){

			Route::get('/list','SaldoController@getInfoAllSaldo');
			Route::post('/detail','SaldoController@getDetailInfoMutasiSaldo');
		});

		Route::group(['prefix' => 'transferanggota'], function(){

			Route::get('/listtransfer','TransferAnggotaController@getDataListTransfer');
			Route::post('/save','TransferAnggotaController@saveTransferAnggota');
			Route::post('/cekrekeningtujuan','TransferAnggotaController@pengecekanRekeningTujuan');
			Route::post('/addrekeningtujuan','TransferAnggotaController@saveAddRekeningTujuan');
			Route::post('/deleterekeningtujuan','TransferAnggotaController@deleteListRekening');
			Route::post('/inboxtransfer','TransferAnggotaController@getDataListInboxTransfer');
		});
		
		Route::group(['prefix' => 'pembayarananggota'], function(){

			Route::get('/infotagihan','PembayaranAnggotaController@getDataInfoTagihan');
			Route::post('/infotagihan/kartu','PembayaranAnggotaController@getDataInfoTagihanKartu');
			Route::post('/infotagihan/riwayat','PembayaranAnggotaController@getDataInfoTagihanRiwayat');
		   
		});
		
		Route::group(['prefix' => 'kontak'], function(){

			Route::post('/','KontakController@getKontak'); 
		   
		});
		
		Route::group(['prefix' => 'pin'], function(){

			Route::post('/update/requestoken','PinController@updatePinReqToken'); 
			Route::post('/update/store','PinController@updatePin');
		   
		});
		
		Route::group(['prefix' => 'password'], function(){

			Route::post('/update/requestoken','ProfilController@updatePasswordReqToken'); 
			Route::post('/update/store','ProfilController@updatePasssword'); // rescode = 94, Data tidak ditemukan
		   
		});
	
	});

});


