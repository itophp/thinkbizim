<?php
namespace app\index\controller;

use think\Controller;
use think\common\controller\Homebase;

class User extends Homebase
{
	//User model
	public $model;

	public function __initialize()
	{
		parent::__initialize();
	}
}