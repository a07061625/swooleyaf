<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/26 0026
 * Time: 11:26
 */

namespace DingDing;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\DingDing\TalkException;

class TalkConfigProvider
{
    /**
     * 企业ID
     *
     * @var string
     */
    private $corpId = '';
    /**
     * 免登密钥
     *
     * @var string
     */
    private $ssoSecret = '';
    /**
     * 消息校验token
     *
     * @var string
     */
    private $token = '';
    /**
     * 加密密钥
     *
     * @var string
     */
    private $aesKey = '';
    /**
     * 套件ID
     *
     * @var int
     */
    private $suiteId = 0;
    /**
     * 套件标识
     *
     * @var string
     */
    private $suiteKey = '';
    /**
     * 套件密钥
     *
     * @var string
     */
    private $suiteSecret = '';
    /**
     * 登陆应用ID
     *
     * @var string
     */
    private $loginAppId = '';
    /**
     * 登陆应用密钥
     *
     * @var string
     */
    private $loginAppSecret = '';
    /**
     * 登陆应用回调地址
     *
     * @var string
     */
    private $loginUrlCallback = '';

    public function __construct()
    {
    }

    private function __clone()
    {
    }

    public function getCorpId(): string
    {
        return $this->corpId;
    }

    /**
     * @throws \SyException\DingDing\TalkException
     */
    public function setCorpId(string $corpId)
    {
        if (ctype_alnum($corpId)) {
            $this->corpId = $corpId;
        } else {
            throw new TalkException('企业ID不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getSsoSecret(): string
    {
        return $this->ssoSecret;
    }

    /**
     * @throws \SyException\DingDing\TalkException
     */
    public function setSsoSecret(string $ssoSecret)
    {
        if (ctype_alnum($ssoSecret)) {
            $this->ssoSecret = $ssoSecret;
        } else {
            throw new TalkException('免登密钥不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @throws \SyException\DingDing\TalkException
     */
    public function setToken(string $token)
    {
        if (ctype_alnum($token) && (\strlen($token) <= 32)) {
            $this->token = $token;
        } else {
            throw new TalkException('消息校验token不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getAesKey(): string
    {
        return $this->aesKey;
    }

    /**
     * @throws \SyException\DingDing\TalkException
     */
    public function setAesKey(string $aesKey)
    {
        if (ctype_alnum($aesKey) && (43 == \strlen($aesKey))) {
            $this->aesKey = $aesKey;
        } else {
            throw new TalkException('加密密钥不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getSuiteId(): int
    {
        return $this->suiteId;
    }

    /**
     * @throws \SyException\DingDing\TalkException
     */
    public function setSuiteId(int $suiteId)
    {
        if ($suiteId > 0) {
            $this->suiteId = $suiteId;
        } else {
            throw new TalkException('套件ID不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getSuiteKey(): string
    {
        return $this->suiteKey;
    }

    /**
     * @throws \SyException\DingDing\TalkException
     */
    public function setSuiteKey(string $suiteKey)
    {
        if (ctype_alnum($suiteKey)) {
            $this->suiteKey = $suiteKey;
        } else {
            throw new TalkException('套件标识不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getSuiteSecret(): string
    {
        return $this->suiteSecret;
    }

    /**
     * @throws \SyException\DingDing\TalkException
     */
    public function setSuiteSecret(string $suiteSecret)
    {
        if (\strlen($suiteSecret) > 0) {
            $this->suiteSecret = $suiteSecret;
        } else {
            throw new TalkException('套件密钥不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getLoginAppId(): string
    {
        return $this->loginAppId;
    }

    /**
     * @throws \SyException\DingDing\TalkException
     */
    public function setLoginAppId(string $loginAppId)
    {
        if (ctype_alnum($loginAppId)) {
            $this->loginAppId = $loginAppId;
        } else {
            throw new TalkException('登陆应用ID不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getLoginAppSecret(): string
    {
        return $this->loginAppSecret;
    }

    /**
     * @throws \SyException\DingDing\TalkException
     */
    public function setLoginAppSecret(string $loginAppSecret)
    {
        if (\strlen($loginAppSecret) > 0) {
            $this->loginAppSecret = $loginAppSecret;
        } else {
            throw new TalkException('登陆应用密钥不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getLoginUrlCallback(): string
    {
        return $this->loginUrlCallback;
    }

    /**
     * @throws \SyException\DingDing\TalkException
     */
    public function setLoginUrlCallback(string $loginUrlCallback)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $loginUrlCallback) > 0) {
            $this->loginUrlCallback = $loginUrlCallback;
        } else {
            throw new TalkException('登陆应用回调地址不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }
}
