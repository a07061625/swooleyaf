<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/13 0013
 * Time: 9:37
 */
namespace Wx\Shop\Material;

use Constant\ErrorCode;
use Tool\Tool;
use Wx\WxBaseShop;
use Wx\WxUtilBase;
use Wx\WxUtilShop;

class MaterialCount extends WxBaseShop {
    /**
     * 公众号ID
     * @var string
     */
    private $appid = '';

    public function __construct(string $appId){
        parent::__construct();

        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/material/get_materialcount?access_token=';
        $this->appid = $appId;
    }

    private function __clone(){
    }

    public function getDetail() : array {
        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilShop::getAccessToken($this->appid);
        $sendRes = WxUtilBase::sendGetReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if(isset($sendData['errcode'])){
            $resArr['code'] = ErrorCode::WX_GET_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        } else {
            $resArr['data'] = $sendData;
        }

        return $resArr;
    }
}