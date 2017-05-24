<?php

/**
 * 单列模式 封装 核心Redis类
 */

class RedisCore{
	static    $link;
	protected $host;

	//连接 Redis 服务器
	private function __construct($host = null ,$port = null){
		if(!self::$link){
			$host  = is_null($host) ? '127.0.0.1' : $host ;
			$port  = is_null($port) ? 6379 : $port ;
			$redis = new Redis();
			$redis->connect($host,$port); 

			self::$link = $redis;
		}
	}

	//外部调用 redis
	static function Redis(){
		return self::$link;
	}
}