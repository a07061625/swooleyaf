<?php
namespace Entities\SyBase;

use DB\Entities\MysqlEntity;

class WxproviderCorpAuthorizerEntity extends MysqlEntity
{
    /**
     * 主键ID
     *
     * @var int
     */
    public $id;

    /**
     * 套件ID
     *
     * @var string
     */
    public $suite_id = '';

    /**
     * 授权企业号ID
     *
     * @var string
     */
    public $authorizer_corpid = '';

    /**
     * 企业号授权码
     *
     * @var string
     */
    public $authorizer_authcode = '';

    /**
     * 企业号永久授权码
     *
     * @var string
     */
    public $authorizer_permanentcode = '';

    /**
     * 企业号允许权限
     *
     * @var string
     */
    public $authorizer_allowpower = '';

    /**
     * 企业号信息详情
     *
     * @var string
     */
    public $authorizer_info = '';

    /**
     * 企业号状态 0:取消授权 1:允许授权
     *
     * @var int
     */
    public $authorizer_status = 0;

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
        parent::__construct($this->_dbName, 'wxprovider_corp_authorizer', 'id');
    }
}
