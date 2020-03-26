<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-1-27
 * Time: 上午10:15
 */
namespace DingDing\CorpProvider\Common;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\DingTalkConfigSingleton;
use DingDing\TalkBaseCorpProvider;
use DingDing\TalkUtilBase;
use DingDing\TalkUtilProvider;
use SyException\DingDing\TalkException;
use SyTool\Tool;

/**
 * 获取授权企业基本信息
 * @package DingDing\CorpProvider\Common
 */
class AuthInfoGet extends TalkBaseCorpProvider
{
    /**
     * 授权企业ID
     * @var string
     */
    private $auth_corpid = '';

    public function __construct()
    {
        parent::__construct();
    }

    private function __clone()
    {
    }

    /**
     * @param string $authCorpId
     * @throws \SyException\DingDing\TalkException
     */
    public function setAuthCorpId(string $authCorpId)
    {
        if (ctype_alnum($authCorpId)) {
            $this->reqData['auth_corpid'] = $authCorpId;
        } else {
            throw new TalkException('授权企业ID不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['auth_corpid'])) {
            throw new TalkException('授权企业ID不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $providerConfig = DingTalkConfigSingleton::getInstance()->getCorpProviderConfig();
        $timestamp = (string)Tool::getNowTime();
        $suiteTicket = TalkUtilProvider::getSuiteTicket();
        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/service/get_auth_info?' . http_build_query([
            'timestamp' => $timestamp,
            'accessKey' => $providerConfig->getSuiteKey(),
            'suiteTicket' => $suiteTicket,
            'signature' => TalkUtilBase::createApiSign($timestamp . PHP_EOL . $suiteTicket, $providerConfig->getSuiteSecret()),
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        return $this->sendRequest('POST');
    }
}
