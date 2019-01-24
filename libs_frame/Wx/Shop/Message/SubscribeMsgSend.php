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

class SubscribeMsgSend extends WxBaseShop {
    /**
     * 公众号ID
     * @var string
     */
    private $appid = '';
    /**
     * 用户openid
     * @var string
     */
    private $touser = '';
    /**
     * 模版ID
     * @var string
     */
    private $template_id = '';
    /**
     * 重定向地址
     * @var string
     */
    private $url = '';
    /**
     * 小程序跳转数据
     * @var array
     */
    private $miniprogram = [];
    /**
     * 订阅场景值
     * @var int
     */
    private $scene = 0;
    /**
     * 消息标题
     * @var string
     */
    private $title = '';
    /**
     * 消息内容
     * @var array
     */
    private $data = [];

    public function __construct(string $appId){
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/message/template/subscribe?access_token=';
        $this->appid = $appId;
    }

    private function __clone(){
    }

    /**
     * @param string $openid
     * @throws \Exception\Wx\WxException
     */
    public function setOpenid(string $openid) {
        if (preg_match('/^[0-9a-zA-Z\-\_]{28}$/', $openid) > 0) {
            $this->reqData['touser'] = $openid;
        } else {
            throw new WxException('用户openid不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $templateId
     * @throws \Exception\Wx\WxException
     */
    public function setTemplateId(string $templateId) {
        if (strlen($templateId) > 0) {
            $this->reqData['template_id'] = $templateId;
        } else {
            throw new WxException('模版ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $url
     * @throws \Exception\Wx\WxException
     */
    public function setUrl(string $url) {
        if (preg_match('/^(http|https)\:\/\/\S+$/', $url) > 0) {
            $this->reqData['url'] = $url;
        } else {
            throw new WxException('重定向地址不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param array $miniProgram
     * @throws \Exception\Wx\WxException
     */
    public function setMiniProgram(array $miniProgram){
        if(empty($miniProgram)){
            throw new WxException('小程序跳转数据不合法', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['miniprogram'] = $miniProgram;
    }

    /**
     * @param int $scene
     * @throws \Exception\Wx\WxException
     */
    public function setScene(int $scene){
        if(($scene >= 0) && ($scene <= 10000)){
            $this->reqData['scene'] = (string)$scene;
        } else {
            throw new WxException('订阅场景值不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $title
     * @throws \Exception\Wx\WxException
     */
    public function setTitle(string $title){
        $titleLength = mb_strlen($title);
        if(($titleLength > 0) && ($titleLength <= 15)){
            $this->reqData['title'] = $title;
        } else {
            throw new WxException('消息标题不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param array $data
     * @throws \Exception\Wx\WxException
     */
    public function setData(array $data){
        $content = isset($data['value']) && is_string($data['value']) ? $data['value'] : '';
        $contentLength = mb_strlen($content);
        if($contentLength == 0){
            throw new WxException('消息内容不能为空', ErrorCode::WX_PARAM_ERROR);
        } else if($contentLength > 200){
            throw new WxException('消息内容不能超过200个字', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['data'] = [
            'content' => [
                'value' => $content,
                'color' => isset($data['color']) && is_string($data['color']) ? $data['color'] : '',
            ],
        ];
    }

    public function getDetail() : array {
        if(!isset($this->reqData['touser'])){
            throw new WxException('用户openid不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if(!isset($this->reqData['template_id'])){
            throw new WxException('模版ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if(!isset($this->reqData['scene'])){
            throw new WxException('订阅场景值不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if(!isset($this->reqData['title'])){
            throw new WxException('消息标题不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if(!isset($this->reqData['data'])){
            throw new WxException('消息内容不能为空', ErrorCode::WX_PARAM_ERROR);
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