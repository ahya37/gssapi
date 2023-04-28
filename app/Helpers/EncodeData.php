<?php 

namespace App\Helpers;

class EncodeData
{
    public static function responseData($data_request, $refid=''){

            $keyecdc	= date('Ymd').'ultr4man9080';
			$jdata 	    = self::ecDroid(json_encode($data_request), $keyecdc);
	
			$postdata = http_build_query(
				array(
					'request' => $jdata,
				)
			);
	
			$opts = array('http' =>
				array(
					'method'  => 'POST',
					'header'  => 'Content-type: application/x-www-form-urlencoded',
					'content' => $postdata
				)
			);
	
	
			$context  = stream_context_create($opts);
	
			$hasil 	  = file_get_contents("https://app.digitalgss.com/gss-wservices/index.php", false, $context);
	
	
			$jsondata = self::dcDroid($hasil, $keyecdc) ;
	
			$jsondata = (array)json_decode($jsondata, true);
			
			if($refid != ''){
				
				return response()->json([
					'data' => $jsondata,
					'refid' => $refid
				],200);
			}else{
					return response()->json([
					'data' => $jsondata,
				],200);
			}

            
    }

    public static function encrypt_decrypt($action, $string, $key="universcode"){

        $output = false;

			$encrypt_method = "AES-128-CTR";
			$secret_key = $key;
			$secret_iv  = 'R3k4PoS202i';

			$key = hash('sha256', $secret_key);

			$iv = substr(hash('sha256', $secret_iv), 0, 16);

			if ( $action == 'encrypt' ) {
			  $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
			  $output = base64_encode($output);
			} else if( $action == 'decrypt' ) {
			  $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
			}

			return $output;

    }

    public static function ecDroid( $message, $key ) {
        return self::encrypt_decrypt( "encrypt", $message, $key);
    }

    public static function dcDroid( $message, $key ) {
        return self::encrypt_decrypt( "decrypt", $message, $key);
    }
}