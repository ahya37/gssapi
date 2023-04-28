<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\EncodeData;
use Validator;

class SaldoController extends Controller
{
    protected $header;
    protected $key;

    public function __construct(){

        $this->header = request()->header('Authorization');
        $this->key    = env('GSS_KEY');

    }
    public function getFavoriteSaldo(Request $request){

		try {
			
			$cmd = "1111";

			$AccKey = $this->header;
	
			$dataarr	= array(
				"AccKey" => $AccKey,
			);
	
			$data_request = array(
				"key" => $this->key,
				"act" => $cmd,
				"data" => $dataarr,
			);
	
			return EncodeData::responseData($data_request);

		} catch (\Exception $e) {
			return response()->json([
				'message' => $e->getMessage()
			]);
		}

    }

    public function getInfoAllSaldo(Request $request){

		try {
			
			$cmd = "1123";
	
			$dataarr	= array(
				"AccKey" => $this->header,
			);
	
			$data_request = array(
				"key" => $this->key,
				"act" => $cmd,
				"data" => $dataarr,
			);
	
			return EncodeData::responseData($data_request);

		} catch (\Exception $e) {
			return response()->json([
				'message' => $e->getMessage()
			]);
		}

    }

    public function getInfoMutasiSaldo(Request $request){

		try {
			
            #data mutasi == info semua saldo
			return $this->getInfoAllSaldo($request);

		} catch (\Exception $e) {
			return response()->json([
				'message' => $e->getMessage()
			]);
		}

    }

    public function getDetailInfoMutasiSaldo(Request $request){

		try {
			
            $cmd = "1541";
	
			$dataarr	= array(
				"AccKey" => $this->header,
                "AccNo"	=> $request->AccNo,
		
                "Rw1"	=> $request->Rw1,
                "Rw2"	=> $request->Rw2,#row limit 30 mx
                
                "Dts"	=> $request->Dts,#date start date("Y-m-d")
                "Dte"	=> $request->Dte,#date limit date("Y-m-d")
			);
	
			$data_request = array(
				"key" => $this->key,
				"act" => $cmd,
				"data" => $dataarr,
			);
	
			return EncodeData::responseData($data_request);
			

		} catch (\Exception $e) {
			return response()->json([
				'message' => $e->getMessage()
			]);
		}

    }
}
