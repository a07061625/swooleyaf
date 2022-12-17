<?php

namespace SyDingTalk\Oapi\Report;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.report.template.listbyuserid request
 *
 * @author auto create
 *
 * @since 1.0, 2019.12.18
 */
class TemplateListByUserIdRequest extends BaseRequest
{
    /**
     * 分页游标，从0开始。根据返回结果里的next_cursor是否为空来判断是否还有下一页，且再次调用时offset设置成next_cursor的值
     */
    private $offset;
    /**
     * 分页大小，最大可设置成100
     */
    private $size;
    /**
     * 员工userId, 不传递表示获取所有日志模板
     */
    private $userid;

    public function setOffset($offset)
    {
        $this->offset = $offset;
        $this->apiParas['offset'] = $offset;
    }

    public function getOffset()
    {
        return $this->offset;
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
        return 'dingtalk.oapi.report.template.listbyuserid';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
