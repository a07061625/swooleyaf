<?php

namespace SyDingTalk\Oapi\Rhino;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.rhino.openservice.query request
 *
 * @author auto create
 *
 * @since 1.0, 2020.02.17
 */
class OpenServiceQueryRequest extends BaseRequest
{
    /**
     * 编码
     */
    private $code;
    /**
     * 创建时间
     */
    private $gmtCreate;
    /**
     * ID
     */
    private $id;
    /**
     * 租户ID
     */
    private $tenentId;
    /**
     * 用户ID
     */
    private $userid;

    public function setCode($code)
    {
        $this->code = $code;
        $this->apiParas['code'] = $code;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setGmtCreate($gmtCreate)
    {
        $this->gmtCreate = $gmtCreate;
        $this->apiParas['gmt_create'] = $gmtCreate;
    }

    public function getGmtCreate()
    {
        return $this->gmtCreate;
    }

    public function setId($id)
    {
        $this->id = $id;
        $this->apiParas['id'] = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setTenentId($tenentId)
    {
        $this->tenentId = $tenentId;
        $this->apiParas['tenent_id'] = $tenentId;
    }

    public function getTenentId()
    {
        return $this->tenentId;
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
        return 'dingtalk.oapi.rhino.openservice.query';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
