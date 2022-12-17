<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求封装类
 *
 * @author auto create
 */
class OpenUpdateWorkPostDTO
{
    /**
     * 用户id
     */
    public $open_id;

    /**
     * 作文批改结果
     */
    public $pigai_analysis;

    /**
     * 作文id
     */
    public $post_id;

    /**
     * 相似度结果
     */
    public $similarity;

    /**
     * 作文id
     */
    public $version_id;

    /**
     * 作业id
     */
    public $work_id;
}
