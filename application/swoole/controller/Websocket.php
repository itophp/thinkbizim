<?php
namespace app\swoole\controller;

use think\Controller;
use think\Db;
use swoole\Storage;
use swoole\Swoole_redis;

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
	/**
	 * Connection websocket
	 * event callback
	 *
	 */
	public function index()
	{
		$this->storage = new Storage();
		$this->Swredis = new Swoole_redis();

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
		//cmd
		switch ( $data->cmd ) {
			case 'login':
				$this->onLogin($ws,$frame);
				break;
			case 'getHistory':
			 	$this->onGetHistory($frame->fd,$data);
			 	break;
			case 'getOnline':
				$this->onGetOnline($data);
				break;
			case 'message':
				echo 'message'."\n";
				$this->onNewMessage($ws,$frame);
				break;
		}
	}

	public function onLogin($ws,$frame)
	{
		echo $frame->fd.' :login'."\n";
		$data = json_decode($frame->data);
		//decrypt secretToken;
		$secretTokenArr = base_decrypt( $data->secretToken );
		//json_decode $secretTokenArr['data'];
		$secretTokenData = json_decode( $secretTokenArr['data'] );
		//get redis data
		//connect redis
		
		//get sessData
		$sessData = $this->storage->getSessData($data->sessid);
		//check data
		if( $sessData['user']['token'] !== $secretTokenData->token || empty($sessData['user']) ){
			$error_code = empty($sessData['user']) ? '14001' : '14011';
			$ws->push( $frame->fd,json_encode( error_msg($error_code,true) ),1,true );
			
		}
		$userData = $sessData['user'];
		//bind fd -- user_id
		$reLogin = $this->storage->online($userData,$frame->fd);
		if( $reLogin == true ){
			echo 'send:';
			//save user info
			$userData['fd'] = $frame->fd;
			//send
			$sendData['cmd'] = 'newUser';
			$sendData['from_id'] = $userData['id'];
			$sendData['msg'] = 'Your friend:'.$this->storage->getUserData($userData['id'],'nickname') . ' is on the line!!';
			$this->sendToOnlineFriend($userData['id'],$sendData);
		}else{
			$ws->push( $frame->fd, error_msg(14012) );
			$ws->close($frame->fd);
		}
	}


	public function onClose($ws,$fd)
	{
		$userId = $this->storage->offline( $fd );
		//set sendData
		$sendData['cmd'] = 'offLine';
		$sendData['from_id'] = $userId;
		$sendData['msg'] = 'Your friend:'.$this->storage->getUserData($userId,'nickname').' is off the line!!';
		//unset user info;
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
		$redis = new \Redis();
		//connect redis
		$redis->connect('127.0.0.1',6379);
		$fromUser = $receiveData->from;
		//get touser's fd
		$toUser = $this->Swredis->getOnline($receiveData->to,'fd');
		//send msg
		if( !empty($toUser) ){
			//set sendData
			$sendData['cmd'] = 'newMessage';
			$sendData['from_id'] = $fromUser;
			$sendData['from_name'] = $this->storage->getUserData($fromUser,'nickname');
			$sendData['msg'] = trim($receiveData->msg);
			$sendData['time'] = date("Y-m-d H:i:s",time());
			$historyData = ['from_id'=>$fromUser,'to_id'=>$receiveData->to,'msg'=>$sendData['msg'],'time'=>$sendData['time']];
			//save history;
			$saveHistory = $this->storage->saveHistory($historyData);
			if( !empty($saveHistory) ){
				//send
				if( $ws->push( $toUser,json_encode($sendData),1,true ) ){
					echo 'sending success!!!';
				}else{
					echo 'sending failed!!!';
				}
			}else{
				if( $ws->push( $frame->fd,error_msg(14013),1,true ) ){
					echo 'saveHistory failed sending success!!!';
				}else{
					echo 'saveHistory failed sending failed!!!';
				}
			}
			return true;
		}
		
		//user off-online
		echo $receiveData->to.'get failed!!';
		//save history
		$saveData['msg'] = trim($receiveData->msg);
		$saveData['time'] = date("Y-m-d H:i:s",time());
		$historyData = ['from_id'=>$fromUser,'to_id'=>$receiveData->to,'msg'=>$saveData['msg'],'time'=>$saveData['time']];
		//save history;
		$saveHistory = $this->storage->saveHistory($historyData);
		if( $saveHistory )
		{
			echo $saveData['msg'] . ' save success!!';
		}else{
			echo $saveData['msg'] . ' save failed!!';
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
				$this->serv->close($this->serv,$id);
				echo 'send failed!!';
			}
			echo 'send success!!';
		}
	}


	/**
	 *
	 */
	public function onGetHistory($fd,$data)
	{
		//get history
		if( $data->from ){
			if( $data->to ){
				$history = $this->storage->getHistory($data->from,$data->to,$data->type);
				//var_dump($history);
				//set sendData
				$sendData['cmd'] = 'getHistory';
				$sendData['from_id'] = $data->to;
				$sendData['html'] = $history;
				if( $this->serv->push( $fd,json_encode($sendData),1,true) )
				{
					echo "history send success!!!";
				}else{
					echo 'history send failed!!!';
				};
			}else{
				echo 'to_id is null!!!';
			}
		}else{
			echo 'from_id is null!!!';
		}
	}
}