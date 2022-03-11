<?php

namespace Wx\CorpProvider\Common;

use SyConstant\ErrorCode;
use SyException\Wx\WxCorpProviderException;
use SyTool\Tool;
use Wx\WxBaseCorpProvider;
use Wx\WxUtilBase;
use Wx\WxUtilCorpProvider;

/**
 * 获取企业授权信息
 *
 * @package Wx\CorpProvider\Common
 */
class AuthInfoGet extends WxBaseCorpProvider
{
    /**
     * 授权企业ID
     *
     * @var string
     */
    private $auth_corpid = '';
    /**
     * 永久授权码
     *
     * @var string
     */
    private $permanent_code = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUrl = 'https://qyapi.weixin.qq.com/cgi-bin/service/get_auth_info?suite_access_token=';
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxCorpProviderException
     */
    public function setAuthCorpId(string $authCorpId)
    {
        if (ctype_alnum($authCorpId)) {
            $this->reqData['auth_corpid'] = $authCorpId;
        } else {
            throw new WxCorpProviderException('授权企业ID不合法', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxCorpProviderException
     */
    public function setPermanentCode(string $permanentCode)
    {
        if (\strlen($permanentCode) > 0) {
            $this->reqData['permanent_code'] = $permanentCode;
        } else {
            throw new WxCorpProviderException('永久授权码不合法', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['auth_corpid'])) {
            throw new WxCorpProviderException('授权企业ID不能为空', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }
        if (!isset($this->reqData['permanent_code'])) {
            throw new WxCorpProviderException('永久授权码不能为空', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . '?' . WxUtilCorpProvider::getSuiteToken();
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (0 == $sendData['errcode']) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WXPROVIDER_CORP_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
