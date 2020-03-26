<?php
namespace Wx\CorpProvider\Common;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use SyException\Wx\WxCorpProviderException;
use SyTool\Tool;
use Wx\WxBaseCorpProvider;
use Wx\WxUtilBase;

/**
 * 获取服务商凭证
 * @package Wx\CorpProvider\Common
 */
class ProviderToken extends WxBaseCorpProvider
{
    public function __construct()
    {
        parent::__construct();
        $this->serviceUrl = 'https://qyapi.weixin.qq.com/cgi-bin/service/get_provider_token';
        $providerConfig = WxConfigSingleton::getInstance()->getCorpProviderConfig();
        $this->reqData['corpid'] = $providerConfig->getCorpId();
        $this->reqData['provider_secret'] = $providerConfig->getCorpSecret();
    }

    private function __clone()
    {
    }

    public function getDetail(): array
    {
        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (!is_array($sendData)) {
            throw new WxCorpProviderException('获取服务商凭证出错', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        } elseif (!isset($sendData['provider_access_token'])) {
            throw new WxCorpProviderException($sendData['errmsg'], ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }

        return $sendData;
    }
}
