<?php
namespace cache;

class Redis
{
	//redis host default:127.0.0.1
	protected $host = '127.0.0.1';
	//redis port default:3306
	protected $port = '6379';
	//redis server
	public static $_redisevr;
	//now redis
	private static $_redis;

	/**
	 * Singleton pattern
	 * @return instantiate redis
	 */
	private function __construct()
	{
		self::$_redisevr = new \Redis();
		self::$_redisevr->connect($this->host,$this->port);
	}

	public function __clone(){
		trigger_error('Clone is not allow!',E_USER_ERROR);
	}

	/**
	 * 
	 */
	public static function getInstance()
	{
		//check self::$_redis is not 
		if( !(self::$_redis instanceof self) )
		{
			self::$_redis = new Redis;
		}
		return self::$_redis;
	}

	//============================ delete start ====================================


	/**
	 *
	 */
	public function delete($key)
	{
		self::$_redisevr->delete($key);
	}


	//======================== delete end ====================================


	//======================== string type start =========================================

	/**
	 *
	 */
	public function get($key)
	{
		$value = self::$_redisevr->get($key);
		return $value;
	}

	/**
	 *
	 *
	 */
	public function set($key,$value)
	{
		self::$_redisevr->set($key,$value);
	}

	//========================= string type end =====================================


	//========================= list type start =====================================

	/**
	 * 
	 */

	//========================= list type end  ======================================

	/**
	 *
	 */
	public function sadd($key,$value)
	{
		self::$_redisevr->sadd($key,$value);
	}


	/**
	 * hset
	 *
	 */
	public function hset($key,$field,$value)
	{
		self::$_redisevr->hset($key,$field,$value);
	}

}