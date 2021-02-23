<?php

namespace Entities\SyBase;

use DB\Entities\MysqlEntity;

class AttachmentReferEntity extends MysqlEntity
{
    /**
     * 引用ID
     *
     * @var int
     */
    public $id;

    /**
     * 上传文件名
     *
     * @var string
     */
    public $upload_name = '';

    /**
     * 附件ID
     *
     * @var int
     */
    public $attach_id = 0;

    /**
     * 上传用户ID
     *
     * @var string
     */
    public $uid = '';

    /**
     * 引用时间
     *
     * @var int
     */
    public $created = 0;

    public function __construct(string $dbTag = '')
    {
        $trueTag = isset($dbTag[0]) ? $dbTag : 'main';
        parent::__construct($trueTag, 'attachment_refer', 'id');
    }
}
