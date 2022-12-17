<?php

namespace SyDingTalk\Oapi\Workspace;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.workspace.project.notice.send request
 *
 * @author auto create
 *
 * @since 1.0, 2020.08.03
 */
class ProjectNoticeSendRequest extends BaseRequest
{
    /**
     * 发送通知入参
     */
    private $sendNoticeReq;

    public function setSendNoticeReq($sendNoticeReq)
    {
        $this->sendNoticeReq = $sendNoticeReq;
        $this->apiParas['send_notice_req'] = $sendNoticeReq;
    }

    public function getSendNoticeReq()
    {
        return $this->sendNoticeReq;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.workspace.project.notice.send';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
