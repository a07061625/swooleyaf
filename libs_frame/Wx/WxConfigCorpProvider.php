<?php
/**
 * 企业微信服务商配置类
 * User: 姜伟
 * Date: 2019-01-20
 * Time: 16:36
 */

namespace Wx;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Wx\WxException;

class WxConfigCorpProvider
{
    /**
     * 企业ID
     *
     * @var string
     */
    private $corpId = '';
    /**
     * 企业密钥
     *
     * @var string
     */
    private $corpSecret = '';
    /**
     * 消息校验token
     *
     * @var string
     */
    private $token = '';
    /**
     * 消息加解密key
     *
     * @var string
     */
    private $aesKey = '';
    /**
     * 套件ID
     *
     * @var string
     */
    private $suiteId = '';
    /**
     * 套件密钥
     *
     * @var string
     */
    private $suiteSecret = '';
    /**
     * 套件授权地址
     *
     * @var string
     */
    private $urlAuthSuite = '';
    /**
     * 登录授权地址
     *
     * @var string
     */
    private $urlAuthLogin = '';

    public function __construct()
    {
        //do nothing
    }

    private function __clone()
    {
        //do nothing
    }

    public function getCorpId(): string
    {
        return $this->corpId;
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setCorpId(string $corpId)
    {
        if (ctype_alnum($corpId)) {
            $this->corpId = $corpId;
        } else {
            throw new WxException('企业ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getCorpSecret(): string
    {
        return $this->corpSecret;
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setCorpSecret(string $corpSecret)
    {
        if (ctype_alnum($corpSecret)) {
            $this->corpSecret = $corpSecret;
        } else {
            throw new WxException('企业密钥不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setToken(string $token)
    {
        if (ctype_alnum($token) && (\strlen($token) <= 32)) {
            $this->token = $token;
        } else {
            throw new WxException('消息校验token不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getAesKey(): string
    {
        return $this->aesKey;
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setAesKey(string $aesKey)
    {
        if (ctype_alnum($aesKey) && (43 == \strlen($aesKey))) {
            $this->aesKey = $aesKey;
        } else {
            throw new WxException('消息加解密key不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getSuiteId(): string
    {
        return $this->suiteId;
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setSuiteId(string $suiteId)
    {
        if (ctype_alnum($suiteId)) {
            $this->suiteId = $suiteId;
        } else {
            throw new WxException('套件ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getSuiteSecret(): string
    {
        return $this->suiteSecret;
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setSuiteSecret(string $suiteSecret)
    {
        if (\strlen($suiteSecret) > 0) {
            $this->suiteSecret = $suiteSecret;
        } else {
            throw new WxException('套件密钥不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getUrlAuthSuite(): string
    {
        return $this->urlAuthSuite;
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setUrlAuthSuite(string $urlAuthSuite)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $urlAuthSuite) > 0) {
            $this->urlAuthSuite = $urlAuthSuite;
        } else {
            throw new WxException('套件授权地址不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getUrlAuthLogin(): string
    {
        return $this->urlAuthLogin;
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setUrlAuthLogin(string $urlAuthLogin)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $urlAuthLogin) > 0) {
            $this->urlAuthLogin = $urlAuthLogin;
        } else {
            throw new WxException('登录授权地址不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }
}
