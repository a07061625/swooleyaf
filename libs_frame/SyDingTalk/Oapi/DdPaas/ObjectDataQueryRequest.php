<?php

namespace SyDingTalk\Oapi\DdPaas;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.ddpaas.objectdata.query request
 *
 * @author auto create
 *
 * @since 1.0, 2020.06.28
 */
class ObjectDataQueryRequest extends BaseRequest
{
    /**
     * 钉钉PaaS 应用 ID
     */
    private $appUuid;
    /**
     * 用户ID
     */
    private $currentOperatorUserid;
    /**
     * 查询游标
     */
    private $cursor;
    /**
     * 钉钉 PaaS 表单编号
     */
    private $formCode;
    /**
     * 查询条件DSL
     */
    private $queryDsl;
    /**
     * 分页限制
     */
    private $size;

    public function setAppUuid($appUuid)
    {
        $this->appUuid = $appUuid;
        $this->apiParas['app_uuid'] = $appUuid;
    }

    public function getAppUuid()
    {
        return $this->appUuid;
    }

    public function setCurrentOperatorUserid($currentOperatorUserid)
    {
        $this->currentOperatorUserid = $currentOperatorUserid;
        $this->apiParas['current_operator_userid'] = $currentOperatorUserid;
    }

    public function getCurrentOperatorUserid()
    {
        return $this->currentOperatorUserid;
    }

    public function setCursor($cursor)
    {
        $this->cursor = $cursor;
        $this->apiParas['cursor'] = $cursor;
    }

    public function getCursor()
    {
        return $this->cursor;
    }

    public function setFormCode($formCode)
    {
        $this->formCode = $formCode;
        $this->apiParas['form_code'] = $formCode;
    }

    public function getFormCode()
    {
        return $this->formCode;
    }

    public function setQueryDsl($queryDsl)
    {
        $this->queryDsl = $queryDsl;
        $this->apiParas['query_dsl'] = $queryDsl;
    }

    public function getQueryDsl()
    {
        return $this->queryDsl;
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
        return 'dingtalk.oapi.ddpaas.objectdata.query';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->appUuid, 'appUuid');
        RequestCheckUtil::checkNotNull($this->formCode, 'formCode');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
