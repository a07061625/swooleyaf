<?php
namespace Entities\SyBase;

use DB\Entities\MysqlEntity;

class WxopenAuthorizerEntity extends MysqlEntity
{
    /**
     * 主键ID
     *
     * @var int
     */
    public $id;

    /**
     * 开放平台appid
     *
     * @var string
     */
    public $component_appid = '';

    /**
     * 授权公众号appid
     *
     * @var string
     */
    public $authorizer_appid = '';

    /**
     * 公众号授权码
     *
     * @var string
     */
    public $authorizer_authcode = '';

    /**
     * 公众号刷新令牌
     *
     * @var string
     */
    public $authorizer_refreshtoken = '';

    /**
     * 公众号允许权限
     *
     * @var string
     */
    public $authorizer_allowpower = '';

    /**
     * 公众号信息详情
     *
     * @var string
     */
    public $authorizer_info = '';

    /**
     * 公众号状态 0:取消授权 1:允许授权
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
        parent::__construct($this->_dbName, 'wxopen_authorizer', 'id');
    }
}
