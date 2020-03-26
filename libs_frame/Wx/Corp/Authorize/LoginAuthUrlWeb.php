<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/22 0022
 * Time: 18:55
 */
namespace Wx\Corp\Authorize;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseCorp;

/**
 * 获取网页登录授权引导地址
 * @package Wx\Corp\Authorize
 */
class LoginAuthUrlWeb extends WxBaseCorp
{
    /**
     * 企业ID
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
     * @var string
     */
    private $scope = '';
    /**
     * 防跨域攻击标识
     * @var string
     */
    private $state = '';

    public function __construct(string $corpId)
    {
        parent::__construct();
        $corpConfig = WxConfigSingleton::getInstance()->getCorpConfig($corpId);
        $this->reqData['appid'] = $corpConfig->getCorpId();
        $this->reqData['redirect_uri'] = $corpConfig->getUrlAuthLogin();
        $this->reqData['response_type'] = 'code';
        $this->reqData['scope'] = 'snsapi_base';
        $this->reqData['state'] = Tool::createNonceStr(8);
    }

    private function __clone()
    {
    }

    /**
     * @param string $state
     * @throws \SyException\Wx\WxException
     */
    public function setState(string $state)
    {
        if (ctype_alnum($state) && (strlen($state) <= 128)) {
            $this->reqData['state'] = $state;
        } else {
            throw new WxException('防跨域攻击标识不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        return [
            'url' => 'https://open.weixin.qq.com/connect/oauth2/authorize?' . http_build_query($this->reqData) . '#wechat_redirect',
        ];
    }
}
