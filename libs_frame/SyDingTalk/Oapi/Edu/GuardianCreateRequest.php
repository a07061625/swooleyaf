<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.guardian.create request
 *
 * @author auto create
 *
 * @since 1.0, 2021.04.15
 */
class GuardianCreateRequest extends BaseRequest
{
    /**
     * 业务id
     */
    private $bizId;
    /**
     * 班级id
     */
    private $classId;
    /**
     * 手机号码
     */
    private $mobile;
    /**
     * 钉钉企业管理员
     */
    private $operator;
    /**
     * 关系code；关系枚举如下：  F:爸爸  M：妈妈  GF:爷爷  GM:奶奶  GFA:外公  GMA:外婆  U:叔叔  A:阿姨  B：哥哥  S:姐姐  O:其他
     */
    private $relation;
    /**
     * 学生id
     */
    private $stuId;

    public function setBizId($bizId)
    {
        $this->bizId = $bizId;
        $this->apiParas['biz_id'] = $bizId;
    }

    public function getBizId()
    {
        return $this->bizId;
    }

    public function setClassId($classId)
    {
        $this->classId = $classId;
        $this->apiParas['class_id'] = $classId;
    }

    public function getClassId()
    {
        return $this->classId;
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

    public function setOperator($operator)
    {
        $this->operator = $operator;
        $this->apiParas['operator'] = $operator;
    }

    public function getOperator()
    {
        return $this->operator;
    }

    public function setRelation($relation)
    {
        $this->relation = $relation;
        $this->apiParas['relation'] = $relation;
    }

    public function getRelation()
    {
        return $this->relation;
    }

    public function setStuId($stuId)
    {
        $this->stuId = $stuId;
        $this->apiParas['stu_id'] = $stuId;
    }

    public function getStuId()
    {
        return $this->stuId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.guardian.create';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->classId, 'classId');
        RequestCheckUtil::checkNotNull($this->mobile, 'mobile');
        RequestCheckUtil::checkNotNull($this->operator, 'operator');
        RequestCheckUtil::checkNotNull($this->relation, 'relation');
        RequestCheckUtil::checkNotNull($this->stuId, 'stuId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
