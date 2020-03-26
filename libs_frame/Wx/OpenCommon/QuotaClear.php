<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/11 0011
 * Time: 17:32
 */
namespace Wx\OpenCommon;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use SyTool\Tool;
use Wx\WxBaseOpenCommon;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

/**
 * 调用接口次数清零
 * @package Wx\OpenCommon
 */
class QuotaClear extends WxBaseOpenCommon
{
    /**
     * 第三方平台APPID
     * @var string
     */
    private $component_appid = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/component/clear_quota?component_access_token=';
        $this->reqData['component_appid'] = WxConfigSingleton::getInstance()->getOpenCommonConfig()->getAppId();
    }

    public function __clone()
    {
    }

    public function getDetail() : array
    {
        $resArr = [
            'code' => 0
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilOpenBase::getComponentAccessToken($this->reqData['component_appid']);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if ($sendData['errcode'] == 0) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WXOPEN_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
