<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/12 0012
 * Time: 15:49
 */
namespace Wx\Shop\Menu;

use SyConstant\ErrorCode;
use Tool\Tool;
use Wx\WxBaseShop;
use Wx\WxUtilBase;
use Wx\WxUtilBaseAlone;

class MenuSelfInfo extends WxBaseShop
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

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilBaseAlone::getAccessToken($this->appid);
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
