<?php
namespace app\swoole\controller;

use think\Controller;
use think\Db;
use swoole\Storage;

/**
* 
*/
class Websocket extends Controller
{
	/**
	 * WebSocket param
	 */
	//WebSocket host
	protected $host = '0.0.0.0';
	//WebSocket port
	protected $port = 9501;
	//Storage
	protected $storage;
	protected $serv;
	protected $redis;
	protected $users;
	/**
	 * Connection websocket
	 * event callback
	 *
	 */
	public function index()
	{

		//instantiation WebSocket server
		$this->serv = new \swoole_websocket_server($this->host,$this->port);
		$this->storage = new Storage();
		//listening connect event
		$this->serv->on('open',array($this,'onOpen'));
		//listening message event
		$this->serv->on('message',array($this,'onMessage'));
		//listening close event
		$this->serv->on('close',array($this,'onClose'));
		//WebSocket server start
		$this->serv->start();
	}

	/**
	 * 
	 * 
	 */
	public function onOpen($ws,$request)
	{
		//set callback data
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
		$data = json_decode($frame->data);
		//cmd
		switch ( $data->cmd ) {
			case 'login':
				$this->onLogin($frame);
				break;
			case 'getHistory':
			 	$this->onGetHistory();
			 	break;
			case 'getOnline':
				$this->onGetOnline();
				break;
			case 'message':
				echo 'message'."\n";
				$this->onNewMessage($ws,$frame);
				break;
		}
	}

	public function onLogin($frame)
	{
		echo $frame->fd.' :login';
		$data = json_decode($frame->data);
		//decrypt secretToken;
		$secretTokenArr = base_decrypt( $data->secretToken );
		//json_decode $secretTokenArr['data'];
		$secretTokenData = json_decode( $secretTokenArr['data'] );
		//get redis data
		//connect redis
		$this->redis = new \Redis();
		//connect redis
		if( $this->redis->connect('127.0.0.1',6379) ){
			//get sessData
			$sessData = $this->storage->getSessData($data->sessid);
			//check data
			if( $sessData['user']['token'] !== $secretTokenData->token ){
				$ws->push( $frame->fd,json_encode( error_msg(14011,true) ),1,true );
			}
			if( empty($sessData['user']) ){
				$ws->push( $frame->fd,json_encode( error_msg(14001,true) ),1,true );
			}
			$userData = $sessData['user'];
			//bind fd -- user_id
			$reLogin = $this->storage->online($userData['id'],$frame->fd);
			if( $reLogin == true ){
				//save user info
				$this->users[$userData['id']] = $userData;
				//send
				$sendData['cmd'] = 'newUser';
				$sendData['from_id'] = $userData['id'];
				$sendData['msg'] = 'Your friend:'.$this->users[$userData['id']]['nickname'].' is on the line!!';
				$this->sendToOnlineFriend($userData['id'],$sendData);
			}else{
				$ws->push( erro_msg(14012) );
				$ws->close($frame->fd);
			}
		}else{
			$ws->push( $frame->fd,json_encode( error_msg(14002,true) ),1,true );
		}
	}


	public function onClose($ws,$fd)
	{
		$userId = $this->storage->offline( $fd );
		$sendData['cmd'] = 'offLine';
		$sendData['from_id'] = $userId;
		$sendData['msg'] = 'Your friend:'.$this->users[$userId]['nickname'].' is off the line!!';
		$this->sendToOnlineFriend($userId,$sendData);
		echo $fd.'off-line';

	}

	/**
	 * 
	 *
	 */
	public function onNewMessage($ws,$frame)
	{
		
		$receiveData = json_decode($frame->data);
		//find toUser fd
		$toUser = $this->redis->get('online-'.$receiveData->to.'-fd');
		$fromUser = $this->redis->get('online-'.$receiveData->from.'-uid');
		//send msg
		if( !empty($toUser) ){
			//set sendData
			$sendData['cmd'] = 'newMessage';
			$sendData['from_id'] = $fromUser;
			$sendData['from_name'] = $this->users[$fromUser]['nickname'];
			$sendData['msg'] = trim($receiveData->msg);
			//send
			if( $ws->push( $toUser,json_encode($sendData),1,true ) ){
				echo 'sending success!!!';
			}else{
				echo 'sending failed!!!';
			}
		}else{
			//user off-online
			//save history
			echo $receiveData->to.'get failed!!';
		}
	}



	/**
	 * send json data to friend
	 */
	public function sendToOnlineFriend($userId,$data)
	{
		//get online friend
		$online = $this->storage->getOnlineFriend($userId);
		//find fd or redis
		foreach ( $online as $id ) {
			//set send data
			$jsonData = json_encode($data,true);
			if( $this->serv->push($id,$jsonData,1,true) === false)
			{
				$this->serv->close($this->serv,$client_id);
				echo 'send failed!!';
			}
			echo 'send success!!';
		}
	}

	/**
	 * 
	 */
	public function sendToFriend($userId,$data)
	{
		//

	}

}