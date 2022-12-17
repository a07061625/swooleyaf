<?php

namespace SyDingTalk\Oapi\User;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.user.create request
 *
 * @author auto create
 *
 * @since 1.0, 2021.06.08
 */
class CreateRequest extends BaseRequest
{
    /**
     * 数组类型，数组里面值为整型，成员所属部门id列表
     */
    private $department;
    /**
     * 邮箱。长度为0~64个字符。企业内必须唯一，不可重复
     */
    private $email;
    /**
     * 扩展属性，可以设置多种属性(但手机上最多只能显示10个扩展属性，具体显示哪些属性，请到OA管理后台->设置->通讯录信息设置和OA管理后台->设置->手机端显示信息设置)
     */
    private $extattr;
    /**
     * 入职时间
     */
    private $hiredDate;
    /**
     * 是否号码隐藏, true表示隐藏, false表示不隐藏。隐藏手机号后，手机号在个人资料页隐藏，但仍可对其发DING、发起钉钉免费商务电话。
     */
    private $isHide;
    /**
     * 是否高管模式，true表示是，false表示不是。开启后，手机号码对所有员工隐藏。普通员工无法对其发DING、发起钉钉免费商务电话。高管之间不受影响。
     */
    private $isSenior;
    /**
     * 员工工号。对应显示到OA后台和客户端个人资料的工号栏目。长度为0~64个字符
     */
    private $jobnumber;
    /**
     * 手机号码，企业内必须唯一，不可重复
     */
    private $mobile;
    /**
     * 成员名称。长度为1~64个字符
     */
    private $name;
    /**
     * 在对应的部门中的排序, Map结构的json字符串, key是部门的Id, value是人员在这个部门的排序值
     */
    private $orderInDepts;
    /**
     * 员工的企业邮箱，员工的企业邮箱已开通，才能增加此字段， 否则会报错
     */
    private $orgEmail;
    /**
     * 职位信息。长度为0~64个字符
     */
    private $position;
    /**
     * 在对应的部门中的职位信息, Map结构的json字符串, key是部门的Id, value是人员在这个部门的职位
     */
    private $positionInDepts;
    /**
     * 备注，长度为0~1000个字符
     */
    private $remark;
    /**
     * 分机号，长度为0~50个字符，企业内必须唯一，不可重复
     */
    private $tel;
    /**
     * 员工唯一标识ID（不可修改），企业内必须唯一。长度为1~64个字符，如果不传，服务器将自动生成一个userid
     */
    private $userid;
    /**
     * 办公地点，长度为0~50个字符
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
        return 'dingtalk.oapi.user.create';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
