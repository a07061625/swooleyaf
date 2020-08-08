<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/21 0021
 * Time: 8:49
 */
namespace SyTrait;

use DingDing\TalkConfigCorp;
use Factories\SyBaseMysqlFactory;
use SyConstant\Project;
use SyTool\Tool;

trait DingTalkConfigTrait
{
    /**
     * 更新企业钉钉配置
     *
     * @param string $corpId
     *
     * @return \DingDing\TalkConfigCorp
     */
    private function refreshCorpConfig(string $corpId)
    {
        $expireTime = Tool::getNowTime() + Project::TIME_EXPIRE_LOCAL_DINGTALK_CORP_REFRESH;
        $corpConfig = new TalkConfigCorp();
        $corpConfig->setCorpId($corpId);
        $corpConfig->setExpireTime($expireTime);

        $dingTalkConfig = SyBaseMysqlFactory::getDingtalkConfigCorpEntity();
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
        $this->corpConfigs[$corpId] = $corpConfig;

        return $corpConfig;
    }
}
