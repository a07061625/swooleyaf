<?php
/**
 * 生活号广告位查询接口
 * User: 姜伟
 * Date: 2018/11/1 0001
 * Time: 15:02
 */
namespace AliPay\Life;

use AliPay\AliPayBase;

class AdvertQueryBatch extends AliPayBase
{
    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setMethod('alipay.open.public.advert.batchquery');
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        return $this->getContent();
    }
}
