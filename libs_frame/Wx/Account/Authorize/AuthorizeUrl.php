<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/12 0012
 * Time: 15:09
 */

namespace Wx\Account\Authorize;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Wx\WxException;
use Wx\WxBaseAccount;

class AuthorizeUrl extends WxBaseAccount
{
    const AUTH_TYPE_BASE = 'base'; //授权类型-静默授权
    const AUTH_TYPE_USER = 'userinfo'; //授权类型-手动授权

    /**
     * 重定向链接
     *
     * @var string
     */
    private $redirectUrl = '';
    /**
     * 授权类型
     *
     * @var string
     */
    private $authType = '';
    /**
     * 防csrf攻击标识
     *
     * @var string
     */
    private $state = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://open.weixin.qq.com/connect/oauth2/authorize';
        $this->reqData['appid'] = $appId;
        $this->reqData['response_type'] = 'code';
        $this->reqData['state'] = 'STATE';
    }

    public function __clone()
    {
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setRedirectUrl(string $redirectUrl)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $redirectUrl) > 0) {
            $this->reqData['redirect_uri'] = $redirectUrl;
        } else {
            throw new WxException('重定向链接不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setAuthType(string $authType)
    {
        if (self::AUTH_TYPE_BASE == $authType) {
            $this->reqData['scope'] = 'snsapi_base';
        } elseif (self::AUTH_TYPE_USER == $authType) {
            $this->reqData['scope'] = 'snsapi_userinfo';
        } else {
            throw new WxException('授权类型不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setState(string $state)
    {
        if (ctype_alnum($state) && (\strlen($state) <= 32)) {
            $this->reqData['state'] = $state;
        } else {
            throw new WxException('防csrf攻击标识不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['scope'])) {
            throw new WxException('授权类型不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['redirect_uri'])) {
            throw new WxException('重定向链接不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        ksort($this->reqData);

        return [
            'url' => $this->serviceUrl . '?' . http_build_query($this->reqData) . '#wechat_redirect',
        ];
    }
}
