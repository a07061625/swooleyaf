<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/21 0021
 * Time: 8:49
 */
namespace Traits;

use Constant\Project;
use DingDing\TalkConfigCorp;
use Factories\SyBaseMysqlFactory;
use Tool\Tool;

trait DingTalkConfigTrait
{
    /**
     * 企业钉钉配置列表
     * @var array
     */
    private $corpConfigs = [];
    /**
     * 企业钉钉配置清理时间戳
     * @var int
     */
    private $corpClearTime = 0;

    /**
     * 获取所有的企业钉钉配置
     * @return array
     */
    public function getCorpConfigs()
    {
        return $this->corpConfigs;
    }

    /**
     * 获取企业钉钉配置
     * @param string $corpId
     * @return \DingDing\TalkConfigCorp|null
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

        return $corpConfig->isValid() ? $corpConfig : null;
    }

    /**
     * 移除企业钉钉配置
     * @param string $corpId
     */
    public function removeCorpConfig(string $corpId)
    {
        unset($this->corpConfigs[$corpId]);
    }

    /**
     * 获取本地企业钉钉配置
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
     * 更新企业钉钉配置
     * @param string $corpId
     * @return \DingDing\TalkConfigCorp
     */
    private function refreshCorpConfig(string $corpId)
    {
        $expireTime = Tool::getNowTime() + Project::TIME_EXPIRE_LOCAL_DINGTALK_CORP_REFRESH;
        $corpConfig = new TalkConfigCorp();
        $corpConfig->setCorpId($corpId);
        $corpConfig->setExpireTime($expireTime);

        $dingTalkConfig = SyBaseMysqlFactory::DingtalkConfigCorpEntity();
        $ormResult1 = $dingTalkConfig->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`corp_id`=? AND `status`=?', [$corpId, Project::DINGTALK_CONFIG_CORP_STATUS_ENABLE]);
        $configInfo = $dingTalkConfig->getContainer()->getModel()->findOne($ormResult1);
        if (empty($configInfo)) {
            $corpConfig->setValid(false);
        } else {
            $agents = strlen($configInfo['corp_agents']) > 0 ? Tool::jsonDecode($configInfo['corp_agents']) : [];
            $corpConfig->setValid(true);
            $corpConfig->setSsoSecret((string)$configInfo['sso_secret']);
            $corpConfig->setAgents($agents);
        }
        unset($configInfo, $ormResult1, $dingTalkConfig);
        $this->corpConfigs[$corpId] = $corpConfig;

        return $corpConfig;
    }
}
