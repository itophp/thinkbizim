<?php 
namespace app\index\operation;

use think\Controller;
use think\Db;

class User extends Controller
{

	protected $_DB;

	public function __initialize ()
	{
		parent::__initialize();
		$this->_DB = Db::name('User');
	}

	public function getUserInfo($userId,$field = '',$isStatus)
	{
		
	}

}