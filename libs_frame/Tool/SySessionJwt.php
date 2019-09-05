<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-2
 * Time: 上午11:07
 */
namespace Tool;

use SyConstant\Project;
use SyConstant\Server;
use DesignPatterns\Factories\CacheSimpleFactory;
use Log\Log;
use SyTrait\SimpleTrait;
use Yaf\Registry;

class SySessionJwt
{
    use SimpleTrait;

    /**
     * 获取session id
     * @return string
     */
    public static function getSessionId() : string
    {
        return Registry::get(Server::REGISTRY_NAME_RESPONSE_JWT_SESSION);
    }

    /**
     * 更新本地缓存
     * @return array
     */
    public static function refreshLocalCache()
    {
        $jwtData = Registry::get(Server::REGISTRY_NAME_RESPONSE_JWT_DATA);
        if (strlen($jwtData['uid']) > 0) {
            return $jwtData;
        } else {
            return [];
        }
    }

    /**
     * 设置session值
     * @param array $data 数据
     * @return bool
     */
    public static function set(array $data)
    {
        if (empty($data)) {
            return false;
        }

        $token = Registry::get(Server::REGISTRY_NAME_RESPONSE_JWT_SESSION);
        $sessionId = '1' . substr($token, 1);
        $jwtData = Registry::get(Server::REGISTRY_NAME_RESPONSE_JWT_DATA);
        $mergeRes = array_merge($jwtData, $data);
        $mergeRes['sid'] = $sessionId;
        SessionTool::createSessionJwt($mergeRes);
        $redisKey = Project::REDIS_PREFIX_SESSION . $sessionId;
        $setRes = CacheSimpleFactory::getRedisInstance()->hMset($redisKey, $mergeRes);
        if ($setRes) {
            CacheSimpleFactory::getRedisInstance()->expire($redisKey, Project::TIME_EXPIRE_SESSION);
            Registry::set(Server::REGISTRY_NAME_RESPONSE_JWT_DATA, $mergeRes);
            Registry::set(Server::REGISTRY_NAME_RESPONSE_JWT_SESSION, $sessionId);
        } else {
            Log::error('set session data error,key=' . $redisKey . ' data=' . print_r($mergeRes, true));
        }
        return $setRes;
    }

    /**
     * 获取session值
     * @param string|null $key 键名
     * @param mixed|null $default 默认值
     * @return mixed
     */
    public static function get(string $key = null, $default = null)
    {
        $jwtData = Registry::get(Server::REGISTRY_NAME_RESPONSE_JWT_DATA);
        if (is_null($key)) {
            return $jwtData;
        } else {
            return $jwtData[$key] ?? $default;
        }
    }

    /**
     * 删除session值
     * @param string $key
     * @return bool|int
     */
    public static function del(string $key)
    {
        if (in_array($key, ['uid','rid',], true)) {
            return false;
        }

        $token = Registry::get(Server::REGISTRY_NAME_RESPONSE_JWT_SESSION);
        $redisKey = Project::REDIS_PREFIX_SESSION . $token;
        if ($key === '') {
            $delRes = CacheSimpleFactory::getRedisInstance()->del($redisKey);
            $jwtData = SessionTool::createDefaultJwt();
        } else {
            $delRes = CacheSimpleFactory::getRedisInstance()->hDel($redisKey, $key);
            $jwtData = Registry::get(Server::REGISTRY_NAME_RESPONSE_JWT_DATA);
            unset($jwtData[$key]);
        }
        Registry::set(Server::REGISTRY_NAME_RESPONSE_JWT_DATA, $jwtData);

        return $delRes;
    }
}
