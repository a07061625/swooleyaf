<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-1-27
 * Time: 上午10:15
 */
namespace DingDing\CorpProvider\Common;

use Constant\ErrorCode;
use DesignPatterns\Singletons\DingTalkConfigSingleton;
use DingDing\TalkBaseCorpProvider;
use DingDing\TalkUtilBase;
use DingDing\TalkUtilProvider;
use Exception\DingDing\TalkException;
use Tool\Tool;

/**
 * 获取授权企业的应用信息
 * @package DingDing\CorpProvider\Common
 */
class AgentGet extends TalkBaseCorpProvider {
    /**
     * 套件key
     * @var string
     */
    private $suite_key = '';
    /**
     * 授权企业ID
     * @var string
     */
    private $auth_corpid = '';
    /**
     * 用id
     * @var int
     */
    private $agentid = 0;

    public function __construct(string $corpId,string $agentTag){
        parent::__construct();
        $agentInfo = DingTalkConfigSingleton::getInstance()->getCorpConfig($corpId)->getAgentInfo($agentTag);
        $this->reqData['auth_corpid'] = $corpId;
        $this->reqData['agentid'] = $agentInfo['id'];
    }

    private function __clone(){
    }

    public function getDetail() : array {
        $resArr = [
            'code' => 0,
        ];

        $providerConfig = DingTalkConfigSingleton::getInstance()->getCorpProviderConfig();
        $timestamp = (string)Tool::getNowTime();
        $suiteTicket = TalkUtilProvider::getSuiteTicket();
        $this->reqData['suite_key'] = $providerConfig->getSuiteKey();
        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/service/get_agent?' . http_build_query([
            'timestamp' => $timestamp,
            'accessKey' => $providerConfig->getSuiteKey(),
            'suiteTicket' => $suiteTicket,
            'signature' => TalkUtilBase::createApiSign($timestamp . PHP_EOL . $suiteTicket, $providerConfig->getSuiteSecret()),
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = TalkUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if($sendData['errcode'] == 0){
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::DING_TALK_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}