<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/2/22 0022
 * Time: 16:53
 */
namespace Traits\Server;

use Constant\Project;
use Tool\Tool;

trait BasicHttpTrait {
    /**
     * 接口签名缓存列表
     * @var \swoole_table
     */
    private static $_sySigns = null;
    /**
     * 最大签名缓存数量
     * @var int
     */
    private static $_sySignMaxNum = 0;
    /**
     * 当前签名缓存数量
     * @var int
     */
    private static $_sySignNowNum = 0;

    private function checkServerHttp() {
        $this->checkServerBase();
        self::$_sySignNowNum = 0;
        self::$_sySignMaxNum = $this->_configs['server']['cachenum']['sign'];
        if (self::$_sySignMaxNum < 1) {
            exit('签名缓存数量不能小于1');
        } else if ((self::$_sySignMaxNum & (self::$_sySignMaxNum - 1)) != 0) {
            exit('签名缓存数量必须是2的指数倍');
        }
        $this->checkServerHttpTrait();
    }

    /**
     * 添加签名缓存
     * @param string $sign 签名信息
     * @return bool
     */
    public static function addApiSign(string $sign) : bool {
        $needSign = substr($sign, 16);
        if (self::$_sySigns->exist($needSign)) {
            return false;
        } else if (self::$_sySignNowNum < self::$_sySignMaxNum) {
            self::$_sySigns->set($needSign, [
                'sign' => $needSign,
                'time' => Tool::getNowTime(),
            ]);
            self::$_sySignNowNum++;

            return true;
        } else {
            return true;
        }
    }

    /**
     * 清理签名缓存
     */
    private function clearApiSign() {
        $time = Tool::getNowTime() - Project::TIME_EXPIRE_LOCAL_API_SIGN_CACHE;
        $delKeys = [];
        foreach (self::$_sySigns as $eSign) {
            if($eSign['time'] <= $time){
                $delKeys[] = $eSign['sign'];
            }
        }
        foreach ($delKeys as $eKey) {
            self::$_sySigns->del($eKey);
        }
        self::$_sySignNowNum = self::$_sySigns->count();
    }

    private function initTableHttp() {
        $this->initTableBase();
        self::$_sySigns = new \swoole_table($this->_configs['server']['cachenum']['sign']);
        self::$_sySigns->column('sign', \swoole_table::TYPE_STRING, 32);
        self::$_sySigns->column('time', \swoole_table::TYPE_INT, 4);
        self::$_sySigns->create();
        $this->initTableHttpTrait();
    }
}