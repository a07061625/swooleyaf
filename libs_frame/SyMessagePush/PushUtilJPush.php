<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/6/25 0025
 * Time: 11:06
 */
namespace SyMessagePush;

use SyConstant\ErrorCode;
use SyConstant\Project;
use DesignPatterns\Factories\CacheSimpleFactory;
use DesignPatterns\Singletons\MessagePushConfigSingleton;
use SyException\MessagePush\JPushException;
use SyMessagePush\JPush\Push\CidList;
use SyTool\Tool;
use SyTrait\SimpleTrait;

final class PushUtilJPush extends PushUtilBase
{
    use SimpleTrait;

    /**
     * 获取授权字符串
     * @param string $key
     * @param string $authType 授权类型 app:应用 group:分组 dev:开发
     * @return string
     */
    public static function getReqAuth(string $key, string $authType)
    {
        if ($authType == 'app') {
            $config = MessagePushConfigSingleton::getInstance()->getJPushAppConfig($key);
            return $config->getAuth();
        } elseif ($authType == 'group') {
            $config = MessagePushConfigSingleton::getInstance()->getJPushGroupConfig($key);
            return $config->getAuth();
        } else {
            $config = MessagePushConfigSingleton::getInstance()->getJPushDevConfig();
            return $config->getAuth();
        }
    }

    /**
     * 发送服务请求
     * @param \SyMessagePush\PushBaseJPush $pushBase
     * @return array
     */
    public static function sendServiceRequest(PushBaseJPush $pushBase)
    {
        $resArr = [
            'code' => 0,
        ];

        $curlConfigs = $pushBase->getDetail();
        $sendRes = Tool::sendCurlReq($curlConfigs);
        if ($sendRes['res_no'] > 0) {
            $resArr['code'] = ErrorCode::MESSAGE_PUSH_REQ_JPUSH_ERROR;
            $resArr['msg'] = $sendRes['res_msg'];
            return $resArr;
        }
        $rspData = Tool::jsonDecode($sendRes['res_content']);
        if (isset($rspData['error'])) {
            $resArr['code'] = ErrorCode::MESSAGE_PUSH_REQ_JPUSH_ERROR;
            $resArr['msg'] = $rspData['error']['message'];
        } elseif (is_array($rspData)) {
            $resArr['data'] = $rspData;
        } else {
            $resArr['code'] = ErrorCode::MESSAGE_PUSH_REQ_JPUSH_ERROR;
            $resArr['msg'] = '解析响应数据出错';
        }
        return $resArr;
    }

    /**
     * 获取APP唯一标识符
     * @param string $key
     * @param string $type 类型 push:推送 schedule:定时任务
     * @return string
     * @throws \SyException\MessagePush\JPushException
     */
    public static function getAppCid(string $key, string $type)
    {
        if ($type == 'push') {
            $redisKey = Project::REDIS_PREFIX_JPUSH_APP_CID_PUSH . $key;
        } else {
            $redisKey = Project::REDIS_PREFIX_JPUSH_APP_CID_SCHEDULE . $key;
        }
        $cid = CacheSimpleFactory::getRedisInstance()->lPop($redisKey);
        if (is_string($cid)) {
            return $cid;
        }

        $cidList = new CidList($key);
        $cidList->setType($type);
        $cidList->setCount(800);
        $sendRes = PushUtilJPush::sendServiceRequest($cidList);
        if ($sendRes['code'] > 0) {
            throw new JPushException($sendRes['msg'], $sendRes['code']);
        }

        $cid = $sendRes['data']['cidlist'][0];
        unset($sendRes['data']['cidlist'][0]);
        $pipe = CacheSimpleFactory::getRedisInstance()->multi(\Redis::PIPELINE);
        foreach ($sendRes['data']['cidlist'] as $eCid) {
            $pipe->rPush($redisKey, $eCid);
        }
        $pipe->exec();
        $pipe->close();
        CacheSimpleFactory::getRedisInstance()->expire($redisKey, 86400);

        return $cid;
    }
}
