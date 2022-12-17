<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.edu.class.student.batchget request
 *
 * @author auto create
 *
 * @since 1.0, 2021.02.19
 */
class ClassStudentBatchgetRequest extends BaseRequest
{
    /**
     * 请求体
     */
    private $requestParam;

    public function setRequestParam($requestParam)
    {
        $this->requestParam = $requestParam;
        $this->apiParas['request_param'] = $requestParam;
    }

    public function getRequestParam()
    {
        return $this->requestParam;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.class.student.batchget';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
