<?php


namespace App\Http\Controllers\Utils;


use Predis\Client;

class RedisManager
{

    private static $managerInstance = false;
    private static $redisClient;

    private function __construct()
    {
    }

    private static function makeRedisHandshake(){
        self::$redisClient = new Client([
            'scheme' => 'tcp',
            'host' => '127.0.0.1',
            'port' => 6379
        ]);
    }

    public static function getInstance(){
        if( self::$managerInstance == false ){
            self::$managerInstance = new RedisManager();
            self::makeRedisHandshake();
        }
        return self::$managerInstance;
    }

    public static function putValue( $key , $val , $minutes ){
        self::$redisClient->set( $key , $val );
        self::$redisClient->expire( $key , (60 * $minutes) );
    }


    public static function retrieveOnlineUserIds(){

        $onlineUserIds = [];

        foreach ( self::$redisClient->keys('usr-on-*') as $usr ) {
            // substring from cache key with following pattern: usr-on-{id}
            array_push( $onlineUserIds , substr( $usr , 7 , strlen( $usr )) );
        }

        return $onlineUserIds;
    }

}