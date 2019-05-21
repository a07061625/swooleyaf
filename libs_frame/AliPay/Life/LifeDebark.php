<?php
/**
 * 下架生活号
 * User: 姜伟
 * Date: 2018/11/1 0001
 * Time: 14:37
 */
namespace AliPay\Life;

use AliPay\AliPayBase;

class LifeDebark extends AliPayBase
{
    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setMethod('alipay.open.public.life.debark.apply');
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        return $this->getContent();
    }
}
