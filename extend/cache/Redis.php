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

	/**
	 *
	 */
	public function sadd($key,$value)
	{
		self::$_redisevr->sadd($key,$value);
	}

	/**
	 *
	 */
	public function delete($key)
	{
		self::$_redisevr->delete($key);
	}


}