<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/12 0012
 * Time: 15:49
 */
namespace Wx\Account\Menu;

use SyConstant\ErrorCode;
use SyTool\Tool;
use Wx\WxBaseAccount;
use Wx\WxUtilBase;
use Wx\WxUtilAlone;

class SelfInfoGet extends WxBaseAccount
{
    /**
     * 公众号ID
     * @var string
     */
    private $appid = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/get_current_selfmenu_info?access_token=';
        $this->appid = $appId;
    }

    public function __clone()
    {
    }

    public function getDetail() : array
    {
        $resArr = [
            'code' => 0
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilAlone::getAccessToken($this->appid);
        $sendRes = WxUtilBase::sendGetReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (isset($sendData['selfmenu_info'])) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WX_GET_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
