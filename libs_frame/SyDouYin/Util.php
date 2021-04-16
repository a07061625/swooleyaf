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
     *
     * @param string $type 域名类型
     *
     * @return string 服务域名
     */
    public static function getServiceHost(string $type): string
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
     * 获取缓存键名
     * @param string $clientKey 应用标识
     * @param string $hostType 服务域名类型
     * @param string $openId 用户openid
     * @return string 缓存键名
     */
    private static function getCacheKey(string $clientKey, string $hostType, string $openId) : string
    {
        return Project::REDIS_PREFIX_DOUYIN_APP . md5($clientKey . '_' . $hostType . '_' . $openId);
    }

    /**
     * 获取访问令牌
     *
     * @param array $data 请求参数
     * <pre>
     *   client_key: 必填 string 应用标识
     *   host_type: 必填 string 服务域名类型
     *   open_id: 必填 string 用户openid
     *   auth_code: 选填 string 授权码
     * </pre>
     *
     * @return string 访问令牌
     *
     * @throws \SyException\Common\CheckException
     * @throws \SyException\DouYin\DouYinAccountException
     * @throws \SyException\DouYin\DouYinException
     */
    public static function getAccessToken(array $data) : string
    {
        $nowTime = Tool::getNowTime();
        $redisKey = self::getCacheKey($data['client_key'], $data['host_type'], $data['open_id']);
        if (!is_string($data['auth_code'])) {
            $redisData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
            if (isset($redisData['unique_key']) && ($redisData['unique_key'] == $redisKey)
                && isset($redisData['at_expire']) && ($redisData['at_expire'] >= $nowTime)) {
                return $redisData['at_content'];
            }

            $refreshToken = '';
            if (isset($redisData['rt_expire']) && ($redisData['rt_expire'] > $nowTime)) {
                $refreshToken = $redisData['rt_content'];
            }
            if (0 == \strlen($refreshToken)) {
                throw new DouYinException('获取访问令牌失败', ErrorCode::DOUYIN_PARAM_ERROR);
            }

            $atrObj = new AccessTokenRefresh($data['client_key']);
            $atrObj->setServiceHost($data['host_type']);
            $atrObj->setRefreshToken($refreshToken);
            $reqRes = self::sendServiceRequest($atrObj, ErrorCode::DOUYIN_REQ_ERROR);
        } else {
            $atObj = new AccessToken($data['client_key']);
            $atObj->setServiceHost($data['host_type']);
            $atObj->setCode($data['auth_code']);
            $reqRes = self::sendServiceRequest($atObj, ErrorCode::DOUYIN_REQ_ERROR);
        }

        $originCode = isset($reqRes['data']['data']['error_code']) ? (int)['data']['data']['error_code'] : -1;
        if (10010 == $originCode) {
            throw new DouYinException('刷新令牌已过期,请重新授权', ErrorCode::DOUYIN_REQ_ERROR);
        }
        if (!\in_array($originCode, [0, 10008, 2190008])) {
            throw new DouYinException($reqRes['msg'], ErrorCode::DOUYIN_REQ_ERROR);
        }

        CacheSimpleFactory::getRedisInstance()->hMSet($redisKey, [
            'unique_key' => $redisKey,
            'at_content' => $reqRes['data']['data']['access_token'],
            'at_expire' => (int)($nowTime + $reqRes['data']['data']['expires_in'] - 10),
            'rt_content' => $reqRes['data']['data']['refresh_token'],
            'rt_expire' => (int)($nowTime + $reqRes['data']['data']['refresh_expires_in'] - 10),
        ]);
        CacheSimpleFactory::getRedisInstance()->expire($redisKey, 86400);

        return $reqRes['data']['data']['access_token'];
    }

    /**
     * 获取客户端令牌
     *
     * @param array $data 请求参数
     * <pre>
     *   client_key: 必填 string 应用标识
     *   host_type: 必填 string 服务域名类型
     *   open_id: 必填 string 用户openid
     * </pre>
     *
     * @return string 客户端令牌
     *
     * @throws \SyException\Common\CheckException
     * @throws \SyException\DouYin\DouYinException
     */
    public static function getClientToken(array $data): string
    {
        $nowTime = Tool::getNowTime();
        $redisKey = self::getCacheKey($data['client_key'], $data['host_type'], $data['open_id']);
        $redisData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if (isset($redisData['unique_key']) && ($redisData['unique_key'] == $redisKey)
            && isset($redisData['ct_expire']) && ($redisData['ct_expire'] >= $nowTime)) {
            return $redisData['ct_content'];
        }

        $ctObj = new ClientToken($data['client_key']);
        $ctObj->setServiceHost($data['host_type']);
        $reqRes = self::sendServiceRequest($ctObj, ErrorCode::DOUYIN_ACCOUNT_REQ_ERROR);
        if ($reqRes['code'] > 0) {
            throw new DouYinException($reqRes['msg'], ErrorCode::DOUYIN_REQ_ERROR);
        }

        CacheSimpleFactory::getRedisInstance()->hMSet($redisKey, [
            'unique_key' => $redisKey,
            'ct_content' => $reqRes['data']['data']['access_token'],
            'ct_expire' => (int)($nowTime + $reqRes['data']['data']['expires_in'] - 10),
        ]);
        CacheSimpleFactory::getRedisInstance()->expire($redisKey, 86400);

        return $reqRes['data']['data']['access_token'];
    }
}
