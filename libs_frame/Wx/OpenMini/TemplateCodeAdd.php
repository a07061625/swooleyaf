<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-12
 * Time: 下午11:59
 */
namespace Wx\OpenMini;

use Constant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use Exception\Wx\WxOpenException;
use Tool\Tool;
use Wx\WxBaseOpenMini;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

class TemplateCodeAdd extends WxBaseOpenMini {
    /**
     * 草稿ID
     * @var string
     */
    private $draftId = '';

    public function __construct(){
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/wxa/addtotemplate?access_token=';
    }

    public function __clone(){
    }

    /**
     * @param string $draftId
     * @throws \Exception\Wx\WxOpenException
     */
    public function setDraftId(string $draftId){
        if(strlen($draftId) > 0){
            $this->reqData['draft_id'] = $draftId;
        } else {
            throw new WxOpenException('草稿ID不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    public function getDetail() : array {
        if(!isset($this->reqData['draft_id'])){
            throw new WxOpenException('草稿ID不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilOpenBase::getComponentAccessToken(WxConfigSingleton::getInstance()->getOpenCommonConfig()->getAppId());
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
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