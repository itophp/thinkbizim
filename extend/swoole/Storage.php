<?php 
namespace swoole;

use think\Db;
use swoole\Swoole_redis;
/**
 * 
 *
 */

class Storage
{

	public function __construct()
	{
		$this->Swredis = new Swoole_redis();
	}

	/**
	 * get sessData
	 * @param $sessID
	 * @return array
	 */
	public function getSessData($sessID)
	{
		$sessionData = $this->Swredis->getSessData( $sessID );
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
			$this->Swredis->deleteOnline($uid,'fd');
			$this->Swredis->deleteOnline($fd,'uid');
			
			$this->Swredis->setOnline($uid,$fd,'fd');
			$this->Swredis->setOnline($fd,$uid,'uid');
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
		$userId = $this->Swredis->getOnline($fd,'uid');
		if( !empty($userId) ){
			//redis delete user linedata
			$this->Swredis->deleteOnline($fd,'uid');
			$this->Swredis->deleteOnline($userId,'fd');
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
			$client_id = $this->Swredis->getOnline($id,'fd');
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
				$this->Swredis->sadd('userHistory',json_encode($data));
				//return $data
				return '12345';
			}
		}elseif( $type == 2 ){
			//touser is group
		}


	}

	/**
	 * getHistory
	 * @param $uid user_id
	 * @param $fid user_id
	 * @param $type user or ground
	 */
	public function getHistory($uid,$fid,$type = 1)
	{
		//Set query condition
		$where = 'from_id='.$uid.' and to_id='.$fid;
		$whereOr =  'from_id='.$fid.' and to_id='.$uid;
		$history = Db::name('history')->where($where)->whereOr($whereOr)->order('time desc')->limit(10)->select();
		asort($history);
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

	/**
	 * getUserData
	 * @param $user_id
	 * @param $field
	 * @return array or string
	 */
	public function getUserData($uid,$field = null)
	{
		$uid = intval($uid);
		if( $uid > 0 )
		{
			//get redis data
			$user = $this->Swredis->get(':user:' . $uid . ':data');
			if( $user == '' ){
			//get data
				$user = db('User')->where('id',$uid)->field($field)->find();
				if( $user == '' ){
					$user = error_msg('14015');
				}
				$reData = $user;
			}else{
				$fieldArr = explode(',', $field);
				$fieldCount = count($fieldArr);
				$reData = '';
				for( $i=1;$i<=$fieldCount;$i++ ){
					foreach ($friendArr as $key => $value) {
						$isExists = array_key_exists($key, $user);
						if( $isExists ){
							$reData[$key] = $value;
						}
					}
				}
				if( $reData == '' ){
					$reData = error_msg('14015');
				}
			}
			if( count($reData) == 1 ){
				$reData = $reData[$field];
			}
			return $reData;
		}else{
			return error_msg('14014');
		}
	}

}