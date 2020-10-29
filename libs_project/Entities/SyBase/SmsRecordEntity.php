<?php
namespace Entities\SyBase;

use DB\Entities\MysqlEntity;

class SmsRecordEntity extends MysqlEntity
{
    /**
     *
     * @var int
     */
    public $id;

    /**
     * 发送类型 1:验证码 2:短信
     *
     * @var int
     */
    public $send_type = 0;

    /**
     * 内容类型
     *
     * @var int
     */
    public $content_type = 0;

    /**
     * 接收者
     *
     * @var string
     */
    public $receiver = '';

    /**
     * 模板ID
     *
     * @var string
     */
    public $template_id = '';

    /**
     * 模板内容,json格式
     *
     * @var string
     */
    public $template_content = '';

    /**
     * 状态
     *
     * @var int
     */
    public $status = 0;

    /**
     * 备注信息
     *
     * @var string
     */
    public $remark = '';

    /**
     * 创建时间戳
     *
     * @var int
     */
    public $created = 0;
    public function __construct(string $dbName = '')
    {
        $this->_dbName = isset($dbName[0]) ? $dbName : 'sy_base';
        parent::__construct($this->_dbName, 'sms_record', 'id');
    }
}
