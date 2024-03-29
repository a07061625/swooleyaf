<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-2
 * Time: 上午11:07
 */

namespace SyTool;

use DesignPatterns\Factories\CacheSimpleFactory;
use Request\SyRequest;
use SyConstant\Project;
use SyConstant\SyInner;
use SyLog\Log;
use SyTrait\SimpleTrait;
use Yaf\Registry;

class SySessionJwt
{
    use SimpleTrait;

    public static function getCookieKey()
    {
        return Project::DATA_KEY_SESSION_TOKEN;
    }

    public static function initSessionId()
    {
        $cookieKey = SySession::getCookieKey();
        if (isset($_COOKIE[$cookieKey])) {
            $token = (string)$_COOKIE[$cookieKey];
        } elseif (isset($_SERVER['SY-AUTH'])) {
            $token = (string)$_SERVER['SY-AUTH'];
        } else {
            $token = (string)SyRequest::getParams('session_id', '');
        }
        if ((16 == \strlen($token)) && \in_array($token[0], ['0', '1']) && ctype_alnum($token)) {
            $sessionId = $token;
        } else {
            $sessionId = '0' . Tool::createNonceStr(5, 'numlower') . Tool::getNowTime();
        }

        return $sessionId;
    }

    /**
     * 获取session id
     */
    public static function getSessionId(): string
    {
        return Registry::get(SyInner::REGISTRY_NAME_RESPONSE_JWT_SESSION);
    }

    /**
     * 更新本地缓存
     *
     * @return array
     */
    public static function refreshLocalCache()
    {
        $jwtData = Registry::get(SyInner::REGISTRY_NAME_RESPONSE_JWT_DATA);
        if (\strlen($jwtData['uid']) > 0) {
            return $jwtData;
        }

        return [];
    }

    /**
     * 设置session值
     *
     * @param array  $data      数据
     * @param string $sessionId 会话ID
     *
     * @return bool
     */
    public static function set(array $data, string $sessionId = '')
    {
        if (empty($data)) {
            return false;
        }

        if (0 == \strlen($sessionId)) {
            $token = Registry::get(SyInner::REGISTRY_NAME_RESPONSE_JWT_SESSION);
            $sid = '1' . substr($token, 1);
        } else {
            $sid = $sessionId;
        }

        $jwtData = Registry::get(SyInner::REGISTRY_NAME_RESPONSE_JWT_DATA);
        $mergeRes = array_merge($jwtData, $data);
        $mergeRes['sid'] = $sid;
        SessionTool::createSessionJwt($mergeRes);
        $redisKey = Project::REDIS_PREFIX_SESSION . $sid;
        $setRes = CacheSimpleFactory::getRedisInstance()->hMset($redisKey, $mergeRes);
        if ($setRes) {
            CacheSimpleFactory::getRedisInstance()->expire($redisKey, Project::TIME_EXPIRE_SESSION);
            Registry::set(SyInner::REGISTRY_NAME_RESPONSE_JWT_DATA, $mergeRes);
            Registry::set(SyInner::REGISTRY_NAME_RESPONSE_JWT_SESSION, $sid);
        } else {
            Log::error('set session data error,key=' . $redisKey . ' data=' . print_r($mergeRes, true));
        }

        return $setRes;
    }

    /**
     * 获取session值
     *
     * @param null|string $key     键名
     * @param null|mixed  $default 默认值
     *
     * @return mixed
     */
    public static function get(?string $key = null, $default = null)
    {
        $jwtData = Registry::get(SyInner::REGISTRY_NAME_RESPONSE_JWT_DATA);
        if (null === $key) {
            return $jwtData;
        }

        return $jwtData[$key] ?? $default;
    }

    /**
     * 删除session值
     *
     * @return bool|int
     */
    public static function del(string $key)
    {
        if (\in_array($key, ['uid', 'rid'], true)) {
            return false;
        }

        $token = Registry::get(SyInner::REGISTRY_NAME_RESPONSE_JWT_SESSION);
        $redisKey = Project::REDIS_PREFIX_SESSION . $token;
        if ('' === $key) {
            $delRes = CacheSimpleFactory::getRedisInstance()->del($redisKey);
            $jwtData = SessionTool::createDefaultJwt();
        } else {
            $delRes = CacheSimpleFactory::getRedisInstance()->hDel($redisKey, $key);
            $jwtData = Registry::get(SyInner::REGISTRY_NAME_RESPONSE_JWT_DATA);
            unset($jwtData[$key]);
        }
        Registry::set(SyInner::REGISTRY_NAME_RESPONSE_JWT_DATA, $jwtData);

        return $delRes;
    }
}
