<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-2
 * Time: 上午11:07
 */
namespace Tool;

use Constant\Project;
use DesignPatterns\Factories\CacheSimpleFactory;
use Log\Log;
use Request\SyRequest;
use SyServer\BaseServer;
use Traits\SimpleTrait;

class SySessionBase {
    use SimpleTrait;

    /**
     * 获取session id
     * @param string $inToken 外部输入的token值
     * @return string
     */
    public static function getSessionId(string $inToken='') : string {
        if (strlen($inToken) > 0) {
            $token = $inToken;
        } else if (isset($_COOKIE[Project::DATA_KEY_SESSION_TOKEN])) {
            $token = (string)$_COOKIE[Project::DATA_KEY_SESSION_TOKEN];
        } else {
            $token = (string)SyRequest::getParams('session_id', '');
        }
        if ((strlen($token) == 16) && ctype_alnum($token)) {
            return $token;
        } else {
            return Tool::createNonceStr(6, 'numlower') . Tool::getNowTime();
        }
    }

    /**
     * 更新本地缓存
     * @param string $inToken 外部输入的token值
     * @return array
     */
    public static function refreshLocalCache(string $inToken=''){
        $token = SySession::getSessionId($inToken);
        $redisKey = Project::REDIS_PREFIX_SESSION . $token;
        $cacheData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if (isset($cacheData['session_id']) && ($cacheData['session_id'] == $token)) {
            BaseServer::addLocalUserInfo($token, $cacheData);
            return $cacheData;
        } else if(empty($cacheData)){
            BaseServer::delLocalUserInfo($token);
            return [];
        } else {
            return [];
        }
    }

    /**
     * 设置session值
     * @param array $data 数据
     * @param string $inToken 外部输入的token值
     * @return bool
     */
    public static function set(array $data,string $inToken=''){
        if(empty($data)){
            return false;
        }

        $token = SySession::getSessionId($inToken);
        $redisKey = Project::REDIS_PREFIX_SESSION . $token;
        $data['session_id'] = $token;
        $setRes = CacheSimpleFactory::getRedisInstance()->hMset($redisKey, $data);
        if($setRes){
            CacheSimpleFactory::getRedisInstance()->expire($redisKey, Project::TIME_EXPIRE_SESSION);
        } else {
            Log::error('set session data error,key=' . $redisKey . ' data=' . print_r($data, true));
        }

        return $setRes;
    }

    /**
     * 获取session值
     * @param string|null $key hash键名
     * @param mixed|null $default 默认值
     * @param string $inToken 外部输入的token值
     * @return mixed
     */
    public static function get(string $key=null, $default=null,string $inToken=''){
        $refreshTag = false;
        $token = SySession::getSessionId($inToken);
        $cacheData = BaseServer::getLocalUserInfo($token);
        if(empty($cacheData)){
            $redisKey = Project::REDIS_PREFIX_SESSION . $token;
            $cacheData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
            $refreshTag = true;
        }
        if (isset($cacheData['session_id']) && ($cacheData['session_id'] == $token)) {
            if($refreshTag){
                BaseServer::addLocalUserInfo($token, $cacheData);
            }
            if (is_null($key)) {
                return $cacheData;
            } else {
                return $cacheData[$key] ?? $default;
            }
        } else {
            return $default;
        }
    }

    /**
     * 删除session值
     * @param string $key
     * @param string $inToken
     * @return int
     */
    public static function del(string $key,string $inToken=''){
        $token = SySession::getSessionId($inToken);
        $redisKey = Project::REDIS_PREFIX_SESSION . $token;
        if($key === ''){
            return CacheSimpleFactory::getRedisInstance()->del($redisKey);
        } else {
            return CacheSimpleFactory::getRedisInstance()->hDel($redisKey, $key);
        }
    }
}