<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/17 0017
 * Time: 13:57
 */
namespace SyVms;

use DesignPatterns\Factories\CacheSimpleFactory;
use DesignPatterns\Singletons\VmsConfigSingleton;
use SyConstant\ErrorCode;
use SyConstant\Project;
use SyException\Vms\XunFeiException;
use SyTool\Tool;
use SyTrait\SimpleTrait;
use SyVms\XunFei\Expand\AiCallToken;

/**
 * Class UtilXunFei
 *
 * @package SyVms
 */
abstract class UtilXunFei
{
    use SimpleTrait;

    /**
     * 生成授权签名
     *
     * @param array $data 授权参数<pre>
     *                    req_host: string required,请求域名
     *                    req_uri: string required,请求URI
     *                    req_method: string required,请求方式</pre>
     *
     * @return array
     *
     * @throws \SyException\Vms\XunFeiException
     */
    public static function createAuthorizationSign(array $data) : array
    {
        $date = gmdate('D, d M Y H:i:s') . ' GMT';
        $signatureOrigin = 'host: ' . $data['req_host'] . PHP_EOL
                           . 'date: ' . $date . PHP_EOL
                           . $data['req_method'] . ' ' . $data['req_uri'] . ' HTTP/1.1';

        $config = VmsConfigSingleton::getInstance()->getXunFeiConfig();
        $signature = base64_encode(hash_hmac('sha256', $signatureOrigin, $config->getApiSecret()));
        $authorizationOrigin = 'api_key="' . $config->getApiKey()
                               . '",algorithm="hmac-sha256",headers="host date request-line",signature="' . $signature
                               . '"';

        return [
            'date' => $date,
            'authorization' => base64_encode($authorizationOrigin),
        ];
    }

    /**
     * 生成授权令牌
     *
     * @param array $params
     *
     * @return array
     *
     * @throws \SyException\Vms\XunFeiException
     */
    public static function createAuthorizationToken(array $params) : array
    {
        $config = VmsConfigSingleton::getInstance()->getXunFeiConfig();
        $nowTime = Tool::getNowTime();
        $paramSign = base64_encode(Tool::jsonEncode($params, JSON_UNESCAPED_UNICODE));

        return [
            'X-Appid' => $config->getAppId(),
            'X-CurTime' => (string)$nowTime,
            'X-Param' => $paramSign,
            'X-CheckSum' => md5($config->getApiKey() . $nowTime . $paramSign),
        ];
    }

    /**
     * 生成接口签名
     *
     * @return array
     *
     * @throws \SyException\Vms\XunFeiException
     */
    public static function createApiSign() : array
    {
        $config = VmsConfigSingleton::getInstance()->getXunFeiConfig();
        $nowTime = Tool::getNowTime();
        $signStr = md5($config->getAppId() . $nowTime);

        return [
            'time' => $nowTime,
            'sign' => hash_hmac('sha1', $signStr, $config->getApiSecret()),
        ];
    }

    /**
     * 发送请求
     *
     * @param array $curlConfigs
     *
     * @return string
     *
     * @throws \SyException\Common\CheckException
     * @throws \SyException\Vms\XunFeiException
     */
    public static function sendRequest(array $curlConfigs) : string
    {
        $sendRes = Tool::sendCurlReq($curlConfigs);
        if ($sendRes['res_no'] == 0) {
            return $sendRes['res_content'];
        }

        throw new XunFeiException('curl出错,错误码=' . $sendRes['res_no'], ErrorCode::VMS_REQ_XUNFEI_ERROR);
    }

    /**
     * 获取AI客服令牌
     *
     * @return string
     *
     * @throws \SyException\Vms\XunFeiException
     */
    public static function getAiCallToken() : string
    {
        $nowTime = Tool::getNowTime();
        $redisKey = Project::REDIS_PREFIX_VMS_XUNFEI . VmsConfigSingleton::getInstance()->getXunFeiConfig()->getAppId();
        $redisData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if (isset($redisData['act_key']) && ($redisData['act_key'] == $redisKey) && ($redisData['act_expire'] >= $nowTime)) {
            return $redisData['act_content'];
        }

        $tokenObj = new AiCallToken();
        $tokenDetail = $tokenObj->getDetail();
        $expireTime = (int)($nowTime + $tokenDetail['result']['time_expire'] - 10);
        CacheSimpleFactory::getRedisInstance()->hMset($redisKey, [
            'act_content' => $tokenDetail['result']['token'],
            'act_expire' => $expireTime,
            'act_key' => $redisKey,
        ]);

        return $tokenDetail['result']['token'];
    }
}
