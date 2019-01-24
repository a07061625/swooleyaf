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

class MassPreview extends WxBaseShop {
    /**
     * 公众号ID
     * @var string
     */
    private $appid = '';
    /**
     * 消息类型
     * @var string
     */
    private $msgtype = '';
    /**
     * 用户openid
     * @var string
     */
    private $touser = '';
    /**
     * 公众号名称
     * @var string
     */
    private $towxname = '';

    public function __construct(string $appId){
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/message/mass/preview?access_token=';
        $this->appid = $appId;
    }

    private function __clone(){
    }

    /**
     * @param string $type
     * @param array $data
     * @throws \Exception\Wx\WxException
     */
    public function setMsgData(string $type,array $data){
        if(!isset(self::$totalMessageType[$type])){
            throw new WxException('消息类型不支持', ErrorCode::WX_PARAM_ERROR);
        } else if(!isset($data['data'])){
            throw new WxException('消息数据必须设置', ErrorCode::WX_PARAM_ERROR);
        } else if(!is_array($data['data'])){
            throw new WxException('消息数据不合法', ErrorCode::WX_PARAM_ERROR);
        } else if(empty($data['data'])){
            throw new WxException('消息数据不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['msgtype'] = $type;
        $this->reqData[$type] = $data['data'];
    }

    /**
     * @param string $openid
     * @throws \Exception\Wx\WxException
     */
    public function setOpenid(string $openid){
        if (preg_match('/^[0-9a-zA-Z\-\_]{28}$/', $openid) > 0) {
            $this->reqData['touser'] = $openid;
        } else {
            throw new WxException('用户openid不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $wxName
     * @throws \Exception\Wx\WxException
     */
    public function setWxName(string $wxName){
        if(strlen($wxName) > 0){
            $this->reqData['towxname'] = $wxName;
        } else {
            throw new WxException('公众号名称不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array {
        if(!isset($this->reqData['msgtype'])){
            throw new WxException('消息类型不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if((!isset($this->reqData['touser'])) && !isset($this->reqData['towxname'])){
            throw new WxException('用户openid和公众号名称不能都为空', ErrorCode::WX_PARAM_ERROR);
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