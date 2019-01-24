<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-2
 * Time: 下午12:15
 */
namespace Tool;

use Traits\SimpleTrait;

class SyUserBase {
    use SimpleTrait;

    protected static $info = null;

    /**
     * 获取用户信息
     * @param bool $force 是否强制获取用户信息,true:是 false:否
     * @return array
     */
    public static function getUserInfo($force=false){
        if($force || is_null(self::$info)){
            self::$info = SySession::refreshLocalCache();
        }

        return self::$info;
    }
}