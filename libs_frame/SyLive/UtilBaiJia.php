<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/3/27 0027
 * Time: 19:05
 */
namespace SyLive;

use DesignPatterns\Factories\CacheSimpleFactory;
use SyLive\BaiJia\Partner\KeyCreate;
use SyConstant\ErrorCode;
use SyConstant\Project;
use SyException\Live\BaiJiaException;
use SyLog\Log;
use SyTool\Tool;
use SyTrait\SimpleTrait;

/**
 * Class UtilBaiJia
 * @package SyLive
 */
class UtilBaiJia extends Util
{
    use SimpleTrait;

    /**
     * 获取账号令牌
     * @param string $partnerId
     * @return string
     * @throws \SyException\Common\CheckException
     * @throws \SyException\Live\BaiJiaException
     */
    public static function getPartnerKey(string $partnerId) : string
    {
        $nowTime = Tool::getNowTime();
        $redisKey = Project::REDIS_PREFIX_LIVE_EDUCATION_BJY . $partnerId;
        $redisData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if (isset($redisData['pk_key']) && ($redisData['pk_key'] == $redisKey) && ($redisData['pk_expire'] >= $nowTime)) {
            return $redisData['pk_content'];
        }

        $keyCreate = new KeyCreate($partnerId);
        $sendRes = self::sendServiceRequest($keyCreate);
        if ($sendRes['code'] > 0) {
            throw new BaiJiaException($sendRes['msg'], $sendRes['code']);
        }

        CacheSimpleFactory::getRedisInstance()->hMset($redisKey, [
            'pk_key' => $redisKey,
            'pk_content' => $sendRes['data']['partner_key'],
            'pk_expire' => $nowTime + 14400,
        ]);
        CacheSimpleFactory::getRedisInstance()->expire($redisKey, 86400);

        return $sendRes['data']['partner_key'];
    }

    /**
     * 生成签名
     * @param string $partnerId
     * @param array $data
     * @throws \SyException\Common\CheckException
     * @throws \SyException\Live\BaiJiaException
     */
    public static function createSign(string $partnerId, array &$data)
    {
        unset($data['sign']);
        ksort($data);
        $needStr1 = '';
        foreach ($data as $key => $value) {
            $needStr1 .= '&' . $key . '=' . $value;
        }
        $needStr2 = substr($needStr1, 1) . '&partner_key=' . self::getPartnerKey($partnerId);
        $data['sign'] = md5($needStr2);
    }

    /**
     * 发送请求
     * @param array $curlConfig
     * @return bool|string
     * @throws \SyException\Common\CheckException
     */
    private static function sendCurl(array $curlConfig)
    {
        $curlConfig[CURLOPT_POST] = true;
        $curlConfig[CURLOPT_SSL_VERIFYPEER] = false;
        $curlConfig[CURLOPT_SSL_VERIFYHOST] = false;
        $curlConfig[CURLOPT_HEADER] = false;
        $curlConfig[CURLOPT_RETURNTRANSFER] = true;
        if (!isset($curlConfig[CURLOPT_TIMEOUT_MS])) {
            $curlConfig[CURLOPT_TIMEOUT_MS] = 3000;
        }
        $sendRes = Tool::sendCurlReq($curlConfig);
        if ($sendRes['res_no'] == 0) {
            return $sendRes['res_content'];
        } else {
            Log::error('curl发送教育直播请求出错,错误码=' . $sendRes['res_no'] . ',错误信息=' . $sendRes['res_msg'], ErrorCode::LIVE_BAIJIA_REQ_ERROR);
            return false;
        }
    }

    /**
     * 发送服务请求
     * @param \SyLive\BaseBaiJia $liveBase
     * @return array
     * @throws \SyException\Common\CheckException
     */
    public static function sendServiceRequest(BaseBaiJia $liveBase)
    {
        $resArr = [
            'code' => 0,
        ];

        $sendRes = self::sendCurl($liveBase->getDetail());
        if ($sendRes === false) {
            $resArr['code'] = ErrorCode::LIVE_BAIJIA_REQ_ERROR;
            $resArr['msg'] = '发送百家云教育直播请求出错';
        }

        $sendData = Tool::jsonDecode($sendRes);
        if (isset($sendData['code']) && ($sendData['code'] == 0)) {
            $resArr['data'] = $sendData['data'];
        } elseif (isset($sendData['msg'])) {
            $resArr['code'] = ErrorCode::LIVE_BAIJIA_REQ_ERROR;
            $resArr['msg'] = $sendData['msg'];
        } else {
            $resArr['code'] = ErrorCode::LIVE_BAIJIA_REQ_ERROR;
            $resArr['msg'] = '解析响应数据出错';
        }

        return $resArr;
    }
}
