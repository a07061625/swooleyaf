<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/20 0020
 * Time: 10:42
 */
namespace Wx\Account\CustomService;

use SyConstant\ErrorCode;
use SyTool\Tool;
use Wx\WxBaseAccount;
use Wx\WxUtilBase;
use Wx\WxUtilAlone;

class InfoListOnline extends WxBaseAccount
{
    /**
     * 公众号ID
     * @var string
     */
    private $appid = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/customservice/getonlinekflist?access_token=';
        $this->appid = $appId;
    }

    private function __clone()
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
        if (isset($sendData['kf_online_list'])) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WX_GET_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
