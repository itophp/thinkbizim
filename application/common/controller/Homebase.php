<?php
namespace app\common\controller;

use think\Controller;
use think\Request;

class Homebase extends Controller
{

	public function _initialize()
	{

		//Check domain name is correct
		$domain = Request::instance()->domain();
		if($domain !== 'http://im.swoole.com'){
			return $this->error('Illegal operation');
		}
		//check end
		//Check whether the user login
		if( !empty(session('user.id')) ){
			//Judge token time
			$nowTime = date('Y-m-d H:i:s',time());
			$tokenTime = $nowTime-session('user.token_time');
			if( $tokenTime >= 3600 )
			{
				//Modify token
				$token = create_token();
				//save database
				$saveToken = db('user')->where('token',session('user.token'))->save(['token'=>$token,'token_time'=>$nowTime]);
				//reset session
				session('user.token',$token);
			}
		}
		//check end 
	}

	/**
	 * isPost : check is not post data
	 */
	protected function isPost($request)
	{
		if(!$request->isPost()){
			//error data
			$error_data = 'Illegal operation!!';
			//redirect
			return $this->error( $error_data ,'index/index');
		}
	}

}