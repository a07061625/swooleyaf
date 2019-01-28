<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-1-28
 * Time: 上午11:15
 */
namespace DingDing\Corp\User;

use Constant\ErrorCode;
use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use DingDing\TalkUtilBase;
use Exception\DingDing\TalkException;
use Tool\Tool;

/**
 * 获取用户id
 * @package DingDing\Corp\User
 */
class UserInfoGet extends TalkBaseCorp {
    use TalkTraitCorp;

    /**
     * 授权码
     * @var string
     */
    private $code = '';

    public function __construct(string $corpId,string $agentTag){
        parent::__construct();
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
    }

    private function __clone(){
    }

    /**
     * @param string $code
     * @throws \Exception\DingDing\TalkException
     */
    public function setCode(string $code){
        if(ctype_alnum($code)){
            $this->reqData['code'] = $code;
        } else {
            throw new TalkException('授权码不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array {
        if(!isset($this->reqData['code'])){
            throw new TalkException('授权码不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->reqData['access_token'] = $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/user/getuserinfo?' . http_build_query($this->reqData);
        $sendRes = TalkUtilBase::sendGetReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if($sendData['errcode'] == 0){
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::DING_TALK_GET_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}