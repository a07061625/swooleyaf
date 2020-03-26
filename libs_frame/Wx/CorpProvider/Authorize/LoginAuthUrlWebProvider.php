<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/22 0022
 * Time: 18:55
 */
namespace Wx\CorpProvider\Authorize;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use SyException\Wx\WxCorpProviderException;
use SyTool\Tool;
use Wx\WxBaseCorpProvider;

/**
 * 获取网页登录服务商授权引导地址
 * @package Wx\CorpProvider\Authorize
 */
class LoginAuthUrlWebProvider extends WxBaseCorpProvider
{
    /**
     * 套件ID
     * @var string
     */
    private $appid = '';
    /**
     * 授权回调地址
     * @var string
     */
    private $redirect_uri = '';
    /**
     * 返回类型
     * @var string
     */
    private $response_type = '';
    /**
     * 授权作用域
     *   snsapi_base:静默授权,可获取成员的基础信息(UserId与DeviceId)
     *   snsapi_userinfo:静默授权,可获取成员的详细信息,但不包含手机、邮箱等敏感信息
     *   snsapi_privateinfo:手动授权,可获取成员的详细信息,包含手机、邮箱等敏感信息
     * @var string
     */
    private $scope = '';
    /**
     * 防跨域攻击标识
     * @var string
     */
    private $state = '';

    public function __construct()
    {
        parent::__construct();
        $providerConfig = WxConfigSingleton::getInstance()->getCorpProviderConfig();
        $this->reqData['appid'] = $providerConfig->getSuiteId();
        $this->reqData['redirect_uri'] = $providerConfig->getUrlAuthLogin();
        $this->reqData['response_type'] = 'code';
        $this->reqData['state'] = Tool::createNonceStr(8);
    }

    private function __clone()
    {
    }

    /**
     * @param string $scope
     * @throws \SyException\Wx\WxCorpProviderException
     */
    public function setScope(string $scope)
    {
        if (in_array($scope, ['snsapi_base', 'snsapi_userinfo', 'snsapi_privateinfo'], true)) {
            $this->reqData['scope'] = $scope;
        } else {
            throw new WxCorpProviderException('授权作用域不合法', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }
    }

    /**
     * @param string $state
     * @throws \SyException\Wx\WxCorpProviderException
     */
    public function setState(string $state)
    {
        if (ctype_alnum($state) && (strlen($state) <= 128)) {
            $this->reqData['state'] = $state;
        } else {
            throw new WxCorpProviderException('防跨域攻击标识不合法', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['scope'])) {
            throw new WxCorpProviderException('授权作用域不能为空', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }

        return [
            'url' => 'https://open.weixin.qq.com/connect/oauth2/authorize?' . http_build_query($this->reqData) . '#wechat_redirect',
        ];
    }
}
