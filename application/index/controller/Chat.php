<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Session;

class Chat extends Controller
{
	public function _initialize()
	{
		parent::_initialize();
		//halt(session('user.id'));
		//check user login status
		if( empty(session('user.id')) )
		{
			//redirect login controller
			$this->redirect('login/index');
		}
	}

	/**
	 * Chat page
	 * @return mixed
	 */
	public function index()
	{
		//session('user',null);
		//get all friend
		$field = 'b.id,a.friend_id,a.status,b.nickname,b.avatar';//get field
		$where = ['a.status'=>1,'a.user_id'=>session('user.id')];//select where
		$friends = Db::name('friends')->alias('a')->join('__USER__ b','b.id=a.friend_id')->field($field)->where($where)->select();
		//assign friend list
		$this->assign('friends',$friends);
		//set tpl user data
		$tplUser['id'] = session('user.id');
		$tplUser['token'] = session('user.token');
		$tplUser['name'] = session('user.nickname');
		$tplUser['avatar'] = session('user.avatar');
		$tplUser['secretToken'] = session('secretToken');
		$this->assign('user',$tplUser);

		//get All online doctor
		$this->assign('doctors',$doctors);

		return $this->fetch();
	}
}
