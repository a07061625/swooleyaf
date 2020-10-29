<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/4/11 0011
 * Time: 18:37
 */
namespace SyTool;

use DesignPatterns\Factories\CacheSimpleFactory;
use SyConstant\ErrorCode;
use SyConstant\Project;
use SyConstant\SyInner;
use SyException\Session\JwtException;
use SyTrait\SimpleTrait;
use Yaf\Registry;

final class SessionTool
{
    use SimpleTrait;

    /**
     * 设置会话JWT的刷新标识
     *
     * @param string $tag
     *
     * @return bool|string
     */
    public static function setSessionJwtRid(string $tag)
    {
        $redisKey = Project::REDIS_PREFIX_SESSION_JWT_REFRESH . $tag;
        $rid = Tool::createNonceStr(6, 'numlower') . time();
        if (CacheSimpleFactory::getRedisInstance()->set($redisKey, $rid, SY_EXPIRE_SESSION_JWT_RID)) {
            return $rid;
        }

        return false;
    }

    /**
     * 生成会话JWT数据
     *
     * @param array $data
     *                    必填字段:
     *                    uid: string|int 用户标识
     *
     * @throws \SyException\Session\JwtException
     */
    public static function createSessionJwt(array &$data)
    {
        $uid = Tool::getArrayVal($data, 'uid', null);
        if (is_string($uid)) {
            if (strlen((string)$uid) > 0) {
                $rid = (string)Tool::getArrayVal($data, 'rid', '');
                if (strlen($rid) == 0) {
                    $redisKey = Project::REDIS_PREFIX_SESSION_JWT_REFRESH . $uid;
                    $redisData = CacheSimpleFactory::getRedisInstance()->get($redisKey);
                    $data['rid'] = is_string($redisData) ? $redisData : '';
                }
            } else {
                $data['rid'] = '';
            }
        } else {
            throw new JwtException('用户标识不正确', ErrorCode::SESSION_JWT_DATA_ERROR);
        }
    }

    /**
     * 生成默认JWT数据
     *
     * @return array
     */
    public static function createDefaultJwt() : array
    {
        $jwtData = [
            'uid' => '',
        ];
        self::createSessionJwt($jwtData);

        return $jwtData;
    }

    /**
     * 初始化会话JWT数据
     */
    public static function initSessionJwt()
    {
        $sessionId = SySession::initSessionId();
        $cacheData = [];
        if ($sessionId[0] == '1') {
            $redisKey = Project::REDIS_PREFIX_SESSION . $sessionId;
            $redisData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
            if (isset($redisData['sid']) && ($redisData['sid'] == $sessionId)) {
                $cacheData = $redisData;
            }
        }
        if (empty($cacheData)) {
            $cacheData = self::createDefaultJwt();
        }
        Registry::set(SyInner::REGISTRY_NAME_RESPONSE_JWT_DATA, $cacheData);
        Registry::set(SyInner::REGISTRY_NAME_RESPONSE_JWT_SESSION, $sessionId);
    }
}
