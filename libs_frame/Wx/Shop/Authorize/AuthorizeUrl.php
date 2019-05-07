<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/12 0012
 * Time: 15:09
 */
namespace Wx\Shop\Authorize;

use Constant\ErrorCode;
use Exception\Wx\WxException;
use Wx\WxBaseShop;

class AuthorizeUrl extends WxBaseShop
{
    const AUTH_TYPE_BASE = 'base'; //授权类型-静默授权
    const AUTH_TYPE_USER = 'userinfo'; //授权类型-手动授权

    /**
     * 重定向链接
     * @var string
     */
    private $redirectUrl = '';
    /**
     * 授权类型
     * @var string
     */
    private $authType = '';
    /**
     * 防csrf攻击标识
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
     * @param string $redirectUrl
     * @throws \Exception\Wx\WxException
     */
    public function setRedirectUrl(string $redirectUrl)
    {
        if (preg_match('/^(http|https)\:\/\/\S+$/', $redirectUrl) > 0) {
            $this->reqData['redirect_uri'] = $redirectUrl;
        } else {
            throw new WxException('重定向链接不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $authType
     * @throws \Exception\Wx\WxException
     */
    public function setAuthType(string $authType)
    {
        if ($authType == self::AUTH_TYPE_BASE) {
            $this->reqData['scope'] = 'snsapi_base';
        } elseif ($authType == self::AUTH_TYPE_USER) {
            $this->reqData['scope'] = 'snsapi_userinfo';
        } else {
            throw new WxException('授权类型不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $state
     * @throws \Exception\Wx\WxException
     */
    public function setState(string $state)
    {
        if (ctype_alnum($state) && (strlen($state) <= 32)) {
            $this->reqData['state'] = $state;
        } else {
            throw new WxException('防csrf攻击标识不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array
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
