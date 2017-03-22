<?php
namespace cache;

class Redis
{
	//redis host default:127.0.0.1
	protected $host = '127.0.0.1';
	//redis port default:3306
	protected $port = '3306';
	//redis class
	protected $_redis;

	/**
	 * Singleton pattern
	 * @return instantiate redis
	 */
	public function __construct()
	{
		$this->_redis = new \Redis();
		$this->_redis->connect($this->host,$this->port);
	}


	/**
	 * 
	 *
	 */
	public function sadd($key,$value = '')
	{
		if(is_array($key)){

		}else{
			//cheak $value
			if(empty($value)){
				return 'Pleace entry value!!';
			}
		}
	}


	/**
	 *
	 *
	 */
	public function smembers($key,$type,$limit1 = '',$limit2 = '')
	{
		if( !empty($limit1) ){
			$data = $this->$_redis->smembers($key,$limit1);
		}elseif( !empty($limit) && !empty($limit2) ){
			$data = $this->$_redis->smembers($key,$limit1,$limit2);
		}else{
			$data = $this->$_redis->smembers($key);
		}
		$dataArr = array();
		if( $type == 'online' ){
			foreach ($data as $value) {
				$dArr = explode(':', $value);
				$dataArr[$dArr[0]] = $dArr[1];
			}
		}else{
			$dataArr = $data;
		}
		return $dataArr;
	}
}