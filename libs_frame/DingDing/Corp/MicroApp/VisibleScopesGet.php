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
 * 获取应用的可见范围
 * @package DingDing\Corp\MicroApp
 */
class VisibleScopesGet extends TalkBaseCorp {
    use TalkTraitCorp;

    /**
     * 应用ID
     * @var int
     */
    private $agentId = 0;

    public function __construct(string $corpId,string $agentTag){
        parent::__construct();
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
    }

    private function __clone(){
    }

    /**
     * @param int $agentId
     * @throws \Exception\DingDing\TalkException
     */
    public function setAgentId(int $agentId){
        if($agentId > 0){
            $this->reqData['agentId'] = $agentId;
        } else {
            throw new TalkException('应用ID不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array {
        if(!isset($this->reqData['agentId'])){
            throw new TalkException('应用ID不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/microapp/visible_scopes?' . http_build_query([
            'access_token' => $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag),
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = TalkUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if($sendData['errcode'] == 0){
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::DING_TALK_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}