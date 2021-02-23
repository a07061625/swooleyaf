<?php

namespace Entities\SyBase;

use DB\Entities\MysqlEntity;

class WxconfigCorpEntity extends MysqlEntity
{
    /**
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
     * 客户端IP
     *
     * @var string
     */
    public $corp_clientip = '';

    /**
     * 商户号
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
     * 公众号商户证书内容，去除证书文件的第一行和最后一行以及所有换行
     *
     * @var string
     */
    public $payssl_cert = '';

    /**
     * 公众号商户密钥内容，去除密钥文件的第一行和最后一行以及所有换行
     *
     * @var string
     */
    public $payssl_key = '';

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

    public function __construct(string $dbTag = '')
    {
        $trueTag = isset($dbTag[0]) ? $dbTag : 'main';
        parent::__construct($trueTag, 'wxconfig_corp', 'id');
    }
}
