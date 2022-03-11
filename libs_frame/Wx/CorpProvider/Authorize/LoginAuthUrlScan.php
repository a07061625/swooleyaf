<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/22 0022
 * Time: 18:55
 */

namespace Wx\CorpProvider\Authorize;

use DesignPatterns\Singletons\WxConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Wx\WxCorpProviderException;
use SyTool\Tool;
use Wx\WxBaseCorpProvider;

/**
 * 获取扫码登录授权引导地址
 *
 * @package Wx\CorpProvider\Authorize
 */
class LoginAuthUrlScan extends WxBaseCorpProvider
{
    /**
     * 服务商企业ID
     *
     * @var string
     */
    private $appid = '';
    /**
     * 授权回调地址
     *
     * @var string
     */
    private $redirect_uri = '';
    /**
     * 防跨域攻击标识
     *
     * @var string
     */
    private $state = '';
    /**
     * 登录类型 admin:管理员登录(使用微信扫码) member:成员登录(使用企业微信扫码),默认为admin
     *
     * @var string
     */
    private $usertype = '';

    public function __construct()
    {
        parent::__construct();
        $providerConfig = WxConfigSingleton::getInstance()->getCorpProviderConfig();
        $this->reqData['appid'] = $providerConfig->getCorpId();
        $this->reqData['redirect_uri'] = $providerConfig->getUrlAuthLogin();
        $this->reqData['state'] = Tool::createNonceStr(8);
        $this->reqData['usertype'] = 'admin';
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxCorpProviderException
     */
    public function setState(string $state)
    {
        if (ctype_alnum($state) && (\strlen($state) <= 128)) {
            $this->reqData['state'] = $state;
        } else {
            throw new WxCorpProviderException('防跨域攻击标识不合法', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxCorpProviderException
     */
    public function setUserType(string $userType)
    {
        if (\in_array($userType, ['admin', 'member'], true)) {
            $this->reqData['usertype'] = $userType;
        } else {
            throw new WxCorpProviderException('登录类型不合法', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        return [
            'url' => 'https://open.work.weixin.qq.com/wwopen/sso/3rd_qrConnect?' . http_build_query($this->reqData),
        ];
    }
}
