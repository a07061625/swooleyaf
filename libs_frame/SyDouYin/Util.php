<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/14 0014
 * Time: 20:34
 */

namespace SyDouYin;

use DesignPatterns\Factories\CacheSimpleFactory;
use SyConstant\ErrorCode;
use SyConstant\Project;
use SyDouYin\Account\AccessToken;
use SyDouYin\Account\AccessTokenRefresh;
use SyDouYin\Account\ClientToken;
use SyException\DouYin\DouYinException;
use SyTool\Tool;

/**
 * Class Util
 *
 * @package SyDouYin
 */
abstract class Util
{
    /**
     * 服务域名类型-抖音
     */
    const SERVICE_HOST_TYPE_DOUYIN = 'douyin';
    /**
     * 服务域名类型-头条
     */
    const SERVICE_HOST_TYPE_TOUTIAO = 'toutiao';
    /**
     * 服务域名类型-西瓜
     */
    const SERVICE_HOST_TYPE_XIGUA = 'xigua';

    private static $totalServiceHost = [
        self::SERVICE_HOST_TYPE_DOUYIN => 'https://open.douyin.com',
        self::SERVICE_HOST_TYPE_TOUTIAO => 'https://open.snssdk.com',
        self::SERVICE_HOST_TYPE_XIGUA => 'https://open-api.ixigua.com',
    ];

    /**
     * 获取服务域名
     * @param string $type 域名类型
     * @return string 服务域名
     */
    public static function getServiceHost(string $type) : string
    {
        return Tool::getArrayVal(self::$totalServiceHost, $type, '');
    }

    /**
     * 发送服务请求
     *
     * @param \SyDouYin\Base $service   服务请求对象
     * @param int            $errorCode 异常错误码
     *
     * @return array 请求结果
     *
     * @throws \SyException\Common\CheckException
     */
    public static function sendServiceRequest(Base $service, int $errorCode): array
    {
        $resArr = [
            'code' => 0,
            'data' => [],
        ];

        $curlConfigs = $service->getDetail();
        $sendRes = Tool::sendCurlReq($curlConfigs);
        if ($sendRes['res_no'] > 0) {
            $resArr['code'] = $errorCode;
            $resArr['msg'] = $sendRes['res_msg'];

            return $resArr;
        }

        $rspData = Tool::jsonDecode($sendRes['res_content']);
        if (isset($rspData['data']['error_code'])) {
            $resArr['data'] = $rspData;
            if ($rspData['data']['error_code'] > 0) {
                $resArr['code'] = $errorCode;
                $resArr['msg'] = $rspData['data']['description'];
            }
        } else {
            $resArr['code'] = $errorCode;
            $resArr['msg'] = '解析服务数据出错';
        }

        return $resArr;
    }

    /**
     * 获取访问令牌
     * @param string $clientKey 应用标识
     * @param string $hostType 服务域名类型
     * @param string $authCode 授权码
     * @return array 获取结果
     * @throws \SyException\Common\CheckException
     * @throws \SyException\DouYin\DouYinAccountException
     * @throws \SyException\DouYin\DouYinException
     */
    public static function getAccessToken(string $clientKey, string $hostType, string $authCode = '') : array
    {
        $nowTime = Tool::getNowTime();
        $atContent = $hostType . 'at_content';
        $atExpire = $hostType . 'at_expire';
        $rtContent = $hostType . 'rt_content';
        $rtExpire = $hostType . 'rt_expire';
        $redisKey = Project::REDIS_PREFIX_DOUYIN_APP . $clientKey;
        if (strlen($authCode) == 0) {
            $redisData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
            if (isset($redisData['unique_key']) && ($redisData['unique_key'] == $redisKey)
                && isset($redisData[$atExpire]) && ($redisData[$atExpire] >= $nowTime)) {
                return [
                    'access_token' => $redisData[$atContent],
                ];
            }

            $refreshToken = '';
            if (isset($redisData[$rtExpire]) && ($redisData[$rtExpire] > $nowTime)) {
                $refreshToken = $redisData[$rtContent];
            }
            if (strlen($refreshToken) == 0) {
                throw new DouYinException('获取访问令牌失败', ErrorCode::DOUYIN_PARAM_ERROR);
            }

            $atrObj = new AccessTokenRefresh($clientKey);
            $atrObj->setServiceHost($hostType);
            $atrObj->setRefreshToken($refreshToken);
            $reqRes = self::sendServiceRequest($atrObj, ErrorCode::DOUYIN_REQ_ERROR);
        } else {
            $atObj = new AccessToken($clientKey);
            $atObj->setServiceHost($hostType);
            $atObj->setCode($authCode);
            $reqRes = self::sendServiceRequest($atObj, ErrorCode::DOUYIN_REQ_ERROR);
        }

        $originCode = isset($reqRes['data']['data']['error_code']) ? (int)['data']['data']['error_code'] : -1;
        if ($originCode == 10010) {
            throw new DouYinException('刷新令牌已过期,请重新授权', ErrorCode::DOUYIN_REQ_ERROR);
        } elseif (!in_array($originCode, [0, 10008, 2190008])) {
            throw new DouYinException($reqRes['msg'], ErrorCode::DOUYIN_REQ_ERROR);
        }

        CacheSimpleFactory::getRedisInstance()->hMSet($redisKey, [
            'unique_key' => $redisKey,
            $atContent => $reqRes['data']['data']['access_token'],
            $atExpire => (int)($nowTime + $reqRes['data']['data']['expires_in'] - 10),
            $rtContent => $reqRes['data']['data']['refresh_token'],
            $rtExpire => (int)($nowTime + $reqRes['data']['data']['refresh_expires_in'] - 10),
        ]);
        CacheSimpleFactory::getRedisInstance()->expire($redisKey, 86400);

        return [
            'access_token' => $reqRes['data']['data']['access_token'],
            'open_id' => $reqRes['data']['data']['open_id'],
            'scope' => $reqRes['data']['data']['scope'],
        ];
    }

    /**
     * 获取客户端令牌
     * @param string $clientKey 应用标识
     * @param string $hostType 服务域名类型
     * @return string 客户端令牌
     * @throws \SyException\Common\CheckException
     * @throws \SyException\DouYin\DouYinException
     */
    public static function getClientToken(string $clientKey, string $hostType) : string
    {
        $nowTime = Tool::getNowTime();
        $ctContent = $hostType . 'ct_content';
        $ctExpire = $hostType . 'ct_expire';
        $redisKey = Project::REDIS_PREFIX_DOUYIN_APP . $clientKey;
        $redisData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if (isset($redisData['unique_key']) && ($redisData['unique_key'] == $redisKey)
            && isset($redisData[$ctExpire]) && ($redisData[$ctExpire] >= $nowTime)) {
            return $redisData[$ctContent];
        }

        $ctObj = new ClientToken($clientKey);
        $ctObj->setServiceHost($hostType);
        $reqRes = self::sendServiceRequest($ctObj, ErrorCode::DOUYIN_ACCOUNT_REQ_ERROR);
        if ($reqRes['code'] > 0) {
            throw new DouYinException($reqRes['msg'], ErrorCode::DOUYIN_REQ_ERROR);
        }

        CacheSimpleFactory::getRedisInstance()->hMSet($redisKey, [
            'unique_key' => $redisKey,
            $ctContent => $reqRes['data']['data']['access_token'],
            $ctExpire => (int)($nowTime + $reqRes['data']['data']['expires_in'] - 10),
        ]);
        CacheSimpleFactory::getRedisInstance()->expire($redisKey, 86400);

        return $reqRes['data']['data']['access_token'];
    }
}
