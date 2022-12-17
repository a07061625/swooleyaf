<?php

namespace SyDingTalk\Oapi\V2Department;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.v2.department.update request
 *
 * @author auto create
 *
 * @since 1.0, 2021.10.18
 */
class UpdateRequest extends BaseRequest
{
    /**
     * 如果有新人加入部门是否会自动加入部门群
     */
    private $autoAddUser;
    /**
     * 开启后，加入该部门的申请将默认同意
     */
    private $autoApproveApply;
    /**
     * 部门简介
     */
    private $brief;
    /**
     * 是否创建一个关联此部门的企业群，默认为false
     */
    private $createDeptGroup;
    /**
     * 部门ID
     */
    private $deptId;
    /**
     * 部门的主管列表，主管的userid列表
     */
    private $deptManagerUseridList;
    /**
     * 可以查看指定隐藏部门的其他部门列表，如果部门隐藏，则此值生效。总数不能超过200。
     */
    private $deptPermits;
    /**
     * 扩展字段，JSON格式
     */
    private $extension;
    /**
     * 强制更新的字段，支持清空指定的字段，使用逗号分隔。目前支持字段：dept_manager_userid_list
     */
    private $forceUpdateFields;
    /**
     * 部门群是否包含隐藏部门
     */
    private $groupContainHiddenDept;
    /**
     * 部门群是否包含外包部门
     */
    private $groupContainOuterDept;
    /**
     * 部门群是否包含子部门
     */
    private $groupContainSubDept;
    /**
     * 是否隐藏部门， true表示隐藏 false表示显示
     */
    private $hideDept;
    /**
     * 通讯录语言
     */
    private $language;
    /**
     * 部门名称，长度限制为1~64个字符，不允许包含字符‘-’‘，’以及‘,’
     */
    private $name;
    /**
     * 在父部门中的排序值，order值小的排序靠前
     */
    private $order;
    /**
     * 企业群群主的userid
     */
    private $orgDeptOwner;
    /**
     * 限制本部门成员查看通讯录，限制开启后，本部门成员只能看到限定范围内的通讯录。true表示限制开启
     */
    private $outerDept;
    /**
     * 是否只能看到所在部门及下级部门通讯录
     */
    private $outerDeptOnlySelf;
    /**
     * 本部门的员工仅可见员工自己为true时，可以配置额外可见部门，departmentId列表，总数不能超过200。
     */
    private $outerPermitDepts;
    /**
     * 本部门的员工仅可见员工自己为true时，可以配置额外可见人员，userid列表，总数不能超过200。
     */
    private $outerPermitUsers;
    /**
     * 父部门id，根部门id为1
     */
    private $parentId;
    /**
     * 部门标识字段，开发者可用该字段来唯一标识一个部门，并与钉钉外部通讯录里的部门做映射
     */
    private $sourceIdentifier;
    /**
     * 部门联系方式
     */
    private $telephone;
    /**
     * 可以查看指定隐藏部门的其他人员列表，如果部门隐藏，则此值生效，总数不能超过200。
     */
    private $userPermits;

    public function setAutoAddUser($autoAddUser)
    {
        $this->autoAddUser = $autoAddUser;
        $this->apiParas['auto_add_user'] = $autoAddUser;
    }

    public function getAutoAddUser()
    {
        return $this->autoAddUser;
    }

    public function setAutoApproveApply($autoApproveApply)
    {
        $this->autoApproveApply = $autoApproveApply;
        $this->apiParas['auto_approve_apply'] = $autoApproveApply;
    }

    public function getAutoApproveApply()
    {
        return $this->autoApproveApply;
    }

    public function setBrief($brief)
    {
        $this->brief = $brief;
        $this->apiParas['brief'] = $brief;
    }

    public function getBrief()
    {
        return $this->brief;
    }

    public function setCreateDeptGroup($createDeptGroup)
    {
        $this->createDeptGroup = $createDeptGroup;
        $this->apiParas['create_dept_group'] = $createDeptGroup;
    }

    public function getCreateDeptGroup()
    {
        return $this->createDeptGroup;
    }

    public function setDeptId($deptId)
    {
        $this->deptId = $deptId;
        $this->apiParas['dept_id'] = $deptId;
    }

    public function getDeptId()
    {
        return $this->deptId;
    }

    public function setDeptManagerUseridList($deptManagerUseridList)
    {
        $this->deptManagerUseridList = $deptManagerUseridList;
        $this->apiParas['dept_manager_userid_list'] = $deptManagerUseridList;
    }

    public function getDeptManagerUseridList()
    {
        return $this->deptManagerUseridList;
    }

    public function setDeptPermits($deptPermits)
    {
        $this->deptPermits = $deptPermits;
        $this->apiParas['dept_permits'] = $deptPermits;
    }

    public function getDeptPermits()
    {
        return $this->deptPermits;
    }

    public function setExtension($extension)
    {
        $this->extension = $extension;
        $this->apiParas['extension'] = $extension;
    }

    public function getExtension()
    {
        return $this->extension;
    }

    public function setForceUpdateFields($forceUpdateFields)
    {
        $this->forceUpdateFields = $forceUpdateFields;
        $this->apiParas['force_update_fields'] = $forceUpdateFields;
    }

    public function getForceUpdateFields()
    {
        return $this->forceUpdateFields;
    }

    public function setGroupContainHiddenDept($groupContainHiddenDept)
    {
        $this->groupContainHiddenDept = $groupContainHiddenDept;
        $this->apiParas['group_contain_hidden_dept'] = $groupContainHiddenDept;
    }

    public function getGroupContainHiddenDept()
    {
        return $this->groupContainHiddenDept;
    }

    public function setGroupContainOuterDept($groupContainOuterDept)
    {
        $this->groupContainOuterDept = $groupContainOuterDept;
        $this->apiParas['group_contain_outer_dept'] = $groupContainOuterDept;
    }

    public function getGroupContainOuterDept()
    {
        return $this->groupContainOuterDept;
    }

    public function setGroupContainSubDept($groupContainSubDept)
    {
        $this->groupContainSubDept = $groupContainSubDept;
        $this->apiParas['group_contain_sub_dept'] = $groupContainSubDept;
    }

    public function getGroupContainSubDept()
    {
        return $this->groupContainSubDept;
    }

    public function setHideDept($hideDept)
    {
        $this->hideDept = $hideDept;
        $this->apiParas['hide_dept'] = $hideDept;
    }

    public function getHideDept()
    {
        return $this->hideDept;
    }

    public function setLanguage($language)
    {
        $this->language = $language;
        $this->apiParas['language'] = $language;
    }

    public function getLanguage()
    {
        return $this->language;
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
        $this->apiParas['org_dept_owner'] = $orgDeptOwner;
    }

    public function getOrgDeptOwner()
    {
        return $this->orgDeptOwner;
    }

    public function setOuterDept($outerDept)
    {
        $this->outerDept = $outerDept;
        $this->apiParas['outer_dept'] = $outerDept;
    }

    public function getOuterDept()
    {
        return $this->outerDept;
    }

    public function setOuterDeptOnlySelf($outerDeptOnlySelf)
    {
        $this->outerDeptOnlySelf = $outerDeptOnlySelf;
        $this->apiParas['outer_dept_only_self'] = $outerDeptOnlySelf;
    }

    public function getOuterDeptOnlySelf()
    {
        return $this->outerDeptOnlySelf;
    }

    public function setOuterPermitDepts($outerPermitDepts)
    {
        $this->outerPermitDepts = $outerPermitDepts;
        $this->apiParas['outer_permit_depts'] = $outerPermitDepts;
    }

    public function getOuterPermitDepts()
    {
        return $this->outerPermitDepts;
    }

    public function setOuterPermitUsers($outerPermitUsers)
    {
        $this->outerPermitUsers = $outerPermitUsers;
        $this->apiParas['outer_permit_users'] = $outerPermitUsers;
    }

    public function getOuterPermitUsers()
    {
        return $this->outerPermitUsers;
    }

    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
        $this->apiParas['parent_id'] = $parentId;
    }

    public function getParentId()
    {
        return $this->parentId;
    }

    public function setSourceIdentifier($sourceIdentifier)
    {
        $this->sourceIdentifier = $sourceIdentifier;
        $this->apiParas['source_identifier'] = $sourceIdentifier;
    }

    public function getSourceIdentifier()
    {
        return $this->sourceIdentifier;
    }

    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
        $this->apiParas['telephone'] = $telephone;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function setUserPermits($userPermits)
    {
        $this->userPermits = $userPermits;
        $this->apiParas['user_permits'] = $userPermits;
    }

    public function getUserPermits()
    {
        return $this->userPermits;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.v2.department.update';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxLength($this->brief, 255, 'brief');
        RequestCheckUtil::checkNotNull($this->deptId, 'deptId');
        RequestCheckUtil::checkMaxListSize($this->deptManagerUseridList, 999, 'deptManagerUseridList');
        RequestCheckUtil::checkMaxListSize($this->deptPermits, 200, 'deptPermits');
        RequestCheckUtil::checkMaxListSize($this->forceUpdateFields, 999, 'forceUpdateFields');
        RequestCheckUtil::checkMaxLength($this->name, 64, 'name');
        RequestCheckUtil::checkMaxListSize($this->outerPermitDepts, 200, 'outerPermitDepts');
        RequestCheckUtil::checkMaxListSize($this->outerPermitUsers, 200, 'outerPermitUsers');
        RequestCheckUtil::checkMaxLength($this->telephone, 50, 'telephone');
        RequestCheckUtil::checkMaxListSize($this->userPermits, 200, 'userPermits');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
