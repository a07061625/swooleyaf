<?php
namespace Wx\CorpProvider\Common;

use SyConstant\ErrorCode;
use SyException\Wx\WxCorpProviderException;
use SyTool\Tool;
use Wx\WxBaseCorpProvider;
use Wx\WxUtilBase;
use Wx\WxUtilCorpProvider;

/**
 * 设置授权配置
 * @package Wx\CorpProvider\Common
 */
class SessionInfoSet extends WxBaseCorpProvider
{
    /**
     * 预授权码
     * @var string
     */
    private $pre_auth_code = '';
    /**
     * 授权类型,默认值为0 0:正式授权 1:测试授权
     * @var int
     */
    private $auth_type = 0;

    public function __construct()
    {
        parent::__construct();
        $this->serviceUrl = 'https://qyapi.weixin.qq.com/cgi-bin/service/set_session_info?suite_access_token=';
        $this->reqData['session_info'] = [
            'auth_type' => 0,
        ];
    }

    private function __clone()
    {
    }

    /**
     * @param string $preAuthCode
     * @throws \SyException\Wx\WxCorpProviderException
     */
    public function setPreAuthCode(string $preAuthCode)
    {
        if (strlen($preAuthCode) > 0) {
            $this->reqData['pre_auth_code'] = $preAuthCode;
        } else {
            throw new WxCorpProviderException('预授权码不合法', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }
    }

    /**
     * @param int $authType
     * @throws \SyException\Wx\WxCorpProviderException
     */
    public function setAuthType(int $authType)
    {
        if (in_array($authType, [0, 1], true)) {
            $this->reqData['session_info']['auth_type'] = $authType;
        } else {
            throw new WxCorpProviderException('授权类型不合法', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['pre_auth_code'])) {
            throw new WxCorpProviderException('预授权码不能为空', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . '?' . WxUtilCorpProvider::getSuiteToken();
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if ($sendData['errcode'] == 0) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WXPROVIDER_CORP_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
