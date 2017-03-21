<?php
namespace app\index\validate;

use think\validate;

class User extends validate
{
	protected $rule = [
		'email'		=>	'email',
		'mobile'		=>	'length:11',
		'nickname'	=>	'require',
		'passwd'		=>	'require',
	];

	protected $message = [
		'email.email'	=>	'Mailbox format error!!!',
		'mobile.length'	=>	'Phone format error!!!',
		'nickname'		=>	'Pleace enter nickname!!!',
		'passwd'			=>	'Pleace enter password!!!',
	];

}