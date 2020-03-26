<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-1-28
 * Time: 下午3:40
 */
namespace DingDing\Corp\Sns;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\DingTalkConfigSingleton;
use DingDing\TalkBaseCorp;
use DingDing\TalkUtilBase;
use SyException\DingDing\TalkException;
use SyTool\Tool;

/**
 * 获取开放应用的令牌
 * @package DingDing\Corp\Sns
 */
class TokenGet extends TalkBaseCorp
{
    public function __construct(string $corpId)
    {
        parent::__construct();
        if (strlen($corpId) > 0) {
            $corpConfig = DingTalkConfigSingleton::getInstance()->getCorpConfig($corpId);
            $this->reqData['appid'] = $corpConfig->getLoginAppId();
            $this->reqData['appsecret'] = $corpConfig->getLoginAppSecret();
        } else {
            $providerConfig = DingTalkConfigSingleton::getInstance()->getCorpProviderConfig();
            $this->reqData['appid'] = $providerConfig->getLoginAppId();
            $this->reqData['appsecret'] = $providerConfig->getLoginAppSecret();
        }
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/sns/gettoken?' . http_build_query($this->reqData);
        $sendRes = TalkUtilBase::sendGetReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (!is_array($sendData)) {
            throw new TalkException('获取开放应用令牌出错', ErrorCode::DING_TALK_GET_ERROR);
        } elseif (!isset($sendData['access_token'])) {
            throw new TalkException($sendData['errmsg'], ErrorCode::DING_TALK_GET_ERROR);
        }

        return $sendData;
    }
}
