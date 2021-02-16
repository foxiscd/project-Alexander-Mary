<?php

namespace app\api;

/**
 * Class Vkontakte
 * @package app\api
 */
class Vkontakte
{
    public static $apiId = '7653745';
    public static $secretKey = 'QBI0uZbXKUnYgWHL3Tw4';
    public static $url = 'https://alexandrova.mary/user/login-vk';
    public static $token;
    public static $params = [];
    public static $userId;

    const URL_OATH_CODE = "https://oauth.vk.com/authorize?";
    const URL_OAUTH_TOKEN = "https://oauth.vk.com/access_token?";
    const URL_GET_USER = "https://api.vk.com/method/users.get?";

    /**
     * @return string
     */
    public static function authorizeUrl()
    {
        $auth = self::URL_OATH_CODE . "client_id=" . self::$apiId . "&client_secret=" . self::$secretKey;
        $auth .= "display=page&redirect_uri=" . self::$url . "&response_type=code&v=5.52";
        $auth .= "&scope=email";
        return $auth;
    }


    /**
     * @param $code
     * @return bool|array
     */
    public static function dataAccess(string $code)
    {
        self::$params = http_build_query([
            'client_id' => self::$apiId,
            'client_secret' => self::$secretKey,
            'redirect_uri' => self::$url,
            'code' => $code,
        ]);

        $data = self::getUserDataRegister() + self::getUserDataInfo();

        return $data['email']?$data:false ;
    }

    /**
     * @return array|false
     */
    public static function getUserDataRegister()
    {
        $url = self::URL_OAUTH_TOKEN . self::$params;
        $response = file_get_contents($url, true);
        $data = json_decode($response, true);

        self::$token = $data['access_token'];
        self::$userId = $data['user_id'];

        return $data?:false ;
    }

    /**
     * @return array|false
     */
    public static function getUserDataInfo()
    {
        $urlInfo = self::URL_GET_USER ."user_id=" . self::$userId . "&v=5.52&fields=first_name,nickname";
        $urlInfo .= "&" . self::$params;
        $urlInfo .= "&access_token=" . self::$token;

        $data = json_decode(file_get_contents($urlInfo), true);

        return $data['response'][0]?:false;
    }

}