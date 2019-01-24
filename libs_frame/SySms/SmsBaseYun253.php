<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/8 0008
 * Time: 15:04
 */
namespace SySms;

use DesignPatterns\Singletons\SmsConfigSingleton;

abstract class SmsBaseYun253 extends SmsBase {
    /**
     * API账号
     * @var string
     */
    private $account = '';
    /**
     * API密码
     * @var string
     */
    private $password = '';
    /**
     * 服务地址
     * @var string
     */
    protected $serviceUrl = '';

    public function __construct(){
    }

    private function __clone(){
    }

    /**
     * @return string
     */
    public function getServiceUrl() : string {
        return $this->serviceUrl;
    }

    protected function getContent() : array {
        $this->reqData['account'] = SmsConfigSingleton::getInstance()->getYun253Config()->getAppKey();
        $this->reqData['password'] = SmsConfigSingleton::getInstance()->getYun253Config()->getAppSecret();
        return $this->reqData;
    }
}