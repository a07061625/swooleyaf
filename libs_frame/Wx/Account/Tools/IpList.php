<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-12
 * Time: 上午1:44
 */

namespace Wx\Account\Tools;

use SyConstant\ErrorCode;
use SyTool\Tool;
use Wx\WxBaseAccount;
use Wx\WxUtilAlone;
use Wx\WxUtilBase;

class IpList extends WxBaseAccount
{
    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token=';
        $this->reqData['appid'] = $appId;
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

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilAlone::getAccessToken($this->reqData['appid']);
        $sendRes = WxUtilBase::sendGetReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (isset($sendData['ip_list'])) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WX_GET_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
