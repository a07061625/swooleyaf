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
 * 获取套件授权引导地址
 * @package Wx\CorpProvider\Authorize
 */
class SuiteAuthUrl extends WxBaseCorpProvider
{
    /**
     * 套件ID
     * @var string
     */
    private $suite_id = '';
    /**
     * 预授权码
     * @var string
     */
    private $pre_auth_code = '';
    /**
     * 授权回调地址
     * @var string
     */
    private $redirect_uri = '';
    /**
     * 防跨域攻击标识
     * @var string
     */
    private $state = '';

    public function __construct()
    {
        parent::__construct();
        $providerConfig = WxConfigSingleton::getInstance()->getCorpProviderConfig();
        $this->reqData['suite_id'] = $providerConfig->getSuiteId();
        $this->reqData['redirect_uri'] = $providerConfig->getUrlAuthSuite();
        $this->reqData['state'] = Tool::createNonceStr(8);
    }

    private function __clone()
    {
    }

    /**
     * @param string $preAuthCode
     * @throws \SyException\Wx\WxCorpProviderException
     */
    public function setPreAuthCode(string $preAuthCode)
    {
        if (strlen($preAuthCode) > 0) {
            $this->reqData['pre_auth_code'] = $preAuthCode;
        } else {
            throw new WxCorpProviderException('预授权码不合法', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
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
        if (!isset($this->reqData['pre_auth_code'])) {
            throw new WxCorpProviderException('预授权码不能为空', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }

        return [
            'url' => 'https://open.work.weixin.qq.com/3rdapp/install?' . http_build_query($this->reqData),
        ];
    }
}
