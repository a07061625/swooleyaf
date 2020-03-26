<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/11 0011
 * Time: 9:48
 */
namespace DingDing\Corp\Common;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\DingTalkConfigSingleton;
use DingDing\TalkBaseCorp;
use DingDing\TalkUtilBase;
use SyException\DingDing\TalkException;
use SyTool\Tool;

/**
 * 获取企业凭证
 * @package DingDing\Corp\Common
 */
class AccessToken extends TalkBaseCorp
{
    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $agentInfo = DingTalkConfigSingleton::getInstance()->getCorpConfig($corpId)->getAgentInfo($agentTag);
        $this->reqData['appkey'] = $agentInfo['key'];
        $this->reqData['appsecret'] = $agentInfo['secret'];
    }

    public function __clone()
    {
    }

    public function getDetail() : array
    {
        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/gettoken?' . http_build_query($this->reqData);
        $sendRes = TalkUtilBase::sendGetReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (!is_array($sendData)) {
            throw new TalkException('获取access token出错', ErrorCode::DING_TALK_GET_ERROR);
        } elseif (!isset($sendData['access_token'])) {
            throw new TalkException($sendData['errmsg'], ErrorCode::DING_TALK_GET_ERROR);
        }

        return $sendData;
    }
}
