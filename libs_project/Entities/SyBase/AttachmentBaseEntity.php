<?php
namespace Entities\SyBase;

use DB\Entities\MysqlEntity;

class AttachmentBaseEntity extends MysqlEntity
{
    /**
     * 附件ID
     *
     * @var int
     */
    public $id;

    /**
     * 附件SHA1值
     *
     * @var string
     */
    public $sha1 = '';

    /**
     * 附件MIME类型
     *
     * @var string
     */
    public $mime_type = '';

    /**
     * 附件大小,以B为单位
     *
     * @var int
     */
    public $size = 0;

    /**
     * 存放路径
     *
     * @var string
     */
    public $path = '';

    /**
     * 引用次数
     *
     * @var int
     */
    public $refer_num = 1;

    /**
     * 上传时间
     *
     * @var int
     */
    public $created = 0;
    public function __construct(string $dbName = '')
    {
        $this->_dbName = isset($dbName[0]) ? $dbName : 'sy_base';
        parent::__construct($this->_dbName, 'attachment_base', 'id');
    }
}
