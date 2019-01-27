<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/26 0026
 * Time: 11:24
 */
namespace DingDing;

use Constant\ErrorCode;
use Constant\Project;
use DesignPatterns\Factories\CacheSimpleFactory;
use DesignPatterns\Singletons\DingTalkConfigSingleton;
use DingDing\Corp\Sso\SsoToken;
use DingDing\CorpProvider\Common\CorpToken;
use Exception\DingDing\TalkException;
use Tool\Tool;
use Traits\SimpleTrait;

final class TalkUtilProvider extends TalkUtilBase {
    use SimpleTrait;

    /**
     * 获取服务商套件ticket
     * @return string
     * @throws \Exception\DingDing\TalkException
     */
    public static function getSuiteTicket() : string {
        $redisKey = Project::REDIS_PREFIX_DINGTALK_PROVIDER_ACCOUNT_SUITE . DingTalkConfigSingleton::getInstance()->getCorpProviderConfig()->getSuiteKey();
        $redisData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if(isset($redisData['unique_key']) && ($redisData['unique_key'] == $redisKey)){
            return $redisData['ticket'];
        } else {
            throw new TalkException('获取服务商套件缓存失败', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * 获取sso token
     * @return string
     */
    public static function getSsoToken() : string {
        $nowTime = Tool::getNowTime();
        $redisKey = Project::REDIS_PREFIX_DINGTALK_PROVIDER_ACCOUNT . DingTalkConfigSingleton::getInstance()->getCorpProviderConfig()->getCorpId();
        $redisData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if (isset($redisData['ssoat_key']) && ($redisData['ssoat_key'] == $redisKey) && ($redisData['ssoat_expire'] >= $nowTime)) {
            return $redisData['ssoat_content'];
        }

        $ssoTokenObj = new SsoToken('');
        $ssoTokenDetail = $ssoTokenObj->getDetail();
        unset($ssoTokenObj);

        CacheSimpleFactory::getRedisInstance()->hMset($redisKey, [
            'ssoat_content' => $ssoTokenDetail['access_token'],
            'ssoat_expire' => (int)($nowTime + 7180),
            'ssoat_key' => $redisKey,
        ]);
        CacheSimpleFactory::getRedisInstance()->expire($redisKey, 8000);

        return $ssoTokenDetail['access_token'];
    }

    /**
     * 获取授权者access token
     * @param string $corpId 授权企业ID
     * @return string
     */
    public static function getAuthorizerAccessToken(string $corpId) : string {
        $nowTime = Tool::getNowTime();
        $redisKey = Project::REDIS_PREFIX_DINGTALK_PROVIDER_AUTHORIZER . $corpId;
        $redisData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if(isset($redisData['at_key']) && ($redisData['at_key'] == $redisKey) && ($redisData['at_expire'] >= $nowTime)){
            return $redisData['at_content'];
        }

        $cropToken = new CorpToken();
        $cropToken->setAuthCorpId($corpId);
        $cropTokenDetail = $cropToken->getDetail();
        unset($cropToken);

        CacheSimpleFactory::getRedisInstance()->hMset($redisKey, [
            'at_key' => $redisKey,
            'at_content' => $cropTokenDetail['access_token'],
            'at_expire' => (int)($nowTime + $cropTokenDetail['expires_in'] - 10),
        ]);
        CacheSimpleFactory::getRedisInstance()->expire($redisKey, 86400);

        return $cropTokenDetail['access_token'];
    }
}