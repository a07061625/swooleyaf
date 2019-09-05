<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/12 0012
 * Time: 15:09
 */
namespace Wx\Shop\Authorize;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use Wx\WxBaseShop;

/**
 * 网站应用授权地址
 * @package Wx\Shop\Authorize
 */
class WebAuthorizeUrl extends WxBaseShop
{
    /**
     * 重定向链接
     * @var string
     */
    private $redirectUrl = '';
    /**
     * 防csrf攻击标识
     * @var string
     */
    private $state = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://open.weixin.qq.com/connect/qrconnect';
        $this->reqData['appid'] = $appId;
        $this->reqData['response_type'] = 'code';
        $this->reqData['scope'] = 'snsapi_login';
        $this->reqData['state'] = 'STATE';
    }

    public function __clone()
    {
    }

    /**
     * @param string $redirectUrl
     * @throws \SyException\Wx\WxException
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
     * @param string $state
     * @throws \SyException\Wx\WxException
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
        if (!isset($this->reqData['redirect_uri'])) {
            throw new WxException('重定向链接不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        return [
            'url' => $this->serviceUrl . '?' . http_build_query($this->reqData) . '#wechat_redirect',
        ];
    }
}
