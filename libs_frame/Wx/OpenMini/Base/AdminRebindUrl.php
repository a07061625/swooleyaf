<?php
/**
 * 管理员换绑链接
 * User: 姜伟
 * Date: 18-9-13
 * Time: 上午12:45
 */
namespace Wx\OpenMini\Base;

use DesignPatterns\Singletons\WxConfigSingleton;
use Wx\WxBaseOpenMini;

class AdminRebindUrl extends WxBaseOpenMini
{
    /**
     * 应用ID
     * @var string
     */
    private $appId = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://mp.weixin.qq.com/wxopen/componentrebindadmin';
        $this->appId = $appId;
    }

    public function __clone()
    {
    }

    public function getDetail() : array
    {
        $openCommonConfig = WxConfigSingleton::getInstance()->getOpenCommonConfig();
        return [
            'url' => $this->serviceUrl . '?' . http_build_query([
                'appid' => $this->appId,
                'component_appid' => $openCommonConfig->getAppId(),
                'redirect_uri' => $openCommonConfig->getUrlMiniRebindAdmin(),
            ]),
        ];
    }
}
