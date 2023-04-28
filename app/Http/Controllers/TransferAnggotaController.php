<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Helpers\EncodeData;
use App\Helpers\MicroTime;
use Illuminate\Support\Facades\DB;

class TransferAnggotaController extends Controller
{
    protected $header;
    protected $key;

    public function __construct(){

        $this->header = request()->header('Authorization');
        $this->key    = env('GSS_KEY');

    }

    public function getDataListTransfer(){

        try {
			
			$cmd = "1444";
	
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

    public function pengecekanRekeningTujuan(Request $request){

        try {

            $validator = Validator::make($request->all(), [
				'AccNo'      => 'required',				
			]);
			
			if ($validator->fails()) {
				return response()->json([
					'error' =>$validator->errors()
				],422);
			}
			
			$cmd = "1205";
	
			$dataarr	= array(
				"AccKey" => $this->header,
                "AccNo" => $request->AccNo
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

    public function saveAddRekeningTujuan(Request $request){

        // DB::beginTransaction();
        try {

            $validator = Validator::make($request->all(), [
				'AccNo'      => 'required',
                'AccPin'	 => 'required'		
			]);
			
			if ($validator->fails()) {
				return response()->json([
					'error' => $validator->errors()
				],422);
			}
			
			$cmd = "1812";
	
			$dataarr	= array(
				"AccKey" => $this->header,
                "AccNo" => $request->AccNo,
                "AccPin" => $request->AccPin
			);
	
			$data_request = array(
				"key" => $this->key,
				"act" => $cmd,
				"data" => $dataarr,
			);
	
            // DB::commit();
			return EncodeData::responseData($data_request);

		} catch (\Exception $e) {
            // DB::rollBack();
			return response()->json([
				'message' => $e->getMessage()
			]);
		}

    }

    public function deleteListRekening(Request $request){

        // DB::beginTransaction();
        try {

            $validator = Validator::make($request->all(), [
				'AccNo'      => 'required',
                'AccPin'	 => 'required'		
			]);
			
			if ($validator->fails()) {
				return response()->json([
					'error' => $validator->errors()
				],422);
			}
			
			$cmd = "1545";
	
			$dataarr	= array(
				"AccKey" => $this->header,
                "AccNo" => $request->AccNo,
                "AccPin" => $request->AccPin
			);
	
			$data_request = array(
				"key" => $this->key,
				"act" => $cmd,
				"data" => $dataarr,
			);
	
            // DB::commit();
			return EncodeData::responseData($data_request);

		} catch (\Exception $e) {
            // DB::rollBack();
			return response()->json([
				'message' => $e->getMessage()
			]);
		}

    }

    public function saveTransferAnggota(Request $request){
        
        try {

            $validator = Validator::make($request->all(), [
                "AccNo"		=> "required",
                "AccPin"	=> "required",
                "AccNoTrsf"	=> "required",
                "TrsfAmount"	=> "required",
                "TrsfDesc"		=> "nullable",	
			]);
			
			if ($validator->fails()) {
				return response()->json([
					'error' => $validator->errors()
				],422);
			}
			
			$cmd = "1101";

            $micro_time = MicroTime::get_idmicrotime(10);
	
			$dataarr	= array(
				"AccKey" => $this->header,
                "AccNo" => $request->AccNo,
                "AccPin" => $request->AccPin,
                "AccNoTrsf"	=> $request->AccNoTrsf,
                "TrsfAmount"	=> $request->TrsfAmount,
                "TrsfRefNo"		=> $micro_time,
                "TrsfDesc"		=> $request->TrsfDesc,
                "refid"			=> $micro_time,
			);
	
			$data_request = array(
				"key" => $this->key,
				"act" => $cmd,
				"data" => $dataarr,
			);

	
			$response = EncodeData::responseData($data_request);

            $data = $response;

           
            return response()->json([
                'data' => $data
            ]);


		} catch (\Exception $e) {
			return response()->json([
				'message' => $e->getMessage()
			]);
		}

    }
	
	public function getDataListInboxTransfer(Request $request){

        try {
			
			
			
			$cmd = "1414";
	
			// $dataarr	= array(
				// "AccKey" => $this->header,
                // "query"	=> $request->query,
		
                // "Rw1"	=>$request->Rw1,
                // "Rw2"	=> $request->Rw2,#row limit 30 mx
                
                // "Dts"	=> $request->Dts,#date start date("Y-m-d")
                // "Dte"	=> $request->Dte,#date limit date("Y-m-d")
			// );
			
			$dataarr	= array(
				"AccKey" => $this->header,
                "query"	=> request('query'),
		
                "Rw1"	=> request('Rw1'),
                "Rw2"	=> request('Rw2'),#row limit 30 mx
                
                "Dts"	=> request('Dts'),#date start date("Y-m-d")
                "Dte"	=>  request('Dte'),#date limit date("Y-m-d")
			);
			
	
			$data_request = array(
				"key" => $this->key,
				"act" => $cmd,
				"data" => $dataarr,
			);
			
			// return $data_request;
	
			return EncodeData::responseData($data_request);

		} catch (\Exception $e) {
			return response()->json([
				'message' => $e->getMessage()
			]);
		}
    }

    
}
