<?php
use Predis\Client;

class RedisController extends BaseController
{
    public static $redis;
    public static $scheme = 'tcp';
    public static $host = '127.0.0.1';
    public static $port = '6379';
    public static $database = '1'; //selected database
    public static $ttl = 3600; // 1 hour

    function __construct(){
        try{
            $params = [
                'scheme' => self::$scheme,
                'host'   => self::$host,
                'port'   => self::$port,
                'database'   => self::$database,
            ];
            self::$redis = new Client($params);
        }catch (Exception $e) {
            echo "Couldn't connected to Redis";
            echo $e->getMessage();
        }
    }

    public static function set($key, $value, $ttl = null){
        if(empty($key) || empty($value)){
            return false;
        }else{
            if(empty($ttl)){
                $ttl = self::$ttl;
            }
        }
        $value = serialize($value);
        self::$redis->set($key, $value);
        if($ttl > 0){
            self::$redis->expire($key, $ttl);
        }
        return true;
    }

    public static function get($key){
        if(self::$redis->exists($key)){
            $result = self::$redis->get($key);
            return unserialize($result);
        }else{
            return false;
        }
    }

    public static function forget($key){
        if(self::$redis->exists($key)){
            self::$redis->expire($key,0);
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public static function has($key){
        if(self::$redis->exists($key)){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public static function setTtl($key,$ttl){
        try{
            self::$redis->expire($key, $ttl);
            return TRUE;
        }catch (Exception $e){
            return FALSE;
        }
    }

    public static function checkTtl($key){
        try{
            echo ' expired at : '.date('Y-m-d H:i:s',strtotime( date('Y-m-d H:i:s')) + (int)self::$redis->ttl($key));
        }catch (Exception $e){
            return FALSE;
        }
    }

}
