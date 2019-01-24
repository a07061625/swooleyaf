<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/13 0013
 * Time: 8:58
 */
namespace Wx\OpenMini;

use Constant\ErrorCode;
use Exception\Wx\WxOpenException;
use Tool\Tool;
use Wx\WxBaseOpenMini;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

class Plugin extends WxBaseOpenMini {
    /**
     * 应用ID
     * @var string
     */
    private $appId = '';
    /**
     * 数据
     * @var array
     */
    private $data = [];

    public function __construct(string $appId){
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/wxa/plugin?access_token=';
        $this->appId = $appId;
    }

    public function __clone(){
    }

    /**
     * @param string $action 操作类型
     * @param string $pluginAppId 插件appid
     * @throws \Exception\Wx\WxOpenException
     */
    public function setData(string $action,string $pluginAppId=''){
        if(!in_array($action, ['apply', 'list', 'unbind'])){
            throw new WxOpenException('操作类型不支持', ErrorCode::WXOPEN_PARAM_ERROR);
        } else if($action != 'list'){
            if(strlen($pluginAppId) == 0){
                throw new WxOpenException('插件appid不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
            }

            $this->data = [
                'action' => $action,
                'plugin_appid' => $pluginAppId,
            ];
        } else {
            $this->data = [
                'action' => $action,
            ];
        }
    }

    public function getDetail() : array {
        if(empty($this->data)){
            throw new WxOpenException('数据不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilOpenBase::getAuthorizerAccessToken($this->appId);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->data, JSON_UNESCAPED_UNICODE);
        $this->curlConfigs[CURLOPT_SSL_VERIFYPEER] = false;
        $this->curlConfigs[CURLOPT_SSL_VERIFYHOST] = false;
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if($sendData['errcode'] == 0){
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WXOPEN_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}