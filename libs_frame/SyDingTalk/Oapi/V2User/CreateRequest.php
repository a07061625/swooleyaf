<?php

namespace SyDingTalk\Oapi\V2User;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.v2.user.create request
 *
 * @author auto create
 *
 * @since 1.0, 2021.12.02
 */
class CreateRequest extends BaseRequest
{
    /**
     * 创建本组织专属帐号时可指定头像MediaId。只支持参考jpg/png，生成方法 https://developers.dingtalk.com/document/app/upload-media-files
     */
    private $avatarMediaId;
    /**
     * 所属部门id列表
     */
    private $deptIdList;
    /**
     * 员工在对应的部门中的排序。
     */
    private $deptOrderList;
    /**
     * 部门内任职
     */
    private $deptPositionList;
    /**
     * 员工在对应的部门中的职位。
     */
    private $deptTitleList;
    /**
     * 员工邮箱，长度最大50个字符。企业内必须唯一，不可重复。
     */
    private $email;
    /**
     * 是否专属帐号（true时，不能指定loginEmail或mobile）
     */
    private $exclusiveAccount;
    /**
     * 专属帐号类型：sso： 企业自建专属帐号；dingtalk：钉钉自建专属帐号。
     */
    private $exclusiveAccountType;
    /**
     * 专属帐号手机号
     */
    private $exclusiveMobile;
    /**
     * 专属帐号手机号验证状态
     */
    private $exclusiveMobileVerifyStatus;
    /**
     * 扩展属性，长度最大2000个字符。可以设置多种属性（手机上最多显示10个扩展属性，具体显示哪些属性，请到OA管理后台->设置->通讯录信息设置和OA管理后台->设置->手机端显示信息设置）。 该字段的值支持链接类型填写，同时链接支持变量通配符自动替换，目前支持通配符有：userid，corpid。示例： [工位地址](http://www.dingtalk.com?userid=#userid#&corpid=#corpid#)
     */
    private $extension;
    /**
     * 是否号码隐藏。隐藏手机号后，手机号在个人资料页隐藏，但仍可对其发DING、发起钉钉免费商务电话。
     */
    private $hideMobile;
    /**
     * 入职时间，Unix时间戳，单位ms。
     */
    private $hiredDate;
    /**
     * 钉钉专属帐号初始密码
     */
    private $initPassword;
    /**
     * 员工工号，长度最大50个字符。
     */
    private $jobNumber;
    /**
     * 登录邮箱
     */
    private $loginEmail;
    /**
     * 钉钉专属帐号登录名
     */
    private $loginId;
    /**
     * 直属主管
     */
    private $managerUserid;
    /**
     * 手机号码，企业内必须唯一，不可重复。如果是国际号码，请使用+xx-xxxxxx的格式
     */
    private $mobile;
    /**
     * 员工名称，长度最大80个字符。
     */
    private $name;
    /**
     * 创建本组织专属帐号时可指定昵称
     */
    private $nickname;
    /**
     * 员工的企业邮箱，长度最大100个字符。员工的企业邮箱已开通，才能增加此字段。
     */
    private $orgEmail;
    /**
     * 企业邮箱类型（profession：标准版，base：基础版）
     */
    private $orgEmailType;
    /**
     * 需要添加的专属帐号所属corpid
     */
    private $outerExclusiveCorpid;
    /**
     * 需要添加的专属帐号所属userid
     */
    private $outerExclusiveUserid;
    /**
     * 备注，长度最大2000个字符。
     */
    private $remark;
    /**
     * 是否高管模式。开启后，手机号码对所有员工隐藏。普通员工无法对其发DING、发起钉钉免费商务电话。高管之间不受影响。
     */
    private $seniorMode;
    /**
     * 分机号，长度最大50个字符。企业内必须唯一，不可重复
     */
    private $telephone;
    /**
     * 职位，长度最大200个字符。
     */
    private $title;
    /**
     * 员工id，长度最大64个字符。员工在当前企业内的唯一标识。
     */
    private $userid;
    /**
     * 办公地点，长度最大100个字符。
     */
    private $workPlace;

    public function setAvatarMediaId($avatarMediaId)
    {
        $this->avatarMediaId = $avatarMediaId;
        $this->apiParas['avatarMediaId'] = $avatarMediaId;
    }

    public function getAvatarMediaId()
    {
        return $this->avatarMediaId;
    }

    public function setDeptIdList($deptIdList)
    {
        $this->deptIdList = $deptIdList;
        $this->apiParas['dept_id_list'] = $deptIdList;
    }

    public function getDeptIdList()
    {
        return $this->deptIdList;
    }

    public function setDeptOrderList($deptOrderList)
    {
        $this->deptOrderList = $deptOrderList;
        $this->apiParas['dept_order_list'] = $deptOrderList;
    }

    public function getDeptOrderList()
    {
        return $this->deptOrderList;
    }

    public function setDeptPositionList($deptPositionList)
    {
        $this->deptPositionList = $deptPositionList;
        $this->apiParas['dept_position_list'] = $deptPositionList;
    }

    public function getDeptPositionList()
    {
        return $this->deptPositionList;
    }

    public function setDeptTitleList($deptTitleList)
    {
        $this->deptTitleList = $deptTitleList;
        $this->apiParas['dept_title_list'] = $deptTitleList;
    }

    public function getDeptTitleList()
    {
        return $this->deptTitleList;
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

    public function setExclusiveAccount($exclusiveAccount)
    {
        $this->exclusiveAccount = $exclusiveAccount;
        $this->apiParas['exclusive_account'] = $exclusiveAccount;
    }

    public function getExclusiveAccount()
    {
        return $this->exclusiveAccount;
    }

    public function setExclusiveAccountType($exclusiveAccountType)
    {
        $this->exclusiveAccountType = $exclusiveAccountType;
        $this->apiParas['exclusive_account_type'] = $exclusiveAccountType;
    }

    public function getExclusiveAccountType()
    {
        return $this->exclusiveAccountType;
    }

    public function setExclusiveMobile($exclusiveMobile)
    {
        $this->exclusiveMobile = $exclusiveMobile;
        $this->apiParas['exclusive_mobile'] = $exclusiveMobile;
    }

    public function getExclusiveMobile()
    {
        return $this->exclusiveMobile;
    }

    public function setExclusiveMobileVerifyStatus($exclusiveMobileVerifyStatus)
    {
        $this->exclusiveMobileVerifyStatus = $exclusiveMobileVerifyStatus;
        $this->apiParas['exclusive_mobile_verify_status'] = $exclusiveMobileVerifyStatus;
    }

    public function getExclusiveMobileVerifyStatus()
    {
        return $this->exclusiveMobileVerifyStatus;
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

    public function setHideMobile($hideMobile)
    {
        $this->hideMobile = $hideMobile;
        $this->apiParas['hide_mobile'] = $hideMobile;
    }

    public function getHideMobile()
    {
        return $this->hideMobile;
    }

    public function setHiredDate($hiredDate)
    {
        $this->hiredDate = $hiredDate;
        $this->apiParas['hired_date'] = $hiredDate;
    }

    public function getHiredDate()
    {
        return $this->hiredDate;
    }

    public function setInitPassword($initPassword)
    {
        $this->initPassword = $initPassword;
        $this->apiParas['init_password'] = $initPassword;
    }

    public function getInitPassword()
    {
        return $this->initPassword;
    }

    public function setJobNumber($jobNumber)
    {
        $this->jobNumber = $jobNumber;
        $this->apiParas['job_number'] = $jobNumber;
    }

    public function getJobNumber()
    {
        return $this->jobNumber;
    }

    public function setLoginEmail($loginEmail)
    {
        $this->loginEmail = $loginEmail;
        $this->apiParas['login_email'] = $loginEmail;
    }

    public function getLoginEmail()
    {
        return $this->loginEmail;
    }

    public function setLoginId($loginId)
    {
        $this->loginId = $loginId;
        $this->apiParas['login_id'] = $loginId;
    }

    public function getLoginId()
    {
        return $this->loginId;
    }

    public function setManagerUserid($managerUserid)
    {
        $this->managerUserid = $managerUserid;
        $this->apiParas['manager_userid'] = $managerUserid;
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

    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
        $this->apiParas['nickname'] = $nickname;
    }

    public function getNickname()
    {
        return $this->nickname;
    }

    public function setOrgEmail($orgEmail)
    {
        $this->orgEmail = $orgEmail;
        $this->apiParas['org_email'] = $orgEmail;
    }

    public function getOrgEmail()
    {
        return $this->orgEmail;
    }

    public function setOrgEmailType($orgEmailType)
    {
        $this->orgEmailType = $orgEmailType;
        $this->apiParas['org_email_type'] = $orgEmailType;
    }

    public function getOrgEmailType()
    {
        return $this->orgEmailType;
    }

    public function setOuterExclusiveCorpid($outerExclusiveCorpid)
    {
        $this->outerExclusiveCorpid = $outerExclusiveCorpid;
        $this->apiParas['outer_exclusive_corpid'] = $outerExclusiveCorpid;
    }

    public function getOuterExclusiveCorpid()
    {
        return $this->outerExclusiveCorpid;
    }

    public function setOuterExclusiveUserid($outerExclusiveUserid)
    {
        $this->outerExclusiveUserid = $outerExclusiveUserid;
        $this->apiParas['outer_exclusive_userid'] = $outerExclusiveUserid;
    }

    public function getOuterExclusiveUserid()
    {
        return $this->outerExclusiveUserid;
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

    public function setSeniorMode($seniorMode)
    {
        $this->seniorMode = $seniorMode;
        $this->apiParas['senior_mode'] = $seniorMode;
    }

    public function getSeniorMode()
    {
        return $this->seniorMode;
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

    public function setTitle($title)
    {
        $this->title = $title;
        $this->apiParas['title'] = $title;
    }

    public function getTitle()
    {
        return $this->title;
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
        $this->apiParas['work_place'] = $workPlace;
    }

    public function getWorkPlace()
    {
        return $this->workPlace;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.v2.user.create';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxListSize($this->deptIdList, 100, 'deptIdList');
        RequestCheckUtil::checkMaxLength($this->email, 50, 'email');
        RequestCheckUtil::checkMinValue($this->hiredDate, 1, 'hiredDate');
        RequestCheckUtil::checkMaxLength($this->jobNumber, 50, 'jobNumber');
        RequestCheckUtil::checkMaxLength($this->loginEmail, 64, 'loginEmail');
        RequestCheckUtil::checkNotNull($this->name, 'name');
        RequestCheckUtil::checkMaxLength($this->name, 80, 'name');
        RequestCheckUtil::checkMaxLength($this->orgEmail, 100, 'orgEmail');
        RequestCheckUtil::checkMaxLength($this->remark, 2000, 'remark');
        RequestCheckUtil::checkMaxLength($this->telephone, 50, 'telephone');
        RequestCheckUtil::checkMaxLength($this->title, 200, 'title');
        RequestCheckUtil::checkMaxLength($this->userid, 64, 'userid');
        RequestCheckUtil::checkMaxLength($this->workPlace, 100, 'workPlace');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
