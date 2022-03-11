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

/**
 * 网站应用授权地址
 *
 * @package Wx\Account\Authorize
 */
class WebAuthorizeUrl extends WxBaseAccount
{
    /**
     * 重定向链接
     *
     * @var string
     */
    private $redirectUrl = '';
    /**
     * 防csrf攻击标识
     *
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
        //do nothing
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
        if (!isset($this->reqData['redirect_uri'])) {
            throw new WxException('重定向链接不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        return [
            'url' => $this->serviceUrl . '?' . http_build_query($this->reqData) . '#wechat_redirect',
        ];
    }
}
