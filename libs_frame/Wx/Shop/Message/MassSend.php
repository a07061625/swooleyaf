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

class MassSend extends WxBaseShop {
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
     * 用户openid列表
     * @var array
     */
    private $touser = [];

    public function __construct(string $appId){
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token=';
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

        if($type == self::MESSAGE_TYPE_MPNEWS){
            $ignoreReprint = isset($data['send_ignore_reprint']) && is_numeric($data['send_ignore_reprint']) ? (int)$data['send_ignore_reprint'] : 0;
            if(!in_array($ignoreReprint, [0, 1])){
                throw new WxException('转载群发标识不合法', ErrorCode::WX_PARAM_ERROR);
            }

            $this->reqData['send_ignore_reprint'] = $ignoreReprint;
        }

        $this->reqData['msgtype'] = $type;
        $this->reqData[$type] = $data['data'];
    }

    /**
     * @param array $openidList
     */
    public function setOpenidList(array $openidList){
        foreach ($openidList as $eOpenid) {
            if(is_string($eOpenid) && (preg_match('/^[0-9a-zA-Z\-\_]{28}$/', $eOpenid) > 0)){
                $this->touser[$eOpenid] = 1;
            }
        }
    }

    /**
     * @param string $openid
     * @throws \Exception\Wx\WxException
     */
    public function addOpenid(string $openid){
        if (preg_match('/^[0-9a-zA-Z\-\_]{28}$/', $openid) > 0) {
            $this->touser[$openid] = 1;
        } else {
            throw new WxException('用户openid不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array {
        if(!isset($this->reqData['msgtype'])){
            throw new WxException('消息类型不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        $openidNum = count($this->touser);
        if($openidNum < 2){
            throw new WxException('用户openid列表不能少于2个', ErrorCode::WX_PARAM_ERROR);
        } else if($openidNum > 10000){
            throw new WxException('用户openid列表不能超过10000个', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['touser'] = array_keys($this->touser);

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