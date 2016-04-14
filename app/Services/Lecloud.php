<?php

/**
 * Created by PhpStorm.
 * User: Volio
 * Date: 2016/3/18
 * Time: 21:07
 */

namespace App\Services;

class Lecloud
{
    protected static $secretkey = '';
    protected static $userId='';
    protected static $url = 'http://api.open.letvcloud.com/live/execute';

    protected static function request($url,$data=null){
        $ch = curl_init();
        $header[] = 'Content-Type: application/x-www-form-urlencoded;charset=utf-8';
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $header));
        if ($data) {
            curl_setopt_array($ch, array(
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $data));
        }
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    //创建活动
    public static function  creatActivity($config){
        $parameter = array(
            'method' => 'letv.cloudlive.activity.create',
            'ver' => '3.0',
            'userid' => self::$userId,
            'timestamp' => self::getTimeStamp(),
            'startTime' => date('YmdHis',time()),
            'endTime' => date('YmdHis',time()+43200),
            'liveNum' => 1,
            'codeRateTypes' => $config['codeRateTypes'],
            'needFullView' => 0,
            'activityCategory' => '005',
            'playMode' => 0
        );

        $parameter['activityName'] = $config['livename'] ? $config['livename'] : false;
        $parameter['needRecord'] = $config['record'];
        $parameter['sign'] = self::getSign($parameter);

        $data = http_build_query($parameter);
        $result = self::request(self::$url,$data);
        return $result;
    }
    //停止活动
    public static function stopActivity($activityId){
        $parameter = array(
            'method' => 'letv.cloudlive.activity.stop',
            'ver' => '3.0',
            'userid' => self::$userId,
            'timestamp' => self::getTimeStamp(),
            'activityId' => $activityId
        );

        $parameter['sign'] = self::getSign($parameter);

        $data = http_build_query($parameter);
        self::request(self::$url,$data);
        return true;
    }
    //查询活动
    public static function queryActivity($activityId){
        $parameter = array(
            'method' => 'letv.cloudlive.activity.search',
            'ver' => '3.0',
            'userid' => self::$userId,
            'timestamp' => self::getTimeStamp(),
            'activityId' => $activityId
        );
        if($activityId){
            $parameter['sign'] = self::getSign($parameter);
            $data = http_build_query($parameter);
            return self::request(self::$url.$data);
        }else
            return false;
    }
    //获取推流地址
    public static function getPushUrl($activityId){
        $parameter = array(
            'method' => 'letv.cloudlive.activity.getPushUrl',
            'ver' => '3.0',
            'userid' => self::$userId,
            'timestamp' => self::getTimeStamp(),
            'activityId' => $activityId
        );

        $parameter['sign'] = self::getSign($parameter);
        $data = http_build_query($parameter);
        return self::request(self::$url.'?'.$data);
    }
    //获取时间戳
    private static function getTimeStamp(){
        $time = getdate();
        return $time['0'].'000';
    }
    //传入数组获取sign值
    private static function getSign($array){
        ksort($array);
        $signstr = '';
        foreach ($array as $key => $value) {
            $signstr .= $key;
            $signstr .= $value;
        }
        $signstr .= self::$secretkey;
        return md5($signstr);
    }
}