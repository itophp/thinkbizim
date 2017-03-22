<?php 
namespace swoole;

use think\Db;
use cache\Redis;
/**
 * 
 *
 */

class Storage
{
	protected $redis;

	public function __construct()
	{
		$this->redis = new \Redis();
		$this->redis->connect('127.0.0.1',6379);
	}

	/**
	 * get sessData
	 * @param $sessID
	 * @return array
	 */
	public function getSessData($sessID)
	{
		$sessionData = $this->redis->get('PHPREDIS_SESSION:' . $sessID);
		if( !empty($sessionData) ){
			//explode $sessionData
			$sessData = explode( '|', $sessionData );
			$sessData = unserialize( $sessData[1] );
			return $sessData;
		}else{
			return false;
		}
	}


	/**
	 * set online
	 * @param $uid
	 * @param $fd
	 */
	public function online($uid,$fd)
	{
		$res = $this->redis->multi()
					->delete('online-'.$uid.'-fd')
					->delete('online-'.$fd.'-uid')
					->set('online-'.$uid.'-fd',$fd)
					->set('online-'.$fd.'-uid',$uid)
					->exec();
		if( $res == true )
		{
			return true;
		}else{
			return false;
		}
	}

	public function offline($fd)
	{
		$userId = $this->redis->get('online-'.$fd.'-uid');
		if( !empty($userId) ){
			$res = $this->redis->multi()
							   ->delete('online-'.$fd.'-uid')
							   ->delete('online-'.$userId.'-fd')
							   ->exec();
			if( $res == true )
			{
				return $userId;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public function getOnlineFriend($userId)
	{
		$friendArr = Db::name('friends')->where(['user_id'=>$userId,'status'=>1])->column('friend_id');
		$onLineArr = [];
		//find fd or redis
		foreach ( $friendArr as $id ) {
			//get fd
			$client_id = $this->redis->get('online-'.$id.'-fd');
			if( !empty($client_id) ){
				$client_id = $client_id[0];
				//send data
				$onLineArr[] = $client_id;
			}else{
				continue;
			}
		}
		return $onLineArr;

	}




}