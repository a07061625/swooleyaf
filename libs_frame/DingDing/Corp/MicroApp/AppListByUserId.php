<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-1-31
 * Time: 下午3:51
 */
namespace DingDing\Corp\MicroApp;

use Constant\ErrorCode;
use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use DingDing\TalkUtilBase;
use Exception\DingDing\TalkException;
use Tool\Tool;

/**
 * 获取员工可见的应用列表
 * @package DingDing\Corp\MicroApp
 */
class AppList extends TalkBaseCorp {
    use TalkTraitCorp;

    /**
     * 用户ID
     * @var string
     */
    private $userid = '';

    public function __construct(string $corpId,string $agentTag){
        parent::__construct();
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
    }

    private function __clone(){
    }

    /**
     * @param string $userId
     * @throws \Exception\DingDing\TalkException
     */
    public function setUserId(string $userId){
        if(ctype_alnum($userId)){
            $this->reqData['userid'] = $userId;
        } else {
            throw new TalkException('用户ID不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array {
        if(!isset($this->reqData['userid'])){
            throw new TalkException('用户ID不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->reqData['access_token'] = $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/microapp/list_by_userid?' . http_build_query($this->reqData);
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