<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 人脸列表
 *
 * @author auto create
 */
class Faces
{
    /**
     * 来自录入还是标记
     */
    public $face_type;

    /**
     * 人脸相似度
     */
    public $score;

    /**
     * 标签id
     */
    public $tag_id;

    /**
     * 用户id
     */
    public $userid;
}
