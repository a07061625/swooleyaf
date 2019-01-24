<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/10 0010
 * Time: 17:54
 */
namespace SyPrint;

use Constant\ErrorCode;
use Exception\SyPrint\FeYinException;

class ConfigFeYin {
    /**
     * 应用id
     * @var string
     */
    private $appId = '';
    /**
     * API密钥
     * @var string
     */
    private $appKey = '';
    /**
     * 商户编码
     * @var string
     */
    private $memberCode = '';

    public function __construct(){
    }

    private function __clone(){
    }

    /**
     * @return string
     */
    public function getAppId() : string {
        return $this->appId;
    }

    /**
     * @param string $appId
     * @throws \Exception\SyPrint\FeYinException
     */
    public function setAppId(string $appId){
        if(ctype_alnum($appId)){
            $this->appId = $appId;
        } else {
            throw new FeYinException('应用id不合法', ErrorCode::PRINT_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getAppKey() : string {
        return $this->appKey;
    }

    /**
     * @param string $appKey
     * @throws \Exception\SyPrint\FeYinException
     */
    public function setAppKey(string $appKey){
        if(ctype_alnum($appKey)){
            $this->appKey = $appKey;
        } else {
            throw new FeYinException('API密钥不合法', ErrorCode::PRINT_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getMemberCode() : string {
        return $this->memberCode;
    }

    /**
     * @param string $memberCode
     * @throws \Exception\SyPrint\FeYinException
     */
    public function setMemberCode(string $memberCode){
        if(ctype_alnum($memberCode)){
            $this->memberCode = $memberCode;
        } else {
            throw new FeYinException('商户编码不合法', ErrorCode::PRINT_PARAM_ERROR);
        }
    }
}