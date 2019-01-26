<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/26 0026
 * Time: 11:26
 */
namespace DingDing;

use Constant\ErrorCode;
use Exception\DingDing\TalkException;

class TalkConfigProvider {
    /**
     * 消息校验token
     * @var string
     */
    private $token = '';
    /**
     * 加密密钥
     * @var string
     */
    private $aesKey = '';
    /**
     * 套件标识
     * @var string
     */
    private $suiteKey = '';
    /**
     * 套件密钥
     * @var string
     */
    private $suiteSecret = '';

    public function __construct() {
    }

    private function __clone() {
    }

    /**
     * @return string
     */
    public function getToken() : string {
        return $this->token;
    }

    /**
     * @param string $token
     * @throws \Exception\DingDing\TalkException
     */
    public function setToken(string $token){
        if(ctype_alnum($token) && (strlen($token) <= 32)){
            $this->token = $token;
        } else {
            throw new TalkException('消息校验token不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getAesKey() : string {
        return $this->aesKey;
    }

    /**
     * @param string $aesKey
     * @throws \Exception\DingDing\TalkException
     */
    public function setAesKey(string $aesKey) {
        if(ctype_alnum($aesKey) && (strlen($aesKey) == 43)){
            $this->aesKey = $aesKey;
        } else {
            throw new TalkException('加密密钥不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getSuiteKey() : string{
        return $this->suiteKey;
    }

    /**
     * @param string $suiteKey
     * @throws \Exception\DingDing\TalkException
     */
    public function setSuiteKey(string $suiteKey){
        if(ctype_alnum($suiteKey)){
            $this->suiteKey = $suiteKey;
        } else {
            throw new TalkException('套件标识不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getSuiteSecret() : string {
        return $this->suiteSecret;
    }

    /**
     * @param string $suiteSecret
     * @throws \Exception\DingDing\TalkException
     */
    public function setSuiteSecret(string $suiteSecret){
        if(strlen($suiteSecret) > 0){
            $this->suiteSecret = $suiteSecret;
        } else {
            throw new TalkException('套件密钥不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }
}