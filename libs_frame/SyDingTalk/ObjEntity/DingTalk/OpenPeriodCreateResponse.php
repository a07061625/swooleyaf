<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 返回结果值
 *
 * @author auto create
 */
class OpenPeriodCreateResponse
{
    /**
     * 学段id
     */
    public $dept_id;

    /**
     * 年级id，有可能会空列表，需要通过读接口查询
     */
    public $grades;
}
