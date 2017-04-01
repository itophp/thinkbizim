<?php
namespace swoole;

use cache\Redis;

class Swoole_redis
{
	protected $redis;
	const PREFIX = 'bizim';

	public function __construct()
	{
		$this->redis = Redis::getInstance();
	}

	/**
	 * getSessData
	 * @param $sessID
	 * @return array
	 */
	public function getSessData($sessID)
	{
		$sessData = $this->redis->get('PHPREDIS_SESSION:' . $sessID);
		return $sessData;
	}

	/**
	 * set
	 * @param $key
	 * @return $result
	 */
	public function set($key,$value)
	{
		$this->redis->get(self::PREFIX . $key,$value);
	}

	/**
	 * get 
	 * @param $key
	 * @return $result
	 */
	public function get($key)
	{
		$result = $this->redis->get(self::PREFIX . $key);
		return $result;
	}


	/**
	 * delete 
	 * @param $key
	 */
	public function delete($key)
	{
		$this->redis->delete(self::PREFIX . $key);
	}

	/**
	 * sadd
	 * @param $key
	 * @param $value 
	 */
	public function sadd($key,$value)
	{
		$this->redis->sadd($key,$value);
	}




	//====================================================================================================
	//=================================  online redis start  =========================================
	//====================================================================================================

	/**
	 * setOnline
	 * @param $key
	 * @param $type
	 * @return $result
	 */
	public function setOnline($key,$value,$type)
	{
		$this->redis->set(self::PREFIX . ':online:' . $key . ':' . $type,$value);
	}

	/**
	 * getOnline 
	 * @param $key
	 * @return $result
	 */
	public function getOnline($key,$type)
	{
		$result = $this->redis->get(self::PREFIX . ':online:' . $key . ':' . $type);
		return $result;
	}

	/**
	 * delete 
	 * @param $key
	 */
	public function deleteOnline($key,$type)
	{
		$this->redis->delete(self::PREFIX . ':online:' .$key. ':' . $type);
	}

	//====================================================================================================
	//===================================  online redis end ==========================================
	//====================================================================================================


	

}