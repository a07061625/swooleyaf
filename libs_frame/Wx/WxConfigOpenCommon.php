<?php
/**
 * 微信开放平台公共配置类
 * User: 姜伟
 * Date: 2017/6/13 0013
 * Time: 20:41
 */

namespace Wx;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Wx\WxOpenException;
use SyTool\Tool;

class WxConfigOpenCommon
{
    /**
     * 开放平台access token超时时间,单位为秒
     *
     * @var int
     */
    private $expireComponentAccessToken = 0;

    /**
     * 授权者access token超时时间,单位为秒
     *
     * @var int
     */
    private $expireAuthorizerAccessToken = 0;
    /**
     * 授权者js ticket超时时间,单位为秒
     *
     * @var int
     */
    private $expireAuthorizerJsTicket = 0;
    /**
     * 开放平台微信号
     *
     * @var string
     */
    private $appId = '';
    /**
     * 开放平台随机密钥
     *
     * @var string
     */
    private $secret = '';
    /**
     * 开放平台消息校验token
     *
     * @var string
     */
    private $token = '';
    /**
     * 开放平台旧消息加解密key
     *
     * @var string
     */
    private $aesKeyBefore = '';
    /**
     * 开放平台新消息加解密key
     *
     * @var string
     */
    private $aesKeyNow = '';
    /**
     * 开放平台授权页面域名
     *
     * @var string
     */
    private $urlAuth = '';
    /**
     * 开放平台授权页面回跳地址
     *
     * @var string
     */
    private $urlAuthCallback = '';
    /**
     * 开放平台换绑小程序管理员回跳地址
     *
     * @var string
     */
    private $urlMiniRebindAdmin = '';
    /**
     * 开放平台快速注册小程序回跳地址
     *
     * @var string
     */
    private $urlMiniFastRegister = '';
    /**
     * 开放平台小程序服务域名列表
     *
     * @var array
     */
    private $domainMiniServers = [];
    /**
     * 开放平台小程序业务域名列表
     *
     * @var array
     */
    private $domainMiniWebViews = [];

    public function __construct()
    {
        //do nothing
    }

    private function __clone()
    {
        //do nothing
    }

    public function __toString()
    {
        return Tool::jsonEncode($this->getConfigs(), JSON_UNESCAPED_UNICODE);
    }

    public function getExpireComponentAccessToken(): int
    {
        return $this->expireComponentAccessToken;
    }

    /**
     * @throws \SyException\Wx\WxOpenException
     */
    public function setExpireComponentAccessToken(int $expireComponentAccessToken)
    {
        if (($expireComponentAccessToken > 0) && ($expireComponentAccessToken <= 7200)) {
            $this->expireComponentAccessToken = $expireComponentAccessToken;
        } else {
            throw new WxOpenException('开放平台access token超时时间不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    public function getExpireAuthorizerAccessToken(): int
    {
        return $this->expireAuthorizerAccessToken;
    }

    /**
     * @throws \SyException\Wx\WxOpenException
     */
    public function setExpireAuthorizerAccessToken(int $expireAuthorizerAccessToken)
    {
        if (($expireAuthorizerAccessToken > 0) && ($expireAuthorizerAccessToken <= 7200)) {
            $this->expireAuthorizerAccessToken = $expireAuthorizerAccessToken;
        } else {
            throw new WxOpenException('授权者access token超时时间不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    public function getExpireAuthorizerJsTicket(): int
    {
        return $this->expireAuthorizerJsTicket;
    }

    /**
     * @throws \SyException\Wx\WxOpenException
     */
    public function setExpireAuthorizerJsTicket(int $expireAuthorizerJsTicket)
    {
        if (($expireAuthorizerJsTicket > 0) && ($expireAuthorizerJsTicket <= 7200)) {
            $this->expireAuthorizerJsTicket = $expireAuthorizerJsTicket;
        } else {
            throw new WxOpenException('授权者js ticket超时时间不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    public function getAppId(): string
    {
        return $this->appId;
    }

    /**
     * @throws \SyException\Wx\WxOpenException
     */
    public function setAppId(string $appId)
    {
        if (ctype_alnum($appId) && (18 == \strlen($appId))) {
            $this->appId = $appId;
        } else {
            throw new WxOpenException('appid不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    public function getSecret(): string
    {
        return $this->secret;
    }

    /**
     * @throws \SyException\Wx\WxOpenException
     */
    public function setSecret(string $secret)
    {
        if (ctype_alnum($secret) && (32 == \strlen($secret))) {
            $this->secret = $secret;
        } else {
            throw new WxOpenException('secret不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @throws \SyException\Wx\WxOpenException
     */
    public function setToken(string $token)
    {
        if (ctype_alnum($token) && (\strlen($token) <= 32)) {
            $this->token = $token;
        } else {
            throw new WxOpenException('消息校验Token不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    public function getAesKeyBefore(): string
    {
        return $this->aesKeyBefore;
    }

    /**
     * @throws \SyException\Wx\WxOpenException
     */
    public function setAesKeyBefore(string $aesKeyBefore)
    {
        if (ctype_alnum($aesKeyBefore) && (43 == \strlen($aesKeyBefore))) {
            $this->aesKeyBefore = $aesKeyBefore;
        } else {
            throw new WxOpenException('旧消息加解密Key不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    public function getAesKeyNow(): string
    {
        return $this->aesKeyNow;
    }

    /**
     * @throws \SyException\Wx\WxOpenException
     */
    public function setAesKeyNow(string $aesKeyNow)
    {
        if (ctype_alnum($aesKeyNow) && (43 == \strlen($aesKeyNow))) {
            $this->aesKeyNow = $aesKeyNow;
        } else {
            throw new WxOpenException('新消息加解密Key不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    public function getUrlAuth(): string
    {
        return $this->urlAuth;
    }

    /**
     * @throws \SyException\Wx\WxOpenException
     */
    public function setUrlAuth(string $urlAuth)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $urlAuth) > 0) {
            $this->urlAuth = $urlAuth;
        } else {
            throw new WxOpenException('授权页面URL不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    public function getUrlAuthCallback(): string
    {
        return $this->urlAuthCallback;
    }

    /**
     * @throws \SyException\Wx\WxOpenException
     */
    public function setUrlAuthCallback(string $urlAuthCallback)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $urlAuthCallback) > 0) {
            $this->urlAuthCallback = $urlAuthCallback;
        } else {
            throw new WxOpenException('授权页面回跳URL不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    public function getUrlMiniRebindAdmin(): string
    {
        return $this->urlMiniRebindAdmin;
    }

    /**
     * @throws \SyException\Wx\WxOpenException
     */
    public function setUrlMiniRebindAdmin(string $urlMiniRebindAdmin)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $urlMiniRebindAdmin) > 0) {
            $this->urlMiniRebindAdmin = $urlMiniRebindAdmin;
        } else {
            throw new WxOpenException('换绑小程序管理员回跳URL不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    public function getUrlMiniFastRegister(): string
    {
        return $this->urlMiniFastRegister;
    }

    /**
     * @throws \SyException\Wx\WxOpenException
     */
    public function setUrlMiniFastRegister(string $urlMiniFastRegister)
    {
        if (0 == \strlen($urlMiniFastRegister)) {
            $this->urlMiniFastRegister = '';
        } elseif (preg_match(ProjectBase::REGEX_URL_HTTP, $urlMiniFastRegister) > 0) {
            $this->urlMiniFastRegister = $urlMiniFastRegister;
        } else {
            throw new WxOpenException('快速注册小程序回跳地址不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    public function getDomainMiniServers(): array
    {
        return $this->domainMiniServers;
    }

    public function setDomainMiniServers(array $domainMiniServers)
    {
        $this->domainMiniServers = $domainMiniServers;
    }

    public function getDomainMiniWebViews(): array
    {
        return $this->domainMiniWebViews;
    }

    public function setDomainMiniWebViews(array $domainMiniWebViews)
    {
        $this->domainMiniWebViews = $domainMiniWebViews;
    }

    public function getConfigs(): array
    {
        return [
            'appid' => $this->appId,
            'token' => $this->token,
            'secret' => $this->secret,
            'aeskey.now' => $this->aesKeyNow,
            'aeskey.before' => $this->aesKeyBefore,
            'url.auth' => $this->urlAuth,
            'url.authcallback' => $this->urlAuthCallback,
            'url.mini.rebindadmin' => $this->urlMiniRebindAdmin,
            'domain.mini.server' => $this->domainMiniServers,
            'domain.mini.webview' => $this->domainMiniWebViews,
            'expire.component.accesstoken' => $this->expireComponentAccessToken,
            'expire.authorizer.jsticket' => $this->expireAuthorizerJsTicket,
            'expire.authorizer.accesstoken' => $this->expireAuthorizerAccessToken,
        ];
    }
}
