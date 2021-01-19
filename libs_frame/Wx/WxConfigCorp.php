<?php
/**
 * 企业微信配置类
 * User: 姜伟
 * Date: 2017/6/13 0013
 * Time: 19:01
 */

namespace Wx;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Wx\WxException;
use SyTrait\SimpleConfigTrait;

class WxConfigCorp
{
    use SimpleConfigTrait;

    /**
     * 企业ID
     *
     * @var string
     */
    private $corpId = '';
    /**
     * 应用列表
     *
     * @var array
     */
    private $agents = [];
    /**
     * 客户端IP
     *
     * @var string
     */
    private $clientIp = '';
    /**
     * 商户号
     *
     * @var string
     */
    private $payMchId = '';

    /**
     * 商户支付密钥
     *
     * @var string
     */
    private $payKey = '';

    /**
     * 支付异步通知URL
     *
     * @var string
     */
    private $payNotifyUrl = '';

    /**
     * 支付授权URL
     *
     * @var string
     */
    private $payAuthUrl = '';

    /**
     * CERT PEM证书路径,保持和原文件相同
     *
     * @var string
     */
    private $sslCert = '';

    /**
     * KEY PEM证书路径,保持和原文件相同
     *
     * @var string
     */
    private $sslKey = '';
    /**
     * 登录授权地址
     *
     * @var string
     */
    private $urlAuthLogin = '';

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

    public function getAgents(): array
    {
        return $this->agents;
    }

    /**
     * @return array
     *               返回数据结构:
     *               id: 应用ID
     *               secret: 应用密钥
     */
    public function getAgentInfo(string $agentTag): array
    {
        return $this->agents[$agentTag] ?? [];
    }

    public function setAgents(array $agents)
    {
        $this->agents = $agents;
    }

    public function getClientIp(): string
    {
        return $this->clientIp;
    }

    /**
     * @throws \SyException\WX\WxException
     */
    public function setClientIp(string $clientIp)
    {
        if (preg_match(ProjectBase::REGEX_IP, '.' . $clientIp) > 0) {
            $this->clientIp = $clientIp;
        } else {
            throw new WxException('客户端IP不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getPayMchId(): string
    {
        return $this->payMchId;
    }

    /**
     * @throws \SyException\WX\WxException
     */
    public function setPayMchId(string $payMchId)
    {
        if (ctype_digit($payMchId)) {
            $this->payMchId = $payMchId;
        } else {
            throw new WxException('商户号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getPayKey(): string
    {
        return $this->payKey;
    }

    /**
     * @throws \SyException\WX\WxException
     */
    public function setPayKey(string $payKey)
    {
        if (ctype_alnum($payKey) && (32 == \strlen($payKey))) {
            $this->payKey = $payKey;
        } else {
            throw new WxException('支付密钥不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getPayNotifyUrl(): string
    {
        return $this->payNotifyUrl;
    }

    /**
     * @throws \SyException\WX\WxException
     */
    public function setPayNotifyUrl(string $payNotifyUrl)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $payNotifyUrl) > 0) {
            $this->payNotifyUrl = $payNotifyUrl;
        } else {
            throw new WxException('支付异步消息通知URL不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getPayAuthUrl(): string
    {
        return $this->payAuthUrl;
    }

    /**
     * @throws \SyException\WX\WxException
     */
    public function setPayAuthUrl(string $payAuthUrl)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $payAuthUrl) > 0) {
            $this->payAuthUrl = $payAuthUrl;
        } else {
            throw new WxException('支付授权URL不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getSslCert(): string
    {
        return $this->sslCert;
    }

    /**
     * @throws \SyException\WX\WxException
     */
    public function setSslCert(string $sslCert)
    {
        if (\strlen($sslCert) > 0) {
            $this->sslCert = $sslCert;
        } else {
            throw new WxException('cert证书不能为空', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getSslKey(): string
    {
        return $this->sslKey;
    }

    /**
     * @throws \SyException\WX\WxException
     */
    public function setSslKey(string $sslKey)
    {
        if (\strlen($sslKey) > 0) {
            $this->sslKey = $sslKey;
        } else {
            throw new WxException('key证书不能为空', ErrorCode::WX_PARAM_ERROR);
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
