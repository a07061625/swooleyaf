<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.edu.class.listbyteacher request
 *
 * @author auto create
 *
 * @since 1.0, 2021.04.15
 */
class ClassListbyteacherRequest extends BaseRequest
{
    /**
     * 过滤入参
     */
    private $filterParam;
    /**
     * 是否跨组织查询
     */
    private $queryFromAllOrgs;
    /**
     * 返回的扩展信息设置(不支持跨组织)
     */
    private $retExtFields;
    /**
     * 用户ID
     */
    private $userid;

    public function setFilterParam($filterParam)
    {
        $this->filterParam = $filterParam;
        $this->apiParas['filter_param'] = $filterParam;
    }

    public function getFilterParam()
    {
        return $this->filterParam;
    }

    public function setQueryFromAllOrgs($queryFromAllOrgs)
    {
        $this->queryFromAllOrgs = $queryFromAllOrgs;
        $this->apiParas['queryFromAllOrgs'] = $queryFromAllOrgs;
    }

    public function getQueryFromAllOrgs()
    {
        return $this->queryFromAllOrgs;
    }

    public function setRetExtFields($retExtFields)
    {
        $this->retExtFields = $retExtFields;
        $this->apiParas['ret_ext_fields'] = $retExtFields;
    }

    public function getRetExtFields()
    {
        return $this->retExtFields;
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
        return 'dingtalk.oapi.edu.class.listbyteacher';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
