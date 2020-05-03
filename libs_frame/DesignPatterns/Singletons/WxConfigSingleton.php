<?php
/**
 * 微信配置单例类
 * User: 姜伟
 * Date: 2017/6/17 0017
 * Time: 11:18
 */
namespace DesignPatterns\Singletons;

use SyConstant\ErrorCode;
use SyConstant\Project;
use SyException\Wx\WxCorpProviderException;
use SyException\Wx\WxException;
use SyTool\Tool;
use SyTrait\SingletonTrait;
use SyTrait\WxConfigTrait;
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
    /**
     * 账号配置列表
     * @var array
     */
    private $accountConfigs = [];
    /**
     * 账号配置清理时间戳
     * @var int
     */
    private $accountClearTime = 0;
    /**
     * 企业配置列表
     * @var array
     */
    private $corpConfigs = [];
    /**
     * 企业配置清理时间戳
     * @var int
     */
    private $corpClearTime = 0;

    private function __construct()
    {
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
        if (is_null($this->openCommonConfig)) {
            $configs = Tool::getConfig('wx.' . SY_ENV . SY_PROJECT);
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
        }

        return $this->openCommonConfig;
    }

    /**
     * 获取企业服务商公共配置
     * @return \Wx\WxConfigCorpProvider
     */
    public function getCorpProviderConfig()
    {
        if (is_null($this->corpProviderConfig)) {
            $configs = Tool::getConfig('wx.' . SY_ENV . SY_PROJECT);
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

        return $this->corpProviderConfig;
    }

    /**
     * 获取所有的账号配置
     * @return array
     */
    public function getAccountConfigs()
    {
        return $this->accountConfigs;
    }

    /**
     * 获取本地账号配置
     * @param string $appId
     * @return \Wx\WxConfigAccount|null
     */
    private function getLocalAccountConfig(string $appId)
    {
        $nowTime = Tool::getNowTime();
        if ($this->accountClearTime < $nowTime) {
            $delIds = [];
            foreach ($this->accountConfigs as $eAppId => $accountConfig) {
                if ($accountConfig->getExpireTime() < $nowTime) {
                    $delIds[] = $eAppId;
                }
            }
            foreach ($delIds as $eAppId) {
                unset($this->accountConfigs[$eAppId]);
            }

            $this->accountClearTime = $nowTime + Project::TIME_EXPIRE_LOCAL_WXACCOUNT_CLEAR;
        }

        return Tool::getArrayVal($this->accountConfigs, $appId, null);
    }

    /**
     * 获取账号配置
     * @param string $appId
     * @return \Wx\WxConfigAccount
     * @throws \SyException\Wx\WxException
     */
    public function getAccountConfig(string $appId)
    {
        $nowTime = Tool::getNowTime();
        $accountConfig = $this->getLocalAccountConfig($appId);
        if (is_null($accountConfig)) {
            $accountConfig = $this->refreshAccountConfig($appId);
        } elseif ($accountConfig->getExpireTime() < $nowTime) {
            $accountConfig = $this->refreshAccountConfig($appId);
        }

        if ($accountConfig->isValid()) {
            return $accountConfig;
        } else {
            throw new WxException('账号配置不存在', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * 移除账号配置
     * @param string $appId
     */
    public function removeAccountConfig(string $appId)
    {
        unset($this->accountConfigs[$appId]);
    }

    /**
     * 获取所有的企业配置
     * @return array
     */
    public function getCorpConfigs()
    {
        return $this->corpConfigs;
    }

    /**
     * 获取本地企业配置
     * @param string $corpId
     * @return \Wx\WxConfigCorp|null
     */
    private function getLocalCorpConfig(string $corpId)
    {
        $nowTime = Tool::getNowTime();
        if ($this->corpClearTime < $nowTime) {
            $delIds = [];
            foreach ($this->corpConfigs as $eCorpId => $corpConfig) {
                if ($corpConfig->getExpireTime() < $nowTime) {
                    $delIds[] = $eCorpId;
                }
            }
            foreach ($delIds as $eCorpId) {
                unset($this->corpConfigs[$eCorpId]);
            }

            $this->corpClearTime = $nowTime + Project::TIME_EXPIRE_LOCAL_WXCORP_CLEAR;
        }

        return Tool::getArrayVal($this->corpConfigs, $corpId, null);
    }

    /**
     * 获取企业配置
     * @param string $corpId
     * @return \Wx\WxConfigCorp
     * @throws \SyException\Wx\WxCorpProviderException
     */
    public function getCorpConfig(string $corpId)
    {
        $nowTime = Tool::getNowTime();
        $corpConfig = $this->getLocalCorpConfig($corpId);
        if (is_null($corpConfig)) {
            $corpConfig = $this->refreshCorpConfig($corpId);
        } elseif ($corpConfig->getExpireTime() < $nowTime) {
            $corpConfig = $this->refreshCorpConfig($corpId);
        }

        if ($corpConfig->isValid()) {
            return $corpConfig;
        } else {
            throw new WxCorpProviderException('企业配置不存在', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }
    }

    /**
     * 移除企业配置
     * @param string $corpId
     */
    public function removeCorpConfig(string $corpId)
    {
        unset($this->corpConfigs[$corpId]);
    }
}
