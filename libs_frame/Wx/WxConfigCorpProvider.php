<?php
/**
 * 企业微信服务商配置类
 * User: 姜伟
 * Date: 2019-01-20
 * Time: 16:36
 */
namespace Wx;

use Constant\ErrorCode;
use Exception\Wx\WxException;

class WxConfigCorpProvider {
    /**
     * 企业ID
     * @var string
     */
    private $corpId = '';
    /**
     * 企业密钥
     * @var string
     */
    private $corpSecret = '';
    /**
     * 消息校验token
     * @var string
     */
    private $token = '';
    /**
     * 消息加解密key
     * @var string
     */
    private $aesKey = '';
    /**
     * 套件ID
     * @var string
     */
    private $suiteId = '';
    /**
     * 套件密钥
     * @var string
     */
    private $suiteSecret = '';
    /**
     * 套件授权地址
     * @var string
     */
    private $urlAuthSuite = '';
    /**
     * 登录授权地址
     * @var string
     */
    private $urlAuthLogin = '';

    public function __construct() {
    }

    private function __clone() {
    }

    /**
     * @return string
     */
    public function getCorpId() : string {
        return $this->corpId;
    }

    /**
     * @param string $corpId
     * @throws \Exception\Wx\WxException
     */
    public function setCorpId(string $corpId) {
        if(ctype_alnum($corpId)){
            $this->corpId = $corpId;
        } else {
            throw new WxException('企业ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getCorpSecret() : string {
        return $this->corpSecret;
    }

    /**
     * @param string $corpSecret
     * @throws \Exception\Wx\WxException
     */
    public function setCorpSecret(string $corpSecret) {
        if(ctype_alnum($corpSecret)){
            $this->corpSecret = $corpSecret;
        } else {
            throw new WxException('企业密钥不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getToken() : string {
        return $this->token;
    }

    /**
     * @param string $token
     * @throws \Exception\Wx\WxException
     */
    public function setToken(string $token){
        if(ctype_alnum($token) && (strlen($token) <= 32)){
            $this->token = $token;
        } else {
            throw new WxException('消息校验token不合法', ErrorCode::WX_PARAM_ERROR);
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
     * @throws \Exception\Wx\WxException
     */
    public function setAesKey(string $aesKey) {
        if(ctype_alnum($aesKey) && (strlen($aesKey) == 43)){
            $this->aesKey = $aesKey;
        } else {
            throw new WxException('消息加解密key不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getSuiteId() : string {
        return $this->suiteId;
    }

    /**
     * @param string $suiteId
     * @throws \Exception\Wx\WxException
     */
    public function setSuiteId(string $suiteId){
        if(ctype_alnum($suiteId)){
            $this->suiteId = $suiteId;
        } else {
            throw new WxException('套件ID不合法', ErrorCode::WX_PARAM_ERROR);
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
     * @throws \Exception\Wx\WxException
     */
    public function setSuiteSecret(string $suiteSecret){
        if(strlen($suiteSecret) > 0){
            $this->suiteSecret = $suiteSecret;
        } else {
            throw new WxException('套件密钥不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getUrlAuthSuite() : string {
        return $this->urlAuthSuite;
    }

    /**
     * @param string $urlAuthSuite
     * @throws \Exception\Wx\WxException
     */
    public function setUrlAuthSuite(string $urlAuthSuite){
        if(preg_match('/^(http|https)\:\/\/\S+$/', $urlAuthSuite) > 0){
            $this->urlAuthSuite = $urlAuthSuite;
        } else {
            throw new WxException('套件授权地址不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getUrlAuthLogin() : string {
        return $this->urlAuthLogin;
    }

    /**
     * @param string $urlAuthLogin
     * @throws \Exception\Wx\WxException
     */
    public function setUrlAuthLogin(string $urlAuthLogin){
        if(preg_match('/^(http|https)\:\/\/\S+$/', $urlAuthLogin) > 0){
            $this->urlAuthLogin = $urlAuthLogin;
        } else {
            throw new WxException('登录授权地址不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }
}