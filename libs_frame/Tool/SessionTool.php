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
     * 生成会话JWT数据
     * @param array $data
     * 必填字段:
     *   tag: string|int 标识
     * @return string
     * @throws \Exception\Session\JwtException
     */
    public static function createSessionJwt(array &$data){
        $tag = Tool::getArrayVal($data, 'tag', null);
        if((!is_string($tag)) && !is_numeric($tag)){
            throw new JwtException('标识不正确', ErrorCode::SESSION_JWT_DATA_ERROR);
        }

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
        $data['exp'] = time() + 259200;
        $data['sig'] = hash('md5', $data['tag'] . $data['exp'] . SY_SESSION_SECRET);
        return Tool::pack($data);
    }

    /**
     * 初始化会话JWT数据
     * @return array
     */
    public static function initSessionJwt() : array {
        $initRes = [
            'session' => '',
            'data' => [],
        ];

        if (isset($_COOKIE[Project::DATA_KEY_SESSION_TOKEN])) {
            $jwt = (string)$_COOKIE[Project::DATA_KEY_SESSION_TOKEN];
        } else {
            $jwt = (string)SyRequest::getParams('session_id', '');
        }
        if(strlen($jwt) > 0){
            $jwtData = Tool::unpack($jwt);
            if(is_array($jwtData)){
                $initRes['data'] = $jwtData;
                $initRes['session'] = $jwt;
            }
        }
        if(empty($initRes['data'])){
            $jwtData = [
                'tag' => '',
            ];
            $initRes['session'] = self::createSessionJwt($jwtData);
            $initRes['data'] = $jwtData;
        }

        return $initRes;
    }
}