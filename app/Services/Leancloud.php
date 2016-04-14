<?php
/**
 * Created by PhpStorm.
 * User: Volio
 * Date: 2016/3/19
 * Time: 17:25
 */
namespace App\Services;

class Leancloud
{
    public static $appId = '';
    protected static $appKey = '';
    protected static $url = 'https://api.leancloud.cn/1.1/classes/_Conversation';

    protected static function request($url,$data=null){
        $ch = curl_init();
        $header[] = 'X-LC-Id: '.self::$appId;
        $header[] = 'X-LC-Key: '.self::$appKey;
        $header[] = 'Content-Type: application/json';
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_SSL_VERIFYPEER => false,
        ));
        if ($data) {
            curl_setopt_array($ch, array(
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $data));
        }
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    public static function createRoom($name){
        $info = [
            'name' => $name,
            'tr' => true
        ];
        $data = json_encode($info,JSON_UNESCAPED_UNICODE);
        $result = self::request(self::$url,$data);
        return $result;
    }
}