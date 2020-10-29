<?php
namespace Entities\SyBase;

use DB\Entities\MysqlEntity;

class WxconfigBaseEntity extends MysqlEntity
{
    /**
     *
     * @var int
     */
    public $id;

    /**
     * 微信公众号ID
     *
     * @var string
     */
    public $app_id = '';

    /**
     * 微信公众号密钥
     *
     * @var string
     */
    public $app_secret = '';

    /**
     * 客户端IP
     *
     * @var string
     */
    public $app_clientip = '';

    /**
     * 消息模板ID列表
     *
     * @var string
     */
    public $app_templates = '';

    /**
     * 原始ID
     *
     * @var string
     */
    public $origin_id = '';

    /**
     * 微信商户号
     *
     * @var string
     */
    public $pay_mchid = '';

    /**
     * 微信支付密钥
     *
     * @var string
     */
    public $pay_key = '';

    /**
     * 公众号商户证书内容,去除证书文件的第一行和最后一行以及所有换行
     *
     * @var string
     */
    public $payssl_cert = '';

    /**
     * 公众号商户密钥内容,去除密钥文件的第一行和最后一行以及所有换行
     *
     * @var string
     */
    public $payssl_key = '';

    /**
     * 公众号商户证书序列号
     *
     * @var string
     */
    public $payssl_serialno = '';

    /**
     * 企业付款银行卡密钥内容,去除密钥文件的第一行和最后一行以及所有换行
     *
     * @var string
     */
    public $payssl_companybank = '';

    /**
     * 服务商微信号
     *
     * @var string
     */
    public $merchant_appid = '';

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
        parent::__construct($this->_dbName, 'wxconfig_base', 'id');
    }
}
