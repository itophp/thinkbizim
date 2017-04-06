<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;
use app\common\controller\Homebase;

class User extends Homebase
{
	//User model
	public $model;
	//Request
	protected $_R;
	//user model
	protected $_DB;

	public function _initialize()
	{
		parent::_initialize();
		$this->_R = Request::instance();
		$this->_DB = Db::name('User');
	}

	public function openinfo(Request $request,$id = '')
	{

		$userId = intval($id);
		if( $userId == '' || $userId == 0 )
		{
			return $this->error('id is null!!');

		}else{
			//get userinfo
			$field = 'id,nickname as name,avatar,brithday,sex,signature,resume';
			$userInfo = $this->_DB->field($field)->where('id',$userId)->find();
			//var_dump($userInfo);

			$this->assign('openUser',$userInfo);
			return $this->fetch();
		}
	}
}