<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/13 0013
 * Time: 15:12
 */
namespace Wx\Shop\User;

use Constant\ErrorCode;
use Exception\Wx\WxException;
use Tool\Tool;
use Wx\WxBaseShop;
use Wx\WxUtilBase;
use Wx\WxUtilShop;

class UserGetTag extends WxBaseShop {
    /**
     * 公众号ID
     * @var string
     */
    private $appid = '';
    /**
     * 标签ID
     * @var int
     */
    private $tagid = 0;
    /**
     * 第一个用户openid
     * @var string
     */
    private $next_openid = '';

    public function __construct(string $appId){
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/user/tag/get?access_token=';
        $this->appid = $appId;
        $this->reqData['next_openid'] = '';
    }

    private function __clone(){
    }

    /**
     * @param int $tagId
     * @throws \Exception\Wx\WxException
     */
    public function setTagId(int $tagId){
        if($tagId > 0){
            $this->reqData['tagid'] = $tagId;
        } else {
            throw new WxException('标签ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $nextOpenid
     * @throws \Exception\Wx\WxException
     */
    public function setNextOpenid(string $nextOpenid){
        if (preg_match('/^[0-9a-zA-Z\-\_]{28}$/', $nextOpenid) > 0) {
            $this->reqData['next_openid'] = $nextOpenid;
        } else {
            throw new WxException('用户openid不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array {
        if(!isset($this->reqData['tagid'])){
            throw new WxException('标签ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilShop::getAccessToken($this->appid);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if(isset($sendData['errcode'])){
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        } else {
            $resArr['data'] = $sendData;
        }

        return $resArr;
    }
}