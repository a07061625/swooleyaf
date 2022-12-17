<?php

namespace SyDingTalk\Oapi\Department;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.department.list request
 *
 * @author auto create
 *
 * @since 1.0, 2019.12.17
 */
class ListRequest extends BaseRequest
{
    /**
     * 是否递归部门的全部子部门，ISV微应用固定传递false。
     */
    private $fetchChild;
    /**
     * 父部门id(如果不传，默认部门为根部门，根部门ID为1)
     */
    private $id;
    /**
     * 通讯录语言(默认zh_CN，未来会支持en_US)
     */
    private $lang;

    public function setFetchChild($fetchChild)
    {
        $this->fetchChild = $fetchChild;
        $this->apiParas['fetch_child'] = $fetchChild;
    }

    public function getFetchChild()
    {
        return $this->fetchChild;
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

    public function setLang($lang)
    {
        $this->lang = $lang;
        $this->apiParas['lang'] = $lang;
    }

    public function getLang()
    {
        return $this->lang;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.department.list';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
