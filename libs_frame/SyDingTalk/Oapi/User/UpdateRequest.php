<?php

namespace SyDingTalk\Oapi\User;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.user.update request
 *
 * @author auto create
 *
 * @since 1.0, 2020.10.23
 */
class UpdateRequest extends BaseRequest
{
    /**
     * 部门列表
     */
    private $department;
    /**
     * 邮箱
     */
    private $email;
    /**
     * 扩展属性
     */
    private $extattr;
    /**
     * 入职时间
     */
    private $hiredDate;
    /**
     * 是否号码隐藏
     */
    private $isHide;
    /**
     * 是否高管模式
     */
    private $isSenior;
    /**
     * 工号
     */
    private $jobnumber;
    /**
     * 通讯录语言(默认zh_CN另外支持en_US)
     */
    private $lang;
    /**
     * 主管
     */
    private $managerUserid;
    /**
     * 手机号
     */
    private $mobile;
    /**
     * 名字
     */
    private $name;
    /**
     * 实际是Map的序列化字符串
     */
    private $orderInDepts;
    /**
     * 公司邮箱
     */
    private $orgEmail;
    /**
     * 职位
     */
    private $position;
    /**
     * 实际是Map的序列化字符串
     */
    private $positionInDepts;
    /**
     * 备注
     */
    private $remark;
    /**
     * 分机号，长度为0~50个字符
     */
    private $tel;
    /**
     * 用户id
     */
    private $userid;
    /**
     * 工作地点
     */
    private $workPlace;

    public function setDepartment($department)
    {
        $this->department = $department;
        $this->apiParas['department'] = $department;
    }

    public function getDepartment()
    {
        return $this->department;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        $this->apiParas['email'] = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setExtattr($extattr)
    {
        $this->extattr = $extattr;
        $this->apiParas['extattr'] = $extattr;
    }

    public function getExtattr()
    {
        return $this->extattr;
    }

    public function setHiredDate($hiredDate)
    {
        $this->hiredDate = $hiredDate;
        $this->apiParas['hiredDate'] = $hiredDate;
    }

    public function getHiredDate()
    {
        return $this->hiredDate;
    }

    public function setIsHide($isHide)
    {
        $this->isHide = $isHide;
        $this->apiParas['isHide'] = $isHide;
    }

    public function getIsHide()
    {
        return $this->isHide;
    }

    public function setIsSenior($isSenior)
    {
        $this->isSenior = $isSenior;
        $this->apiParas['isSenior'] = $isSenior;
    }

    public function getIsSenior()
    {
        return $this->isSenior;
    }

    public function setJobnumber($jobnumber)
    {
        $this->jobnumber = $jobnumber;
        $this->apiParas['jobnumber'] = $jobnumber;
    }

    public function getJobnumber()
    {
        return $this->jobnumber;
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

    public function setManagerUserid($managerUserid)
    {
        $this->managerUserid = $managerUserid;
        $this->apiParas['managerUserid'] = $managerUserid;
    }

    public function getManagerUserid()
    {
        return $this->managerUserid;
    }

    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
        $this->apiParas['mobile'] = $mobile;
    }

    public function getMobile()
    {
        return $this->mobile;
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

    public function setOrderInDepts($orderInDepts)
    {
        $this->orderInDepts = $orderInDepts;
        $this->apiParas['orderInDepts'] = $orderInDepts;
    }

    public function getOrderInDepts()
    {
        return $this->orderInDepts;
    }

    public function setOrgEmail($orgEmail)
    {
        $this->orgEmail = $orgEmail;
        $this->apiParas['orgEmail'] = $orgEmail;
    }

    public function getOrgEmail()
    {
        return $this->orgEmail;
    }

    public function setPosition($position)
    {
        $this->position = $position;
        $this->apiParas['position'] = $position;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function setPositionInDepts($positionInDepts)
    {
        $this->positionInDepts = $positionInDepts;
        $this->apiParas['positionInDepts'] = $positionInDepts;
    }

    public function getPositionInDepts()
    {
        return $this->positionInDepts;
    }

    public function setRemark($remark)
    {
        $this->remark = $remark;
        $this->apiParas['remark'] = $remark;
    }

    public function getRemark()
    {
        return $this->remark;
    }

    public function setTel($tel)
    {
        $this->tel = $tel;
        $this->apiParas['tel'] = $tel;
    }

    public function getTel()
    {
        return $this->tel;
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

    public function setWorkPlace($workPlace)
    {
        $this->workPlace = $workPlace;
        $this->apiParas['workPlace'] = $workPlace;
    }

    public function getWorkPlace()
    {
        return $this->workPlace;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.user.update';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxListSize($this->department, 20, 'department');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
