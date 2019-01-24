<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/22 0022
 * Time: 11:05
 */
namespace Wx\Shop\Message;

use Constant\ErrorCode;
use Exception\Wx\WxException;
use Tool\Tool;
use Wx\WxBaseShop;
use Wx\WxUtilBase;
use Wx\WxUtilShop;

class TemplateIndustrySet extends WxBaseShop {
    /**
     * 公众号ID
     * @var string
     */
    private $appid = '';
    /**
     * 行业编号1
     * @var int
     */
    private $industry_id1 = 0;
    /**
     * 行业编号2
     * @var int
     */
    private $industry_id2 = 0;

    public function __construct(string $appId){
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/template/api_set_industry?access_token=';
        $this->appid = $appId;
    }

    private function __clone(){
    }

    /**
     * @param int $industryId1
     * @throws \Exception\Wx\WxException
     */
    public function setIndustryId1(int $industryId1){
        if($industryId1 > 0){
            $this->reqData['industry_id1'] = $industryId1;
        } else {
            throw new WxException('行业编号1不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param int $industryId2
     * @throws \Exception\Wx\WxException
     */
    public function setIndustryId2(int $industryId2){
        if($industryId2 > 0){
            $this->reqData['industry_id2'] = $industryId2;
        } else {
            throw new WxException('行业编号2不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array {
        if(!isset($this->reqData['industry_id1'])){
            throw new WxException('行业编号1不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if(!isset($this->reqData['industry_id2'])){
            throw new WxException('行业编号2不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilShop::getAccessToken($this->appid);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
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