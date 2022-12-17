<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 年级id，有可能会空列表，需要通过读接口查询
 *
 * @author auto create
 */
class EduGradeDo
{
    /**
     * 校区id
     */
    public $campus_id;

    /**
     * 年级id
     */
    public $dept_id;

    /**
     * 年级等级
     */
    public $grade;

    /**
     * 年级名
     */
    public $name;

    /**
     * 学段id
     */
    public $super_id;
}
