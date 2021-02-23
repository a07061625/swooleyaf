<?php

namespace Entities\SyBase;

use DB\Entities\MysqlEntity;

class AliconfigPayEntity extends MysqlEntity
{
    /**
     * 主键ID
     *
     * @var int
     */
    public $id;

    /**
     * app id
     *
     * @var string
     */
    public $app_id = '';

    /**
     * 卖家ID
     *
     * @var string
     */
    public $seller_id = '';

    /**
     * 异步消息通知URL
     *
     * @var string
     */
    public $url_notify = '';

    /**
     * 同步消息通知URL
     *
     * @var string
     */
    public $url_return = '';

    /**
     * rsa私钥，去除证书文件的第一行和最后一行以及所有换行
     *
     * @var string
     */
    public $prikey_rsa = '';

    /**
     * rsa公钥，去除证书文件的第一行和最后一行以及所有换行
     *
     * @var string
     */
    public $pubkey_rsa = '';

    /**
     * 支付宝公钥，去除证书文件的第一行和最后一行以及所有换行
     *
     * @var string
     */
    public $pubkey_ali = '';

    /**
     * 状态
     *
     * @var int
     */
    public $status = 1;

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

    public function __construct(string $dbTag = '')
    {
        $trueTag = isset($dbTag[0]) ? $dbTag : 'main';
        parent::__construct($trueTag, 'aliconfig_pay', 'id');
    }
}
