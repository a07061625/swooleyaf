<?php

namespace Wx\CorpProvider\Authorize;

use SyConstant\ErrorCode;
use SyException\Wx\WxCorpProviderException;
use SyTool\Tool;
use Wx\WxBaseCorpProvider;
use Wx\WxUtilBase;
use Wx\WxUtilCorpProvider;

/**
 * 获取登录用户信息
 *
 * @package Wx\CorpProvider\Authorize
 */
class LoginInfoGet extends WxBaseCorpProvider
{
    /**
     * 授权码
     *
     * @var string
     */
    private $auth_code = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUrl = 'https://qyapi.weixin.qq.com/cgi-bin/service/get_login_info?access_token=';
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxCorpProviderException
     */
    public function setAuthCode(string $authCode)
    {
        if (\strlen($authCode) > 0) {
            $this->reqData['auth_code'] = $authCode;
        } else {
            throw new WxCorpProviderException('授权码不合法', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['auth_code'])) {
            throw new WxCorpProviderException('授权码不能为空', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . '?' . WxUtilCorpProvider::getProviderToken();
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
