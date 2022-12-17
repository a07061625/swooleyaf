<?php

namespace SyDingTalk\Oapi\User;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.user.list request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class ListRequest extends BaseRequest
{
    /**
     * 获取的部门id
     */
    private $departmentId;
    /**
     * 通讯录语言(默认zh_CN另外支持en_US)
     */
    private $lang;
    /**
     * 支持分页查询，与size参数同时设置时才生效，此参数代表偏移量
     */
    private $offset;
    /**
     * 支持分页查询，部门成员的排序规则，默认不传是按自定义排序；entry_asc代表按照进入部门的时间升序，entry_desc代表按照进入部门的时间降序，modify_asc代表按照部门信息修改时间升序，modify_desc代表按照部门信息修改时间降序，custom代表用户定义(未定义时按照拼音)排序
     */
    private $order;
    /**
     * 支持分页查询，与offset参数同时设置时才生效，此参数代表分页大小，最大100
     */
    private $size;

    public function setDepartmentId($departmentId)
    {
        $this->departmentId = $departmentId;
        $this->apiParas['department_id'] = $departmentId;
    }

    public function getDepartmentId()
    {
        return $this->departmentId;
    }

    public function setLang($lang)
    {
        $this->lang = $lang;
        $this->apiParas['lang'] = $lang;
    }

    public function getLang()
    {
        return $this->lang;
    }

    public function setOffset($offset)
    {
        $this->offset = $offset;
        $this->apiParas['offset'] = $offset;
    }

    public function getOffset()
    {
        return $this->offset;
    }

    public function setOrder($order)
    {
        $this->order = $order;
        $this->apiParas['order'] = $order;
    }

    public function getOrder()
    {
        return $this->order;
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
        return 'dingtalk.oapi.user.list';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
