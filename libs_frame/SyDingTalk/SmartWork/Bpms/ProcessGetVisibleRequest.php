<?php

namespace SyDingTalk\SmartWork\Bpms;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.smartwork.bpms.process.getvisible request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class ProcessGetVisibleRequest extends BaseRequest
{
    /**
     * 流程模板唯一标识，可在oa后台编辑审批表单部分查询
     */
    private $processCodeList;
    /**
     * 员工ID
     */
    private $userid;

    public function setProcessCodeList($processCodeList)
    {
        $this->processCodeList = $processCodeList;
        $this->apiParas['process_code_list'] = $processCodeList;
    }

    public function getProcessCodeList()
    {
        return $this->processCodeList;
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
        return 'dingtalk.smartwork.bpms.process.getvisible';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->processCodeList, 'processCodeList');
        RequestCheckUtil::checkMaxListSize($this->processCodeList, 20, 'processCodeList');
        RequestCheckUtil::checkNotNull($this->userid, 'userid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
