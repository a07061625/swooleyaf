<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 9:36
 */
namespace SyPay\Union\Channels\Mobile;

use SyPay\Union\Channels\BaseMobile;

/**
 * 银联加密公钥更新查询接口
 * 商户定期(1天1次)向银联全渠道系统发起获取加密公钥信息交易
 * 在加密公钥证书更新期间,全渠道系统支持新老证书的共同使用,新老证书并行期为1个月
 * 全渠道系统向商户返回最新的加密公钥证书,由商户服务器替换本地证书
 * @package SyPay\Union\Channels\Mobile
 */
class CertQuery extends BaseMobile
{
    public function __construct(string $merId, string $envType)
    {
        parent::__construct($merId, $envType);
    }

    public function __clone()
    {
    }

    public function getDetail() : array
    {
        // TODO: Implement getDetail() method.
    }
}
