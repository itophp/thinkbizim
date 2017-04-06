<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use app\common\controller\Homebase;

class User extends Homebase
{
	//User model
	public $model;

	public function __initialize()
	{
		parent::__initialize();
		$this->_R = Request::ins
	}

	public function openinfo(Request $request,$id = '')
	{
		var_dump($request);
		// if( intval($id) == '' || intval($id) == 0 )
		// {
		// 	return $this->error('id is null!!');

		// }else{

		// 	return $this->fetch();
		// }
	}
}