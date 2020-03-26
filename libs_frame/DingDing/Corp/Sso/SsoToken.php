<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-1-27
 * Time: 下午1:34
 */
namespace DingDing\Corp\Sso;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\DingTalkConfigSingleton;
use DingDing\TalkBaseCorp;
use DingDing\TalkUtilBase;
use SyException\DingDing\TalkException;
use SyTool\Tool;

/**
 * 获取免登令牌
 * @package DingDing\Corp\Sso
 */
class SsoToken extends TalkBaseCorp
{
    public function __construct(string $corpId)
    {
        parent::__construct();
        if (strlen($corpId) > 0) {
            $corpConfig = DingTalkConfigSingleton::getInstance()->getCorpConfig($corpId);
            $this->reqData['corpid'] = $corpConfig->getCorpId();
            $this->reqData['corpsecret'] = $corpConfig->getSsoSecret();
        } else {
            $providerConfig = DingTalkConfigSingleton::getInstance()->getCorpProviderConfig();
            $this->reqData['corpid'] = $providerConfig->getCorpId();
            $this->reqData['corpsecret'] = $providerConfig->getSsoSecret();
        }
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/sso/gettoken?' . http_build_query($this->reqData);
        $sendRes = TalkUtilBase::sendGetReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (!is_array($sendData)) {
            throw new TalkException('获取sso token出错', ErrorCode::DING_TALK_GET_ERROR);
        } elseif (!isset($sendData['access_token'])) {
            throw new TalkException($sendData['errmsg'], ErrorCode::DING_TALK_GET_ERROR);
        }

        return $sendData;
    }
}
