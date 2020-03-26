<?php
namespace Wx\CorpProvider\Common;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use SyException\Wx\WxCorpProviderException;
use SyTool\Tool;
use Wx\WxBaseCorpProvider;
use Wx\WxUtilBase;
use Wx\WxUtilCorpProvider;

/**
 * 获取第三方应用凭证
 * @package Wx\CorpProvider\Common
 */
class SuiteAccessToken extends WxBaseCorpProvider
{
    /**
     * 套件id
     * @var string
     */
    private $suite_id = '';
    /**
     * 套件secret
     * @var string
     */
    private $suite_secret = '';
    /**
     * 套件票据
     * @var string
     */
    private $suite_ticket = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUrl = 'https://qyapi.weixin.qq.com/cgi-bin/service/get_suite_token';
        $providerConfig = WxConfigSingleton::getInstance()->getCorpProviderConfig();
        $this->reqData['suite_id'] = $providerConfig->getSuiteId();
        $this->reqData['suite_secret'] = $providerConfig->getSuiteSecret();
    }

    private function __clone()
    {
    }

    public function getDetail(): array
    {
        $this->reqData['suite_ticket'] = WxUtilCorpProvider::getSuiteTicket();
        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (!is_array($sendData)) {
            throw new WxCorpProviderException('获取第三方应用凭证出错', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        } elseif (!isset($sendData['suite_access_token'])) {
            throw new WxCorpProviderException($sendData['errmsg'], ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }

        return $sendData;
    }
}
