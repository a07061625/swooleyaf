<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-2
 * Time: 上午11:07
 */
namespace Tool;

use Constant\Server;
use Traits\SimpleTrait;
use Yaf\Registry;

class SySessionJwt {
    use SimpleTrait;

    /**
     * 获取session id
     * @return string
     */
    public static function getSessionId() : string {
        return Registry::get(Server::REGISTRY_NAME_RESPONSE_JWT_SESSION);
    }

    /**
     * 更新本地缓存
     * @return array
     */
    public static function refreshLocalCache(){
        return Registry::get(Server::REGISTRY_NAME_RESPONSE_JWT_DATA);
    }

    /**
     * 设置session值
     * @param array $data 数据
     * @return bool
     */
    public static function set(array $data){
        if(empty($data)){
            return false;
        }

        $jwtData = Registry::get(Server::REGISTRY_NAME_RESPONSE_JWT_DATA);
        $mergeRes = array_merge($jwtData, $data);
        Registry::set(Server::REGISTRY_NAME_RESPONSE_JWT_SESSION, SessionTool::createSessionJwt($mergeRes));
        Registry::set(Server::REGISTRY_NAME_RESPONSE_JWT_DATA, $mergeRes);
        return true;
    }

    /**
     * 获取session值
     * @param string|null $key 键名
     * @param mixed|null $default 默认值
     * @return mixed
     */
    public static function get(string $key=null, $default=null){
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
     */
    public static function del(string $key){
        $jwtData = Registry::get(Server::REGISTRY_NAME_RESPONSE_JWT_DATA);
        if($key === ''){
            $jwtData = [
                'tag' => '',
            ];
        } else {
            unset($jwtData[$key]);
        }
        Registry::set(Server::REGISTRY_NAME_RESPONSE_JWT_SESSION, SessionTool::createSessionJwt($jwtData));
        Registry::set(Server::REGISTRY_NAME_RESPONSE_JWT_DATA, $jwtData);
    }
}