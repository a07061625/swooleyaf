<?php
namespace Entities\SyBase;

use DB\Entities\MysqlEntity;

class DingtalkConfigCorpEntity extends MysqlEntity
{
    /**
     *
     * @var int
     */
    public $id;

    /**
     * 企业ID
     *
     * @var string
     */
    public $corp_id = '';

    /**
     * 企业应用列表
     *
     * @var string
     */
    public $corp_agents = '';

    /**
     * 免登密钥
     *
     * @var string
     */
    public $sso_secret = '';

    /**
     * 登陆应用ID
     *
     * @var string
     */
    public $login_app_id = '';

    /**
     * 登陆应用密钥
     *
     * @var string
     */
    public $login_app_secret = '';

    /**
     * 登陆应用回调地址
     *
     * @var string
     */
    public $login_url_callback = '';

    /**
     * 状态
     *
     * @var int
     */
    public $status = 0;

    /**
     * 创建时间戳
     *
     * @var int
     */
    public $created = 0;

    /**
     * 修改时间戳
     *
     * @var int
     */
    public $updated = 0;
    public function __construct(string $dbName = '')
    {
        $this->_dbName = isset($dbName[0]) ? $dbName : 'sy_base';
        parent::__construct($this->_dbName, 'dingtalk_config_corp', 'id');
    }
}
