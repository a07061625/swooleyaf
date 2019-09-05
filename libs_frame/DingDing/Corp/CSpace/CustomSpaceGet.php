<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-9
 * Time: 下午5:13
 */
namespace DingDing\Corp\CSpace;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\DingTalkConfigSingleton;
use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use SyException\DingDing\TalkException;

/**
 * 获取企业下的自定义空间
 * @package DingDing\Corp\CSpace
 */
class CustomSpaceGet extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 应用ID
     * @var string
     */
    private $agent_id = '';
    /**
     * 域名
     * @var string
     */
    private $domain = '';

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
    }

    private function __clone()
    {
    }

    public function setAgentId()
    {
        $agentInfo = DingTalkConfigSingleton::getInstance()->getCorpConfig($this->_corpId)->getAgentInfo($this->_agentTag);
        $this->reqData['agent_id'] = $agentInfo['id'];
        unset($this->reqData['domain']);
    }

    /**
     * @param string $domain
     * @throws \SyException\DingDing\TalkException
     */
    public function setDomain(string $domain)
    {
        if (ctype_alnum($domain) && (strlen($domain) <= 10)) {
            $this->reqData['domain'] = $domain;
            unset($this->reqData['agent_id']);
        } else {
            throw new TalkException('域名不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (isset($this->reqData['agent_id'])) {
            $this->reqData['access_token'] = $this->getAccessToken(TalkBaseCorp::ACCESS_TOKEN_TYPE_PROVIDER, $this->_corpId, $this->_agentTag);
        } elseif (isset($this->reqData['domain'])) {
            $this->reqData['access_token'] = $this->getAccessToken(TalkBaseCorp::ACCESS_TOKEN_TYPE_CORP, $this->_corpId, $this->_agentTag);
        } else {
            throw new TalkException('域名和应用ID不能同时为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/cspace/get_custom_space?' . http_build_query($this->reqData);
        return $this->sendRequest('GET');
    }
}
