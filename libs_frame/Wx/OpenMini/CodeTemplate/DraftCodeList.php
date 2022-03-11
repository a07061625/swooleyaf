<?php
/**
 * 获取草稿箱内的所有临时代码草稿
 * User: 姜伟
 * Date: 18-9-12
 * Time: 下午11:44
 */

namespace Wx\OpenMini\CodeTemplate;

use DesignPatterns\Singletons\WxConfigSingleton;
use SyConstant\ErrorCode;
use SyTool\Tool;
use Wx\WxBaseOpenMini;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

class DraftCodeList extends WxBaseOpenMini
{
    public function __construct()
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/wxa/gettemplatedraftlist?access_token=';
    }

    public function __clone()
    {
        //do nothing
    }

    public function getDetail(): array
    {
        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilOpenBase::getComponentAccessToken(WxConfigSingleton::getInstance()->getOpenCommonConfig()->getAppId());
        $sendRes = WxUtilBase::sendGetReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (0 == $sendData['errcode']) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WXOPEN_GET_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
