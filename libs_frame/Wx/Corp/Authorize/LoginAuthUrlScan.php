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
 * 获取扫码登录授权引导地址
 * @package Wx\Corp\Authorize
 */
class LoginAuthUrlScan extends WxBaseCorp
{
    /**
     * 企业ID
     * @var string
     */
    private $appid = '';
    /**
     * 应用ID
     * @var string
     */
    private $agentid = '';
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

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $corpConfig = WxConfigSingleton::getInstance()->getCorpConfig($corpId);
        $agentInfo = $corpConfig->getAgentInfo($agentTag);
        $this->reqData['appid'] = $corpConfig->getCorpId();
        $this->reqData['agentid'] = $agentInfo['id'];
        $this->reqData['redirect_uri'] = $corpConfig->getUrlAuthLogin();
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
            'url' => 'https://open.work.weixin.qq.com/wwopen/sso/qrConnect?' . http_build_query($this->reqData),
        ];
    }
}
