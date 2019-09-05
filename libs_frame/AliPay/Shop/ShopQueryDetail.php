<?php
/**
 * 查询单个门店信息接口
 * User: 姜伟
 * Date: 2018/11/2 0002
 * Time: 9:07
 */
namespace AliPay\Shop;

use AliPay\AliPayBase;
use SyConstant\ErrorCode;
use SyException\AliPay\AliPayShopException;

class ShopQueryDetail extends AliPayBase
{
    /**
     * 门店ID
     * @var string
     */
    private $shop_id = '';
    /**
     * 操作人角色
     * @var string
     */
    private $op_role = '';

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setMethod('alipay.offline.market.shop.querydetail');
    }

    private function __clone()
    {
    }

    /**
     * @param string $shopId
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setShopId(string $shopId)
    {
        if (ctype_digit($shopId) && (strlen($shopId) <= 32)) {
            $this->biz_content['shop_id'] = $shopId;
        } else {
            throw new AliPayShopException('门店ID不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @param string $opRole
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setOpRole(string $opRole)
    {
        if (in_array($opRole, ['MERCHANT', 'PROVIDER'], true)) {
            $this->biz_content['op_role'] = $opRole;
        } else {
            throw new AliPayShopException('操作人角色不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->biz_content['shop_id'])) {
            throw new AliPayShopException('门店ID不能为空', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
