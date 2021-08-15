<?php 
function request($code,$input)
{
		$curl = curl_init();
		//$code=$_POST['code'];
		//$input=1;
		$data=array(
		    "clientId"=>"86a01da7af96b637e5409ceca44b8e5b",
		    "clientSecret"=>"6ca8754a10d0052a781d3a8fa5aadaa7816f59883b33f8508dbc174583dfd8c2",
		    "script"=>$code,
		    "stdin"=>$input,
		    "language"=>"java",
		    "versionIndex"=>"3"
		);
		$data=json_encode($data);
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://api.jdoodle.com/v1/execute',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>$data,
		  CURLOPT_HTTPHEADER => array(
		    'Content-Type: application/json'
		  ),
		));

		$result = curl_exec($curl);
		$result=json_decode($result);
		curl_close($curl);
		return $result->output;
}
?>