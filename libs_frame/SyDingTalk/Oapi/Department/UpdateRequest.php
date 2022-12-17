<?php

namespace SyDingTalk\Oapi\Department;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.department.update request
 *
 * @author auto create
 *
 * @since 1.0, 2020.05.18
 */
class UpdateRequest extends BaseRequest
{
    /**
     * 如果有新人加入部门是否会自动加入部门群
     */
    private $autoAddUser;
    /**
     * 是否创建一个关联此部门的企业群
     */
    private $createDeptGroup;
    /**
     * 是否隐藏部门, true表示隐藏, false表示显示
     */
    private $deptHiding;
    /**
     * 部门的主管列表,取值为由主管的userid组成的字符串，不同的userid使用’| 符号进行分割
     */
    private $deptManagerUseridList;
    /**
     * 可以查看指定隐藏部门的其他部门列表，如果部门隐藏，则此值生效，取值为其他的部门id组成的的字符串，使用 | 符号进行分割。总数不能超过200。
     */
    private $deptPerimits;
    /**
     * 可以查看指定隐藏部门的其他部门列表，如果部门隐藏，则此值生效，取值为其他的部门id组成的的字符串，使用 | 符号进行分割。总数不能超过200。
     */
    private $deptPermits;
    /**
     * 部门群是否包含隐藏部门
     */
    private $groupContainHiddenDept;
    /**
     * 部门群是否包含外包部门
     */
    private $groupContainOuterDept;
    /**
     * 本门群是否包含子部门
     */
    private $groupContainSubDept;
    /**
     * 部门id
     */
    private $id;
    /**
     * 通讯录语言(默认zh_CN另外支持en_US)
     */
    private $lang;
    /**
     * 部门名称。长度限制为1~64个字符。不允许包含字符‘-’‘，’以及‘,’。
     */
    private $name;
    /**
     * 在父部门中的次序值。order值小的排序靠前
     */
    private $order;
    /**
     * 企业群群主
     */
    private $orgDeptOwner;
    /**
     * 是否本部门的员工仅可见员工自己, 为true时，本部门员工默认只能看到员工自己
     */
    private $outerDept;
    /**
     * 是否只能看到所在部门及下级部门通讯录
     */
    private $outerDeptOnlySelf;
    /**
     * 本部门的员工仅可见员工自己为true时，可以配置额外可见部门，值为部门id组成的的字符串，使用|符号进行分割。总数不能超过200。
     */
    private $outerPermitDepts;
    /**
     * 本部门的员工仅可见员工自己为true时，可以配置额外可见人员，值为userid组成的的字符串，使用|符号进行分割。总数不能超过200。
     */
    private $outerPermitUsers;
    /**
     * 父部门id。根部门id为1
     */
    private $parentid;
    /**
     * 部门标识字段，开发者可用该字段来唯一标识一个部门，并与钉钉外部通讯录里的部门做映射
     */
    private $sourceIdentifier;
    /**
     * 可以查看指定隐藏部门的其他人员列表，如果部门隐藏，则此值生效，取值为其他的人员userid组成的的字符串，使用| 符号进行分割。总数不能超过200。
     */
    private $userPerimits;
    /**
     * 可以查看指定隐藏部门的其他人员列表，如果部门隐藏，则此值生效，取值为其他的人员userid组成的的字符串，使用| 符号进行分割。总数不能超过200。
     */
    private $userPermits;

    public function setAutoAddUser($autoAddUser)
    {
        $this->autoAddUser = $autoAddUser;
        $this->apiParas['autoAddUser'] = $autoAddUser;
    }

    public function getAutoAddUser()
    {
        return $this->autoAddUser;
    }

    public function setCreateDeptGroup($createDeptGroup)
    {
        $this->createDeptGroup = $createDeptGroup;
        $this->apiParas['createDeptGroup'] = $createDeptGroup;
    }

    public function getCreateDeptGroup()
    {
        return $this->createDeptGroup;
    }

    public function setDeptHiding($deptHiding)
    {
        $this->deptHiding = $deptHiding;
        $this->apiParas['deptHiding'] = $deptHiding;
    }

    public function getDeptHiding()
    {
        return $this->deptHiding;
    }

    public function setDeptManagerUseridList($deptManagerUseridList)
    {
        $this->deptManagerUseridList = $deptManagerUseridList;
        $this->apiParas['deptManagerUseridList'] = $deptManagerUseridList;
    }

    public function getDeptManagerUseridList()
    {
        return $this->deptManagerUseridList;
    }

    public function setDeptPerimits($deptPerimits)
    {
        $this->deptPerimits = $deptPerimits;
        $this->apiParas['deptPerimits'] = $deptPerimits;
    }

    public function getDeptPerimits()
    {
        return $this->deptPerimits;
    }

    public function setDeptPermits($deptPermits)
    {
        $this->deptPermits = $deptPermits;
        $this->apiParas['deptPermits'] = $deptPermits;
    }

    public function getDeptPermits()
    {
        return $this->deptPermits;
    }

    public function setGroupContainHiddenDept($groupContainHiddenDept)
    {
        $this->groupContainHiddenDept = $groupContainHiddenDept;
        $this->apiParas['groupContainHiddenDept'] = $groupContainHiddenDept;
    }

    public function getGroupContainHiddenDept()
    {
        return $this->groupContainHiddenDept;
    }

    public function setGroupContainOuterDept($groupContainOuterDept)
    {
        $this->groupContainOuterDept = $groupContainOuterDept;
        $this->apiParas['groupContainOuterDept'] = $groupContainOuterDept;
    }

    public function getGroupContainOuterDept()
    {
        return $this->groupContainOuterDept;
    }

    public function setGroupContainSubDept($groupContainSubDept)
    {
        $this->groupContainSubDept = $groupContainSubDept;
        $this->apiParas['groupContainSubDept'] = $groupContainSubDept;
    }

    public function getGroupContainSubDept()
    {
        return $this->groupContainSubDept;
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

    public function setName($name)
    {
        $this->name = $name;
        $this->apiParas['name'] = $name;
    }

    public function getName()
    {
        return $this->name;
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

    public function setOrgDeptOwner($orgDeptOwner)
    {
        $this->orgDeptOwner = $orgDeptOwner;
        $this->apiParas['orgDeptOwner'] = $orgDeptOwner;
    }

    public function getOrgDeptOwner()
    {
        return $this->orgDeptOwner;
    }

    public function setOuterDept($outerDept)
    {
        $this->outerDept = $outerDept;
        $this->apiParas['outerDept'] = $outerDept;
    }

    public function getOuterDept()
    {
        return $this->outerDept;
    }

    public function setOuterDeptOnlySelf($outerDeptOnlySelf)
    {
        $this->outerDeptOnlySelf = $outerDeptOnlySelf;
        $this->apiParas['outerDeptOnlySelf'] = $outerDeptOnlySelf;
    }

    public function getOuterDeptOnlySelf()
    {
        return $this->outerDeptOnlySelf;
    }

    public function setOuterPermitDepts($outerPermitDepts)
    {
        $this->outerPermitDepts = $outerPermitDepts;
        $this->apiParas['outerPermitDepts'] = $outerPermitDepts;
    }

    public function getOuterPermitDepts()
    {
        return $this->outerPermitDepts;
    }

    public function setOuterPermitUsers($outerPermitUsers)
    {
        $this->outerPermitUsers = $outerPermitUsers;
        $this->apiParas['outerPermitUsers'] = $outerPermitUsers;
    }

    public function getOuterPermitUsers()
    {
        return $this->outerPermitUsers;
    }

    public function setParentid($parentid)
    {
        $this->parentid = $parentid;
        $this->apiParas['parentid'] = $parentid;
    }

    public function getParentid()
    {
        return $this->parentid;
    }

    public function setSourceIdentifier($sourceIdentifier)
    {
        $this->sourceIdentifier = $sourceIdentifier;
        $this->apiParas['sourceIdentifier'] = $sourceIdentifier;
    }

    public function getSourceIdentifier()
    {
        return $this->sourceIdentifier;
    }

    public function setUserPerimits($userPerimits)
    {
        $this->userPerimits = $userPerimits;
        $this->apiParas['userPerimits'] = $userPerimits;
    }

    public function getUserPerimits()
    {
        return $this->userPerimits;
    }

    public function setUserPermits($userPermits)
    {
        $this->userPermits = $userPermits;
        $this->apiParas['userPermits'] = $userPermits;
    }

    public function getUserPermits()
    {
        return $this->userPermits;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.department.update';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
