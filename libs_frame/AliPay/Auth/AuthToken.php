<?php
/**
 * 换取应用授权令牌
 * User: 姜伟
 * Date: 2018/11/1 0001
 * Time: 10:13
 */
namespace AliPay\Auth;

use AliPay\AliPayBase;
use SyConstant\ErrorCode;
use SyException\AliPay\AliPayAuthException;

class AuthToken extends AliPayBase
{
    /**
     * 准许类型
     * @var string
     */
    private $grant_type = '';
    /**
     * 授权码
     * @var string
     */
    private $code = '';
    /**
     * 刷新令牌
     * @var string
     */
    private $refresh_token = '';

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setMethod('alipay.open.auth.token.app');
    }

    private function __clone()
    {
    }

    /**
     * @param string $grantType
     * @throws \SyException\AliPay\AliPayAuthException
     */
    public function setGrantType(string $grantType)
    {
        if (in_array($grantType, ['authorization_code', 'refresh_token',], true)) {
            $this->biz_content['grant_type'] = $grantType;
        } else {
            throw new AliPayAuthException('准许类型不合法', ErrorCode::ALIPAY_AUTH_PARAM_ERROR);
        }
    }

    /**
     * @param string $code
     * @throws \SyException\AliPay\AliPayAuthException
     */
    public function setCode(string $code)
    {
        if (ctype_alnum($code) && (strlen($code) <= 40)) {
            $this->biz_content['code'] = $code;
            unset($this->biz_content['refresh_token']);
        } else {
            throw new AliPayAuthException('授权码不合法', ErrorCode::ALIPAY_AUTH_PARAM_ERROR);
        }
    }

    /**
     * @param string $refreshToken
     * @throws \SyException\AliPay\AliPayAuthException
     */
    public function setRefreshToken(string $refreshToken)
    {
        if (ctype_alnum($refreshToken) && (strlen($refreshToken) <= 40)) {
            $this->biz_content['refresh_token'] = $refreshToken;
            unset($this->biz_content['code']);
        } else {
            throw new AliPayAuthException('刷新令牌不合法', ErrorCode::ALIPAY_AUTH_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->biz_content['grant_type'])) {
            throw new AliPayAuthException('准许类型不能为空', ErrorCode::ALIPAY_AUTH_PARAM_ERROR);
        }
        if (($this->biz_content['grant_type'] == 'authorization_code') && !isset($this->biz_content['code'])) {
            throw new AliPayAuthException('授权码不能为空', ErrorCode::ALIPAY_AUTH_PARAM_ERROR);
        } elseif (($this->biz_content['grant_type'] == 'refresh_token') && !isset($this->biz_content['refresh_token'])) {
            throw new AliPayAuthException('刷新令牌不能为空', ErrorCode::ALIPAY_AUTH_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
