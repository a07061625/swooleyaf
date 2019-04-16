<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/4/11 0011
 * Time: 18:37
 */
namespace Tool;

use Constant\ErrorCode;
use Constant\Project;
use Constant\Server;
use DesignPatterns\Factories\CacheSimpleFactory;
use Exception\Session\JwtException;
use Request\SyRequest;
use Traits\SimpleTrait;
use Yaf\Registry;

final class SessionTool {
    use SimpleTrait;

    /**
     * 校验会话JWT数据
     * @return array
     */
    public static function checkSessionJwt() : array {
        $resArr = [
            'tag' => '',
            'rid' => '',
            'exp' => 0,
            'error' => '',
        ];

        $jwtData = Registry::get(Server::REGISTRY_NAME_RESPONSE_JWT_DATA);
        $sign = hash('md5', $jwtData['tag'] . $jwtData['exp'] . SY_SESSION_SECRET);
        if($sign == $jwtData['sig']){
            $resArr['tag'] = $jwtData['tag'];
            $resArr['rid'] = $jwtData['rid'];
            $resArr['exp'] = (int)$jwtData['exp'];
        } else {
            $resArr['error'] = '会话签名错误';
        }

        return $resArr;
    }

    /**
     * 设置会话JWT的刷新标识
     * @param string $tag
     * @return bool|string
     */
    public static function setSessionJwtRid(string $tag){
        $redisKey = Project::REDIS_PREFIX_SESSION_JWT_REFRESH . $tag;
        $rid = Tool::createNonceStr(6, 'numlower') . time();
        if(CacheSimpleFactory::getRedisInstance()->set($redisKey, $rid, SY_SESSION_JW_RID_EXPIRE)){
            return $rid;
        } else {
            return false;
        }
    }

    /**
     * 生成会话JWT数据
     * @param array $data
     * 必填字段:
     *   tag: string|int 标识
     * @return string
     * @throws \Exception\Session\JwtException
     */
    public static function createSessionJwt(array &$data){
        $tag = Tool::getArrayVal($data, 'tag', null);
        if(is_string($tag) || is_numeric($tag)){
            if(strlen((string)$tag) > 0){
                $rid = (string)Tool::getArrayVal($data, 'rid', '');
                if(strlen($rid) == 0){
                    $redisKey = Project::REDIS_PREFIX_SESSION_JWT_REFRESH . $tag;
                    $redisData = CacheSimpleFactory::getRedisInstance()->get($redisKey);
                    $data['rid'] = is_string($redisData) ? $redisData : '';
                }
            } else {
                $data['rid'] = '';
            }
            $data['exp'] = time() + SY_SESSION_JW_EXPIRE;
            $data['sig'] = hash('md5', $data['tag'] . $data['exp'] . SY_SESSION_SECRET);
            $packData = pack('a*', Tool::pack($data));
            return base64_encode($packData);
        } else {
            throw new JwtException('标识不正确', ErrorCode::SESSION_JWT_DATA_ERROR);
        }
    }

    /**
     * 生成默认JWT数据
     * @return array
     */
    private static function createDefaultJwt() : array {
        $jwtData = [
            'tag' => '',
        ];

        return [
            'session' => self::createSessionJwt($jwtData),
            'data' => $jwtData,
        ];
    }

    /**
     * 初始化会话JWT数据
     * @return array
     */
    public static function initSessionJwt() : array {
        if (isset($_COOKIE[Project::DATA_KEY_SESSION_TOKEN])) {
            $jwt = (string)$_COOKIE[Project::DATA_KEY_SESSION_TOKEN];
        } else if(isset($_SERVER['SY-AUTH'])){
            $jwt = (string)$_SERVER['SY-AUTH'];
        } else {
            $jwt = (string)SyRequest::getParams('session_id', '');
        }

        if(strlen($jwt) == 0){
            return self::createDefaultJwt();
        }

        $decodeData = base64_decode($jwt);
        if(is_bool($decodeData)){
            return self::createDefaultJwt();
        }

        $unpackData = unpack('a*L1', $decodeData);
        if(!isset($unpackData['L1'])){
            return self::createDefaultJwt();
        }

        $jwtData = Tool::unpack($unpackData['L1']);
        if(is_array($jwtData)){
            return [
                'session' => $jwt,
                'data' => $jwtData,
            ];
        } else {
            return self::createDefaultJwt();
        }
    }
}