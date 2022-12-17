<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 教育列表
 *
 * @author auto create
 */
class TextbookMetadataDTO
{
    /**
     * 教材id
     */
    public $id;

    /**
     * 层级
     */
    public $level;

    /**
     * 父id
     */
    public $parent_id;

    /**
     * 备注
     */
    public $remark;

    /**
     * 系统自动生成
     */
    public $status;

    /**
     * 学科编码
     */
    public $subject_code;

    /**
     * 教材编码
     */
    public $textbook_code;

    /**
     * 教材版本名称
     */
    public $textbook_name;
}
