<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: wuyuezhong 
// +----------------------------------------------------------------------

// 应用公共文件
/**
 *===============================================================================================
 *
 *===============================================================================================
 */
function encrypt_pwd($passwd)
{

	if(!empty($passwd)){
		//encrypt
		$pass = md5(md5($passwd . 'junim'));
		
		//return encrypt password
		return $pass;
	}else{
		return $this->error('password don\'t exist!!');
	}
}


/**
 *===============================================================================================
 * set user token
 * 
 *===============================================================================================
 */
function create_token()
{
	//set token str
	$tokenStr = microtime().rand(1000,9999);
	//encrty token
	$encrtyToken = md5(md5($tokenStr.'jungo'));
	//Intercept encrty token
	$token = substr($encrtyToken,1,30);
	//return token
	return $token;
}


/**
 *===============================================================================================
 * base encryption
 * @param $json
 * @param $type user or other
 * @return encrypt string
 *===============================================================================================
 */
function base_encrypt($arr,$type = 'user')
{
	//check $json is not json data
	$json = json_encode($arr,true);
	//Mosaic encrypt string
	$encryptStr = $json.'_-'.$type.'_-'.rand(1000,9999);
	//encrypt
	$encryptStr = base64_encode($encryptStr);
	//return encryptstr
	return $encryptStr;
}


/**
 *===============================================================================================
 * base decryption
 * @param $encrypt string
 * @return arr
 *===============================================================================================
 */
function base_decrypt($encryptStr)
{
	//decrypt
	$decryptStr = base64_decode($encryptStr);
	//explode str
	$decryptArr = explode('_-', $decryptStr);

	$decryptArrRe['data'] = $decryptArr[0];
	$decryptArrRe['type'] = $decryptArr[1];

	return $decryptArrRe;
}


/**
 *===============================================================================================
 * login_status
 * @param $userId not null
 * @return string
 *===============================================================================================
 */
function login_status( $userId )
{
	//check $userId isnot int
	if( is_int($userId) )
	{
		$redis = new \Redis();
		$redis->connect('127.0.0.1',6379);
		$fd = $redis->get('online-'.$userId.'-fd');
		if( !empty($fd) )
		{
			return '在线';
		}else
		{
			return '离线';
		}
	}else{
		return 'Pleace entry int data';
	}
}


/**
 *===============================================================================================
 * error_msg
 * @param $error_code not null
 * @param $swoole not null defult:false
 * @return string or array
 *===============================================================================================
 */
 function error_msg($error_code,$swoole = false)
 {
 	//include ../app/error.php
 	$error = include APP_PATH .'error.php';
 	$error_msg = $error[$error_code];
 	//check isnot swoole
 	if( $swoole == true ){
 		//set errorData
 		$errorData['cmd'] = 'error';
		$errorData['error_code'] = $error_code;
		$errorData['error_data'] = $error_msg;
		return $errorData;
 	}else{
 		return $error_msg;
 	}
 }