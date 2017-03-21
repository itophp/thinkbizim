<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{
	public function _initialize()
	{

	}

	public function index()
	{
		return $this->redirect('index/login/index');
	}

}