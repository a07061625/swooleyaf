<?php
/**
 * 微信配置单例类
 * User: 姜伟
 * Date: 2017/6/17 0017
 * Time: 11:18
 */
namespace DesignPatterns\Singletons;

use Tool\Tool;
use Traits\SingletonTrait;
use Traits\WxConfigTrait;
use Wx\WxConfigCorpProvider;
use Wx\WxConfigOpenCommon;

class WxConfigSingleton
{
    use SingletonTrait;
    use WxConfigTrait;

    /**
     * 开放平台公共配置
     * @var \Wx\WxConfigOpenCommon
     */
    private $openCommonConfig = null;
    /**
     * 企业服务商公共配置
     * @var \Wx\WxConfigCorpProvider
     */
    private $corpProviderConfig = null;

    private function __construct()
    {
        $configs = Tool::getConfig('wx.' . SY_ENV . SY_PROJECT);

        //初始化开放平台公共配置
        $openCommonConfig = new WxConfigOpenCommon();
        $openCommonConfig->setExpireComponentAccessToken((int)Tool::getArrayVal($configs, 'open.expire.component.accesstoken', 0, true));
        $openCommonConfig->setExpireAuthorizerJsTicket((int)Tool::getArrayVal($configs, 'open.expire.authorizer.jsticket', 0, true));
        $openCommonConfig->setExpireAuthorizerAccessToken((int)Tool::getArrayVal($configs, 'open.expire.authorizer.accesstoken', 0, true));
        $openCommonConfig->setAppId((string)Tool::getArrayVal($configs, 'open.appid', '', true));
        $openCommonConfig->setSecret((string)Tool::getArrayVal($configs, 'open.secret', '', true));
        $openCommonConfig->setToken((string)Tool::getArrayVal($configs, 'open.token', '', true));
        $openCommonConfig->setAesKeyBefore((string)Tool::getArrayVal($configs, 'open.aeskey.before', '', true));
        $openCommonConfig->setAesKeyNow((string)Tool::getArrayVal($configs, 'open.aeskey.now', '', true));
        $openCommonConfig->setUrlAuth((string)Tool::getArrayVal($configs, 'open.url.auth', '', true));
        $openCommonConfig->setUrlAuthCallback((string)Tool::getArrayVal($configs, 'open.url.authcallback', '', true));
        $openCommonConfig->setUrlMiniRebindAdmin((string)Tool::getArrayVal($configs, 'open.url.mini.rebindadmin', '', true));
        $openCommonConfig->setUrlMiniFastRegister((string)Tool::getArrayVal($configs, 'open.url.mini.fastregister', '', true));
        $openCommonConfig->setDomainMiniServers((array)Tool::getArrayVal($configs, 'open.domain.mini.server', [], true));
        $openCommonConfig->setDomainMiniWebViews((array)Tool::getArrayVal($configs, 'open.domain.mini.webview', [], true));
        $this->openCommonConfig = $openCommonConfig;

        //初始化企业服务商公共配置
        $corpProviderConfig = new WxConfigCorpProvider();
        $corpProviderConfig->setCorpId((string)Tool::getArrayVal($configs, 'provider.corp.id', '', true));
        $corpProviderConfig->setCorpSecret((string)Tool::getArrayVal($configs, 'provider.corp.secret', '', true));
        $corpProviderConfig->setToken((string)Tool::getArrayVal($configs, 'provider.token', '', true));
        $corpProviderConfig->setAesKey((string)Tool::getArrayVal($configs, 'provider.aeskey', '', true));
        $corpProviderConfig->setSuiteId((string)Tool::getArrayVal($configs, 'provider.suite.id', '', true));
        $corpProviderConfig->setSuiteSecret((string)Tool::getArrayVal($configs, 'provider.suite.secret', '', true));
        $corpProviderConfig->setUrlAuthSuite((string)Tool::getArrayVal($configs, 'provider.url.auth.suite', '', true));
        $corpProviderConfig->setUrlAuthLogin((string)Tool::getArrayVal($configs, 'provider.url.auth.login', '', true));
        $this->corpProviderConfig = $corpProviderConfig;
    }

    private function __clone()
    {
    }

    /**
     * @return \DesignPatterns\Singletons\WxConfigSingleton
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 获取开放平台公共配置
     * @return \Wx\WxConfigOpenCommon
     */
    public function getOpenCommonConfig()
    {
        return $this->openCommonConfig;
    }

    /**
     * 获取企业服务商公共配置
     * @return \Wx\WxConfigCorpProvider
     */
    public function getCorpProviderConfig()
    {
        return $this->corpProviderConfig;
    }
}
