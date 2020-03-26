<?php
/**
 * 钉钉配置单例类
 * User: 姜伟
 * Date: 2017/6/17 0017
 * Time: 11:18
 */
namespace DesignPatterns\Singletons;

use SyConstant\ErrorCode;
use SyConstant\Project;
use DingDing\TalkConfigProvider;
use SyException\DingDing\TalkException;
use SyTool\Tool;
use SyTrait\DingTalkConfigTrait;
use SyTrait\SingletonTrait;

class DingTalkConfigSingleton
{
    use SingletonTrait;
    use DingTalkConfigTrait;

    /**
     * 企业服务商公共配置
     * @var \DingDing\TalkConfigProvider
     */
    private $corpProviderConfig = null;
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
     * @return \DesignPatterns\Singletons\DingTalkConfigSingleton
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 获取企业服务商公共配置
     * @return \DingDing\TalkConfigProvider
     */
    public function getCorpProviderConfig()
    {
        if (is_null($this->corpProviderConfig)) {
            $configs = Tool::getConfig('dingtalk.' . SY_ENV . SY_PROJECT);
            $corpProviderConfig = new TalkConfigProvider();
            $corpProviderConfig->setCorpId((string)Tool::getArrayVal($configs, 'provider.corp.id', '', true));
            $corpProviderConfig->setSsoSecret((string)Tool::getArrayVal($configs, 'provider.sso.secret', '', true));
            $corpProviderConfig->setToken((string)Tool::getArrayVal($configs, 'provider.token', '', true));
            $corpProviderConfig->setAesKey((string)Tool::getArrayVal($configs, 'provider.aeskey', '', true));
            $corpProviderConfig->setSuiteId((int)Tool::getArrayVal($configs, 'provider.suite.id', 0, true));
            $corpProviderConfig->setSuiteKey((string)Tool::getArrayVal($configs, 'provider.suite.key', '', true));
            $corpProviderConfig->setSuiteSecret((string)Tool::getArrayVal($configs, 'provider.suite.secret', '', true));
            $corpProviderConfig->setLoginAppId((string)Tool::getArrayVal($configs, 'provider.login.app.id', '', true));
            $corpProviderConfig->setLoginAppSecret((string)Tool::getArrayVal($configs, 'provider.login.app.secret', '', true));
            $corpProviderConfig->setLoginUrlCallback((string)Tool::getArrayVal($configs, 'provider.login.url.callback', '', true));
            $this->corpProviderConfig = $corpProviderConfig;
        }

        return $this->corpProviderConfig;
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
     * @return \DingDing\TalkConfigCorp|null
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

            $this->corpClearTime = $nowTime + Project::TIME_EXPIRE_LOCAL_DINGTALK_CORP_CLEAR;
        }

        return Tool::getArrayVal($this->corpConfigs, $corpId, null);
    }

    /**
     * 获取企业配置
     * @param string $corpId
     * @return \DingDing\TalkConfigCorp
     * @throws \SyException\DingDing\TalkException
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
            throw new TalkException('企业配置不存在', ErrorCode::DING_TALK_PARAM_ERROR);
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
