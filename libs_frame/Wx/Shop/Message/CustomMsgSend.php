<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-12
 * Time: 下午11:14
 */
namespace Wx\Shop\Message;

use Constant\ErrorCode;
use Exception\Wx\WxException;
use Tool\Tool;
use Wx\WxBaseShop;
use Wx\WxUtilBase;
use Wx\WxUtilBaseAlone;
use Wx\WxUtilOpenBase;

class CustomMsgSend extends WxBaseShop {
    /**
     * 应用ID
     * @var string
     */
    private $appId = '';
    /**
     * 令牌
     * @var string
     */
    private $accessToken = '';
    /**
     * 消息数据
     * @var array
     */
    private $msgData = [];
    /**
     * 平台类型
     * @var string
     */
    private $platType = '';

    public function __construct(string $appId){
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=';
        $this->platType = WxUtilBase::PLAT_TYPE_SHOP;
        $this->appId = $appId;
    }

    public function __clone(){
    }

    /**
     * @param string $accessToken
     * @throws \Exception\Wx\WxException
     */
    public function setAccessToken(string $accessToken) {
        if(strlen($accessToken) > 0){
            $this->accessToken = $accessToken;
        } else {
            throw new WxException('令牌不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param array $msgData
     * @throws \Exception\Wx\WxException
     */
    public function setMsgData(array $msgData){
        if(empty($msgData)){
            throw new WxException('消息数据不合法', ErrorCode::WX_PARAM_ERROR);
        }

        $this->msgData = $msgData;
    }

    /**
     * @param string $platType
     * @throws \Exception\Wx\WxException
     */
    public function setPlatType(string $platType) {
        if(in_array($platType, [WxUtilBase::PLAT_TYPE_SHOP, WxUtilBase::PLAT_TYPE_OPEN_SHOP])){
            $this->platType = $platType;
        } else {
            throw new WxException('平台类型不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array {
        if(empty($this->msgData)){
            throw new WxException('消息数据不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        if(strlen($this->accessToken) > 0){
            $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . $this->accessToken;
        } else if($this->platType == WxUtilBase::PLAT_TYPE_SHOP){
            $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilBaseAlone::getAccessToken($this->appId);
        } else {
            $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilOpenBase::getAuthorizerAccessToken($this->appId);
        }
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->msgData, JSON_UNESCAPED_UNICODE);
        $this->curlConfigs[CURLOPT_HTTPHEADER] = [
            'Expect:',
        ];
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