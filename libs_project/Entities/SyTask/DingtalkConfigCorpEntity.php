<?php
namespace Entities\SyTask;

use DB\Entities\MysqlEntity;

class DingtalkConfigCorpEntity extends MysqlEntity {
    public function __construct(string $dbName='') {
        $this->_dbName = isset($dbName{0}) ? $dbName : 'sy_task';
        parent::__construct($this->_dbName, 'dingtalk_config_corp', 'id');
    }

    /**
     * 
     * @var int
     */
    public $id = null;

    /**
     * 企业ID
     * @var string
     */
    public $corp_id = '';

    /**
     * 企业应用列表
     * @var string
     */
    public $corp_agents = '';

    /**
     * 免登密钥
     * @var string
     */
    public $sso_secret = '';

    /**
     * 状态
     * @var int
     */
    public $status = 0;

    /**
     * 创建时间戳
     * @var int
     */
    public $created = 0;

    /**
     * 修改时间戳
     * @var int
     */
    public $updated = 0;
}
