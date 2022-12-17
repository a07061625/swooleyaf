<?php

namespace SyDingTalk\Oapi\Attendance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.attendance.group.positions.add request
 *
 * @author auto create
 *
 * @since 1.0, 2021.08.26
 */
class GroupPositionsAddRequest extends BaseRequest
{
    /**
     * 考勤组id
     */
    private $groupKey;
    /**
     * 操作人userId
     */
    private $opUserid;
    /**
     * postion列表
     */
    private $positionList;

    public function setGroupKey($groupKey)
    {
        $this->groupKey = $groupKey;
        $this->apiParas['group_key'] = $groupKey;
    }

    public function getGroupKey()
    {
        return $this->groupKey;
    }

    public function setOpUserid($opUserid)
    {
        $this->opUserid = $opUserid;
        $this->apiParas['op_userid'] = $opUserid;
    }

    public function getOpUserid()
    {
        return $this->opUserid;
    }

    public function setPositionList($positionList)
    {
        $this->positionList = $positionList;
        $this->apiParas['position_list'] = $positionList;
    }

    public function getPositionList()
    {
        return $this->positionList;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.attendance.group.positions.add';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->groupKey, 'groupKey');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
