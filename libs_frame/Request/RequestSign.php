<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/5/23 0023
 * Time: 16:50
 */
namespace Request;

use Constant\ErrorCode;
use Exception\Validator\SignException;
use Tool\Tool;
use Traits\SimpleTrait;

final class RequestSign {
    use SimpleTrait;

    const KEY_SIGN = '_sign';

    /**
     * 校验签名是否合法
     * @return string
     * @throws \Exception\Validator\SignException
     */
    public static function checkSign() : string {
        $sign = Tool::getArrayVal($_POST, self::KEY_SIGN);
        if(!is_string($sign)){
            throw new SignException('签名值出错', ErrorCode::SIGN_ERROR);
        } else if (strlen($sign) <= 16) {
            throw new SignException('签名值出错', ErrorCode::SIGN_ERROR);
        }

        $createSign = self::createSign([
            'sign_time' => substr($sign, 6, 10),
            'sign_nonce' => substr($sign, 0, 6),
        ]);
        if($sign !== $createSign){
            throw new SignException('签名错误', ErrorCode::SIGN_ERROR);
        }

        return $sign;
    }

    /**
     * 生成带签名的URL
     * @param $url
     */
    public static function makeSignUrl(&$url){
        $urlArr = explode('#', $url);
        $arr = explode('?', $urlArr[0]);
        $params = [];
        if(isset($arr[1])){
            parse_str($arr[1], $params);
        }
        $params[self::KEY_SIGN] = self::createSign();

        $url = $arr[0] . '?' . http_build_query($params);
    }

    /**
     * 生成签名
     * @param array $data
     * @return string
     */
    public static function createSign(array $data=[]) {
        if(empty($data)){
            $signTime = Tool::getNowTime();
            $signNonce = Tool::createNonceStr(6);
        } else {
            $signTime = $data['sign_time'];
            $signNonce = $data['sign_nonce'];
        }

        $configs = Tool::getConfig('project.' . SY_ENV . SY_PROJECT . '.request.sign');
        return $signNonce . $signTime . hash($configs['method'], $signNonce . $configs['secret'] . $signTime);
    }
}