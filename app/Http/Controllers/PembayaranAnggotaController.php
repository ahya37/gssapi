<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Helpers\EncodeData;
use App\Helpers\MicroTime;
use Illuminate\Support\Facades\DB;

class PembayaranAnggotaController extends Controller
{
	protected $header;
    protected $key;

    public function __construct(){

        $this->header = request()->header('Authorization');
        $this->key    = env('GSS_KEY');

    }
	
    public function getDataInfoTagihan(){

        try {
			
			$cmd = "M2101";
	
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
	
	public function getDataInfoTagihanKartu(Request $request){

        try {
			
			$cmd = "M2105";
	
			$dataarr	= array(
				"AccKey" => $this->header,
				"AccNoPinjam" => $request->AccNoPinjam,
				
				"Rw1"	=> $request->Rw1,
                "Rw2"	=> $request->Rw2,#row limit 30 mx
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
	
	public function getDataInfoTagihanRiwayat(Request $request){

        try {
			
			$cmd = "M2106";
	
			$dataarr	= array(
				"AccKey" => $this->header,
				"AccNoPinjam" => $request->AccNoPinjam,
				
				"Rw1"	=> $request->Rw1,
                "Rw2"	=> $request->Rw2,#row limit 30 mx
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
