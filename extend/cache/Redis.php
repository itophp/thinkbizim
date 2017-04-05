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

    /**
     * 用于禁止克隆对象
     */

	public function __clone(){
		trigger_error('Clone is not allow!',E_USER_ERROR);
	}

	/**
	 * 单例模式初始化静态对象
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

	//============================ 删除类型 开始 ====================================


	/**
     * DELETE
     * @param $key string 键名 
	 * 删除键值
	 */
	public function delete($key)
	{
		self::$_redisevr->delete($key);
	}


	//======================== 删除类型 结束 ====================================


	//======================== 字符串类型 start =========================================

	/**
	 * GET 
     * @param $key string 键名
     * 获取使用set方法保存的键值 
	 */
	public function get($key)
	{
		$value = self::$_redisevr->get($key);
		return $value;
	}

	/**
	 * SET
	 * @param $key string 键名
     * @param $value 键值 
     * 通过set方法保存对象，字符串，数组等
	 */
	public function set($key,$value)
	{
		self::$_redisevr->set($key,$value);
	}

	//========================= 字符串类型 end =====================================



	//========================= 列表类型 start =====================================

	/**
	 * LPUSH
     * @param $key string 键名
     * @param $value string or array 键值
     * 向列表左边添加元素，返回值标识增加元素后的列表长度
	 */
    public function lpush($key,$value)
    {
        self::$_redisevr->lpush($key,$value);
    }

    /**
     * RPUSH
     * @param $key string 键名
     * @param $value string or array 键值
     * 向列表右边添加元素
     */
    public function rpush($key,$value)
    {
        self::$_redisevr->rpush($key,$value);
    }

    /**
     * LPOP
     * @param $key
     * 从列表左边弹出元素
     */
    public function lpop($key)
    {
        self::$_redisevr->lpop($key);
    }

    /**
     * RPOP
     * @param $key
     * 从列表右边弹出元素
     */
    public function rpop($key)
    {
        self::$_redisevr->rpop($key);
    }

    /**
     * LLEN
     * @param $key 
     * 获取列表中元素的个数
     */
    public function llen($key)
    {
        self::$_redis->llen($key);
    }

    /**
     * LRANGE 
     * @param $key
     * @param $start 开始获取的位置
     * @param $end 结束获取的位置
     * 获取列表中某一片段。将返回索引从 $start 到 $end 之间的所有元素，包含两端的元素,负数表示右边开始第几个元素
     */
    public function lrange($key,$start,$end)
    {
        self::$_redisevr->lrange($key,$start,$end);
    }

    /**
     * LREM
     * @param $key
     * @param $count 删除几个
     * @param $value 删除哪个值
     * LREM会删除列表中前 $count 个值为 $value 的元素
     */
    public function lrem($key,$count,$value)
    {
        self::$_redisevr->lrem($key,$count,$value);
    }

    /**
     * LINDEX
     * @param $key 
     * @param $index 索引名称
     * 获得指定索引的元素值
     * 如果要讲列表类型当成数组来用，LINDEX命令是必不可少的，LINDEX命令用于返回指定索引的元素
     */
    public function lindex($key,$index)
    {
        self::$_redisevr->lindex($key,$index);
    }

    /**
     * LSET
     * @param $key
     * @param $index 索引名称
     * @param $value 值
     * 设置指定索引的元素值
     */
    public function lset($key,$index,$value)
    {
        self::$_redisevr->lset($key,$index,$value);
    }


    /**
     * LTRIM 
     * @param $key
     * @param $start 开始保留的位置
     * @param $end 结束保留的位置
     * 删除指定索引之外的元素，方法和LRANGE相同
     */
    public function ltrim($key,$start,$end)
    {
        self::$_redisevr->ltrim($key,$start,$end);
    }


    /**
     * LINSERT
     * @param $key
     * @param $position BEDORE|AFTER 在元素之前还是之后
     * @param $pivot 查找的元素
     * @param $value 插入的值
     * LINSERT会首先查找 $pivot 元素的位置，在根据 $position 确定在 $pivot 之前还是之后插入 $value
     */
    public function linsert($key,$position,$pivot,$value)
    {
        self::$_redisevr->linsert($key,$position,$pivot,$value);
    }


    /**
     * RPOPLPUSH
     * 将列表从一个列表转到另一个列表
     * @param $sourse
     * @param $destination
     * 过程：
     *   先用 rpop 弹出数据 $source 中的数据，在用 lpush 将弹出的数据插入到 $destination 中
     *
     *   def rpoplpush ( $source,$destination )
     *   $value = RPOP $source
     *   LPUSH $destination, $value
     *   return $value
     */
    public function rpoplpush($source,$destination)
    {
        self::$_redisevr->rpoplpush($source,$destination);
    }
    

	//========================= 列表类型 end  ======================================
   


    //========================= 集合类型 start =====================================

	/**
	 *
	 */
	public function sadd($key,$value)
	{
		self::$_redisevr->sadd($key,$value);
	}

    //========================= 集合类型 end ======================================


	/**
	 * hset
	 *
	 */
	public function hset($key,$field,$value)
	{
		self::$_redisevr->hset($key,$field,$value);
	}

}