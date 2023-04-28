<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\EncodeData;
use Validator;

class LoginController extends Controller
{
    public function store(Request $request){

		try {
			
			$validator = Validator::make($request->all(), [
				'AccUser'      => 'required',
				'AccPass'     => 'required',
				
			]);
			
			if ($validator->fails()) {
				return response()->json([
					'error' =>$validator->errors()
				],422);
			}
			
			$cmd = "1000";
	
			$dataarr	= array(
				"AccUser"	=> $request->AccUser,
				"AccPass"	=> $request->AccPass,
			);
			
			$data_request = array(
				"key" => "Ymlhb2BsYW5hbmJsZHBiaWVrYHA%3D",
				"act" => $cmd,
				"data" => $dataarr,
			);

			return EncodeData::responseData($data_request);

		} catch (\Exception $e) {

			return response()->json([
				'message' => 'Somethin when wrong!',
				'error' => $e->getMessage()
			],500);
		}

    }

}
