<?php

namespace SyDingTalk\Oapi\Conference;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.conference.participant.sync request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class ParticipantSyncRequest extends BaseRequest
{
    /**
     * 全量同步id，第一批上传时为空，后续批次需要带上
     */
    private $batchId;
    /**
     * 标识批次，从1递增
     */
    private $batchIndex;
    /**
     * 会务id
     */
    private $conferenceId;
    /**
     * 是否最后一批
     */
    private $isFinished;
    /**
     * 参会人员id列表
     */
    private $participantUseridList;
    /**
     * 操作用户id
     */
    private $userid;

    public function setBatchId($batchId)
    {
        $this->batchId = $batchId;
        $this->apiParas['batch_id'] = $batchId;
    }

    public function getBatchId()
    {
        return $this->batchId;
    }

    public function setBatchIndex($batchIndex)
    {
        $this->batchIndex = $batchIndex;
        $this->apiParas['batch_index'] = $batchIndex;
    }

    public function getBatchIndex()
    {
        return $this->batchIndex;
    }

    public function setConferenceId($conferenceId)
    {
        $this->conferenceId = $conferenceId;
        $this->apiParas['conference_id'] = $conferenceId;
    }

    public function getConferenceId()
    {
        return $this->conferenceId;
    }

    public function setIsFinished($isFinished)
    {
        $this->isFinished = $isFinished;
        $this->apiParas['is_finished'] = $isFinished;
    }

    public function getIsFinished()
    {
        return $this->isFinished;
    }

    public function setParticipantUseridList($participantUseridList)
    {
        $this->participantUseridList = $participantUseridList;
        $this->apiParas['participant_userid_list'] = $participantUseridList;
    }

    public function getParticipantUseridList()
    {
        return $this->participantUseridList;
    }

    public function setUserid($userid)
    {
        $this->userid = $userid;
        $this->apiParas['userid'] = $userid;
    }

    public function getUserid()
    {
        return $this->userid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.conference.participant.sync';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->batchIndex, 'batchIndex');
        RequestCheckUtil::checkNotNull($this->conferenceId, 'conferenceId');
        RequestCheckUtil::checkNotNull($this->isFinished, 'isFinished');
        RequestCheckUtil::checkNotNull($this->participantUseridList, 'participantUseridList');
        RequestCheckUtil::checkMaxListSize($this->participantUseridList, 1000, 'participantUseridList');
        RequestCheckUtil::checkNotNull($this->userid, 'userid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
