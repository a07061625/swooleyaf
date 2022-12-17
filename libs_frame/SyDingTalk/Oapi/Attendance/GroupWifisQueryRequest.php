<?php

namespace SyDingTalk\Oapi\Attendance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.attendance.group.wifis.query request
 *
 * @author auto create
 *
 * @since 1.0, 2020.04.09
 */
class GroupWifisQueryRequest extends BaseRequest
{
    /**
     * 上一批次最后一个id，默认空
     */
    private $cursor;
    /**
     * 考勤组id
     */
    private $groupKey;
    /**
     * 操作人userId
     */
    private $opUserid;
    /**
     * 分页大小
     */
    private $size;

    public function setCursor($cursor)
    {
        $this->cursor = $cursor;
        $this->apiParas['cursor'] = $cursor;
    }

    public function getCursor()
    {
        return $this->cursor;
    }

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

    public function setSize($size)
    {
        $this->size = $size;
        $this->apiParas['size'] = $size;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.attendance.group.wifis.query';
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
