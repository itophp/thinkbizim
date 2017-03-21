<?php
namespace app\swoole\controller;

use think\Controller;
use think\Db;

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
		echo $data->cmd;
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
			//get session data
			$sessionData = $this->redis->get('PHPREDIS_SESSION:' . $data->sessid);
			//explode $sessionData
			$sessData = explode( '|', $sessionData );
			$sessData = unserialize( $sessData[1] );
			//check data
			if( $sessData['user']['token'] !== $secretTokenData->token ){
				$ws->push( $frame->fd,json_encode( error_msg(14011,true) ),1,true );
			}
			if( empty($sessData['user']) ){
				$ws->push( $frame->fd,json_encode( error_msg(14001,true) ),1,true );
			}
			$userData = $sessData['user'];
			//bind fd -- user_id
			$this->redis->delete('online-'.$userData['id'].'-fd');
			$this->redis->delete('online-'.$frame->fd.'-uid');
			$this->redis->set('online-'.$userData['id'].'-fd',$frame->fd);
			$this->redis->set('online-'.$frame->fd.'-uid',$userData['id']);
			//save user info
			$this->users[$userData['id']] = $userData;
			//send
			$sendData['cmd'] = 'newUser';
			$sendData['from_id'] = $userData['id'];
			$sendData['msg'] = 'Your friend:'.$this->users[$userData['id']]['nickname'].' is on the line!!';
			$this->sendToOnlineFriend($userData['id'],$sendData);
		}else{
			$ws->push( $frame->fd,json_encode( error_msg(14002,true) ),1,true );
		}
	}


	public function onClose($ws,$fd)
	{
		$redis = new \Redis();
		//connect redis
		$redis->connect('127.0.0.1',6379);
		$userId = $redis->get('online-'.$fd.'-uid');
		$redis->delete('online-'.$fd.'-uid');
		$redis->delete('online-'.$userId.'-fd');
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
		echo 'sendData';
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
		//get all friend
		$friendArr = Db::name('friends')->where(['user_id'=>$userId,'status'=>1])->column('friend_id');
		
		//find fd or redis
		foreach ( $friendArr as $id ) {
			//get fd
			$client_id = $this->redis->get('online-'.$id.'-fd');
			if( !empty($client_id) ){
				
				$client_id = $client_id[0];
				//send data
				$jsonData = json_encode($data,true);
				if( $this->serv->push($client_id,$jsonData,1,true) === false)
				{
					$this->serv->close($this->serv,$client_id);
					echo 'send failed!!';
				}
				echo 'send success!!';
			}else{
				
				continue;
			}
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