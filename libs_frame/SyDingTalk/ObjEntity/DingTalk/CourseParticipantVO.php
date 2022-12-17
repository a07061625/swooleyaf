<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * list
 *
 * @author auto create
 */
class CourseParticipantVO
{
    /**
     * 参与方的组织CorpId
     */
    public $participant_corpid;

    /**
     * 参与方ID。participant_type=1时，participant_id表示用户ID；participant_type=2时，participant_id表示部门ID；participant_type=3时，participant_id表示组织ID；
     */
    public $participant_id;

    /**
     * 参与方名称
     */
    public $participant_name;

    /**
     * 参与方类型。1：用户、2：部门（对应家校通讯录中的班级、年级。详情请参考https://ding-doc.dingtalk.com/doc#/serverapi3/gga05a/z3y0h）、3：组织
     */
    public $participant_type;

    /**
     * 参与方角色。student：学生、teacher：老师、guardian: 监护人
     */
    public $role;
}
