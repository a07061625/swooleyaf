<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/13 0013
 * Time: 9:37
 */
namespace Wx\Shop\Material;

use Constant\ErrorCode;
use Exception\Wx\WxException;
use Tool\Tool;
use Wx\WxBaseShop;
use Wx\WxUtilBase;
use Wx\WxUtilShop;

class MaterialPermanentDelete extends WxBaseShop {
    /**
     * 公众号ID
     * @var string
     */
    private $appid = '';
    /**
     * 媒体文件ID
     * @var string
     */
    private $media_id = '';

    public function __construct(string $appId){
        parent::__construct();

        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/material/del_material?access_token=';
        $this->appid = $appId;
    }

    private function __clone(){
    }

    /**
     * @param string $mediaId
     * @throws \Exception\Wx\WxException
     */
    public function setMediaId(string $mediaId){
        if(strlen($mediaId) > 0){
            $this->reqData['media_id'] = $mediaId;
        } else {
            throw new WxException('媒体文件ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array {
        if(!isset($this->reqData['media_id'])){
            throw new WxException('媒体文件ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilShop::getAccessToken($this->appid);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if($sendData['errcode'] == 0){
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}