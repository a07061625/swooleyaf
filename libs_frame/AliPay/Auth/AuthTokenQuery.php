<?php
/**
 * 查询某个应用授权AppAuthToken的授权信息
 * User: 姜伟
 * Date: 2018/11/1 0001
 * Time: 10:08
 */
namespace AliPay\Auth;

use AliPay\AliPayBase;
use SyConstant\ErrorCode;
use SyException\AliPay\AliPayAuthException;

class AuthTokenQuery extends AliPayBase
{
    /**
     * 应用授权令牌
     * @var string
     */
    private $app_auth_token = '';

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setMethod('alipay.open.auth.token.app.query');
    }

    private function __clone()
    {
    }

    /**
     * @param string $appAuthToken
     * @throws \SyException\AliPay\AliPayAuthException
     */
    public function setAppAuthToken(string $appAuthToken)
    {
        if (ctype_alnum($appAuthToken) && (strlen($appAuthToken) <= 128)) {
            $this->biz_content['app_auth_token'] = $appAuthToken;
        } else {
            throw new AliPayAuthException('应用授权令牌不合法', ErrorCode::ALIPAY_AUTH_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->biz_content['app_auth_token'])) {
            throw new AliPayAuthException('应用授权令牌不能为空', ErrorCode::ALIPAY_AUTH_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
