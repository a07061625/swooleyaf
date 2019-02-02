<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-2
 * Time: 下午1:03
 */
namespace DingDing\Corp\Attendance;

use Constant\ErrorCode;
use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use DingDing\TalkUtilBase;
use Exception\DingDing\TalkException;
use Tool\Tool;

/**
 * 获取请假时长
 * @package DingDing\Corp\Attendance
 */
class LeaveApproveDuration extends TalkBaseCorp {
    use TalkTraitCorp;

    /**
     * 员工用户ID
     * @var string
     */
    private $userid = '';
    /**
     * 开始时间
     * @var string
     */
    private $from_date = '';
    /**
     * 结束时间
     * @var string
     */
    private $to_date = '';

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
            throw new TalkException('员工用户ID不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param int $startTime
     * @param int $endTime
     * @throws \Exception\DingDing\TalkException
     */
    public function setStartTimeAndEndTime(int $startTime,int $endTime){
        if ($startTime < 946656000) {
            throw new TalkException('开始时间不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        } else if($endTime < $startTime){
            throw new TalkException('结束时间不能小于开始时间', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->reqData['from_date'] = date('Y-m-d H:i:s', $startTime);
        $this->reqData['to_date'] = date('Y-m-d H:i:s', $endTime);
    }

    public function getDetail() : array {
        if(!isset($this->reqData['userid'])){
            throw new TalkException('员工用户ID不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if(!isset($this->reqData['from_date'])){
            throw new TalkException('开始时间不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/topapi/attendance/getleaveapproveduration?' . http_build_query([
            'access_token' => $this->getAccessToken(TalkBaseCorp::ACCESS_TOKEN_TYPE_CORP, $this->_corpId, $this->_agentTag),
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