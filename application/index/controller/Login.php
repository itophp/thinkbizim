<?php
namespace app\index\controller;

use think\Controller;
use app\common\controller\Homebase;
use think\Request;
use think\Db;
use swoole\Storage;

class Login extends Homebase
{
	//set model
	protected $model;
	//set _initialie
	public function _initialize()
	{
		parent::_initialize();
		$domain = Request::instance()->domain();
		if( $domain == 'http://im.swoole.com' ){
			//model name
			$this->model = Db::name('user');
		}else{
			//return error
			return $this->error( error_msg(14011),'index/index' );
		}
		//halt(session('user'));
		//check user login status
		if( !empty(session('user.id')) ){
			//return redirect
			session('user',null);
			//$this->redirect('index/index');
		}
	}

	/**
	 * login method
	 * @return mixed
	 */
	public function index()
	{
		//phpinfo();die;
		return $this->fetch();		
	}

	/**
	 * dologin method
	 * @param post
	 * @return mixed
	 */
	public function dologin(Request $request)
	{

		
		//get param 
		//login_account
		$loginAccount = trim(input('login_account'));
		if( empty($loginAccount) ){
			return $this->error( error_msg(14003) );
		};
		//login_pass
		$loginPass = input('pass');
		//encrypt password
		$loginPass = encrypt_pwd($loginPass);
		//check user
		$field = 'id,nickname,email,mobile,avatar,token,status';
		$user = $this->model->where('passwd',$loginPass)->where('email',$loginAccount)->whereOr('mobile',$loginAccount)->whereOr('nickname',$loginAccount)->find();
		if( !empty( $user['id'] )) {

			//check user lock status
			if( $user['status'] == 2 ){
				return $this->error( error_msg(14004) );
			}
			//update token
			$user['token'] = create_token();
			$updateToken = $this->model->where('id',$user['id'])->update(['token'=>$user['token']]);
			//halt($updateToken);
			if($updateToken == false){
				return $this->error( error_msg(14005) );
			}
			//ini_set("session.save_handler", "redis");
			//ini_set("session.save_path", "tcp://127.0.0.1:6379");
			//halt(session_save_path());
			session('user',$user);
			$successData = 'Login success!!';
			return $this->success($successData,'chat/index');
		} else {
			return $this->error( error_msg(14006) );
		}
	}


	/**
	 * register method
	 * @param POST
	 * @return redirect
	 */
	public function register(Request $request)
	{
		//check post data
		$this->isPost($request);
		//set postData
		$postData = input();
		//check pass and repass
		if( $postData['pass'] !== $postData['repass'] ){
			return $this->error( error_msg(14007) );
		}
		//set insert data
		$insert = array();
		//user registration mode : email or mobile
		if( $postData['email'] ){
			$insertData['email'] = $postData['email'] ?? '';
		}elseif( $postData['mobile'] ){
			$insertData['mobile'] = $postData['mobile'] ?? '';
		}else{
			return $this->error( error_msg(14008) ,'index/index');
		}
		$insertData['nickname'] = $postData['nickname'] ?? '';
		$insertData['passwd'] = $postData['pass'] ?? '';
		$insertData['passwd'] = encrypt_pwd($insertData['passwd']);
		$insertData['status'] = '1';
		//validate insertData
		$validate = $this->validate($insertData,'User');
		if( $validate !== true ){
			//return error
			return $this->error($validate, 'index/index');
		}
		//insert user data
		$insertId = $this->model->insertGetId($insertData);
		if( $insert !== false ){
			return $this->success( error(14009),'login/index');
		}else{
			return $this->error( error_msg(14010),'login/register' );
		}	
	}
}