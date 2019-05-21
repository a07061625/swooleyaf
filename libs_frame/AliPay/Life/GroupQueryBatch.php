<?php
/**
 * 查询用户分组列表
 * User: 姜伟
 * Date: 2018/11/1 0001
 * Time: 14:42
 */
namespace AliPay\Life;

use AliPay\AliPayBase;

class GroupQueryBatch extends AliPayBase
{
    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setMethod('alipay.open.public.group.batchquery');
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        return $this->getContent();
    }
}
