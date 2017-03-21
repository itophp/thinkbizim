<?php
namespace app\index\controller;

use think\Controller;
use think\Session;
use think\Cookie;

/**
* 
*/
class Swoole extends Controller
{
	/**
	 * swoole param
	 */
	//swoole host
	protected $host = '127.0.0.1';
	//swoole port
	protected $port = 9501;
	//swoole mode
	protected $mode = SWOOLE_PROCESS;
	//swoole set
	protected $swoole_set = [
		'worker_num' => 4,
	];

	public function index()
	{
	
		//instantiation socket server
		$serv = new \swoole_websocket_server($this->host,$this->port);
		//listening connect event
		$serv->on('open',array($this,'onOpen'));
		//listening message event
		$serv->on('message',array($this,'onMessage'));
		//listening close event
		$serv->on('close',array($this,'onClose'));

		//socket server start
		$serv->start();
	}

	/**
	 * 
	 * 
	 */
	public function onOpen($ws,$request)
	{
		$redis  = new \Redis();
			
		if(!$redis->connect('127.0.0.1',6379)){
			$errorData = 'Redis connect failed!!';
			return $this->error($errorData);
		}

		var_dump($redis->smembers('online-'));
		//$serv->bind($request,session('user.id'));
		//set callback data
		echo $request->fd;
		$msg['cmd'] = 'login';
		$msg['fd'] = $request->fd;
		$msg = json_encode($msg);
		$ws->push($request->fd,$msg);
	}

	/**
	 *
	 */
	public function onMessage($ws,$frame)
	{
		//var_dump(json_decode($frame->data));

	}

	public function onClose($ws,$fd)
	{
		//echo $fd;
	}

}