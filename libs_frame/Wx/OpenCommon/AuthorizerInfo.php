<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-12
 * Time: 下午10:02
 */
namespace Wx\OpenCommon;

use SyConstant\ErrorCode;
use SyException\Wx\WxOpenException;
use SyTool\Tool;
use Wx\WxBaseOpenCommon;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

class AuthorizerInfo extends WxBaseOpenCommon
{
    /**
     * 授权码
     * @var string
     */
    private $authCode = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/component/api_query_auth?component_access_token=';
        $this->reqData['component_appid'] = $appId;
    }

    public function __clone()
    {
    }

    /**
     * @param string $authCode
     * @throws \SyException\Wx\WxOpenException
     */
    public function setAuthCode(string $authCode)
    {
        if (strlen($authCode) > 0) {
            $this->reqData['authorization_code'] = $authCode;
        } else {
            throw new WxOpenException('授权码不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['authorization_code'])) {
            throw new WxOpenException('授权码不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilOpenBase::getComponentAccessToken($this->reqData['component_appid']);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (isset($sendData['authorization_info'])) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WXOPEN_POST_ERROR;
            $resArr['message'] = '授权失败,请重新授权';
        }

        return $resArr;
    }
}
