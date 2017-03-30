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
	 * @param $uid not null
	 * @param $fd not null
	 * @return bool
	 */
	public function online($data,$fd)
	{
		$uid = $data['id'];
		if( $uid ){
			//redis bind userid -- fd
			$this->redis->delete('online-'.$uid.'-fd');
			$this->redis->delete('online-'.$fd.'-uid');
			
			$this->redis->set('online-'.$uid.'-fd',$fd);
			$this->redis->set('online-'.$fd.'-uid',$uid);
			//clear old user data
			$this->redis->delete('user_data_'.$uid);
			//create new user data
			$this->redis->set('user_data_'.$uid,$data);
			return true;
		}
		return false;		
	}

	/**
	 * off-line
	 * @param $fd not null
	 * @return int or bool
	 */
	public function offline($fd)
	{
		//get userid of fd
		$userId = $this->redis->get('online-'.$fd.'-uid');
		if( !empty($userId) ){
			//redis delete user linedata
			$this->redis->delete('online-'.$fd.'-uid');
			$this->redis->delete('online-'.$userId.'-fd');
			$this->redis->delete('user_data_'.$userId);
			return $userId;
		}else{
			return false;
		}
	}

	/**
	 * getOnlineFriend
	 * @param $userId not null
	 * @return array
	 */
	public function getOnlineFriend($userId)
	{
		//get all friend
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

	/**
	 * saveHistory
	 * @param $uid not null
	 * @param $fid not null
	 * @param $type not null default:'1' 1:user 2:group
	 * @return array
	 */
	public function saveHistory($data,$type = 1)
	{
		//data : from_id to_id msg time group
		if( $type == 1 ){
			//touser is user
			$saveHistory = db('history')->insert($data);
			if( $saveHistory == true )
			{
				return $data;
			}else{
				//if save failed , use redis save
				$this->redis->sadd('userHistory',json_encode($data));
				//return $data
				return '12345';
			}
		}elseif( $type == 2 ){
			//touser is group
		}


	}

	/**
	 *
	 */
	public function getHistory($uid,$fid,$type = 1)
	{
		//Set query condition
		$where = 'from_id='.$uid.' and to_id='.$fid;
		$whereOr =  'from_id='.$fid.' and to_id='.$uid;
		$history = Db::name('history')->where($where)->whereOr($whereOr)->order('time')->limit(10)->select();
		$fromUserName = Db::name('user')->where('id',$uid)->value('nickname');
		$toUserName = Db::name('user')->where('id',$fid)->value('nickname');
		$reData = '';
		foreach ($history as $key) {
			if( $key['from_id'] == $uid ){
				$reData .= 
				'<div class="my_say_con">
				<font color="#0000FF">'.$fromUserName.'&nbsp;&nbsp;&nbsp;'.$key['time'].'</font>
				<p><font color="#333333">'.$key['msg'].'</font></p>
				</div>';
			}elseif( $key['from_id'] == $fid )
			{
				$reData .= 
				'<div class="my_say_con">
				<font color="#76EE00">'.$toUserName.'&nbsp;&nbsp;&nbsp;'.$key['time'].'</font>
				<p><font color="#333333">'.$key['msg'].'</font></p>
				</div>';
			}
		}
		return $reData;
	}
}