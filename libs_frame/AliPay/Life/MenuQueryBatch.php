<?php
/**
 * 菜单列表查询接口
 * User: 姜伟
 * Date: 2018/11/1 0001
 * Time: 16:56
 */
namespace AliPay\Life;

use AliPay\AliPayBase;

class MenuQueryBatch extends AliPayBase
{
    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setMethod('alipay.open.public.menu.batchquery');
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        return $this->getContent();
    }
}
