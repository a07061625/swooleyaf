<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/5/23 0023
 * Time: 16:50
 */

namespace Request;

use SyConstant\ErrorCode;
use SyConstant\Project;
use SyException\Validator\SignException;
use SyTool\Tool;
use SyTrait\SimpleTrait;
use SyTrait\Validators\RequestSignTrait;

final class RequestSign
{
    use SimpleTrait;
    use RequestSignTrait;

    /**
     * 校验签名是否合法
     *
     * @throws \SyException\Validator\SignException
     * @throws \Exception
     */
    public static function checkSign(): string
    {
        $sign = Tool::getArrayVal($_POST, Project::DATA_KEY_SIGN_PARAMS);
        if (!\is_string($sign)) {
            throw new SignException('签名值出错', ErrorCode::SIGN_ERROR);
        }
        if (\strlen($sign) <= 16) {
            throw new SignException('签名值出错', ErrorCode::SIGN_ERROR);
        }

        $createSign = self::createSign([
            'sign_time' => substr($sign, 6, 10),
            'sign_nonce' => substr($sign, 0, 6),
        ]);
        if ($sign != $createSign) {
            throw new SignException('接口签名错误', ErrorCode::SIGN_ERROR);
        }

        return $sign;
    }

    /**
     * 生成带签名的URL
     *
     * @param $url
     *
     * @throws \Exception
     */
    public static function makeSignUrl(&$url)
    {
        $urlArr = explode('#', $url);
        $arr = explode('?', $urlArr[0]);
        $params = [];
        if (isset($arr[1])) {
            parse_str($arr[1], $params);
        }
        $params[Project::DATA_KEY_SIGN_PARAMS] = self::createSign();

        $url = $arr[0] . '?' . http_build_query($params);
    }

    /**
     * 生成签名
     *
     * @throws \Exception
     */
    public static function createSign(array $data = []): string
    {
        if (empty($data)) {
            $signTime = Tool::getNowTime();
            $signNonce = Tool::createNonceStr(6);
        } else {
            $signTime = $data['sign_time'];
            $signNonce = $data['sign_nonce'];
        }

        $signFactor = self::getSignFactor();

        return $signNonce . $signTime . hash($signFactor['method'], $signNonce . $signFactor['secret'] . $signTime);
    }
}
