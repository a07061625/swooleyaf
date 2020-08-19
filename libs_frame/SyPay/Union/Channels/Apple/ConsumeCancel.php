<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 8:47
 */
namespace SyPay\Union\Channels\Apple;

use SyPay\Union\Channels\BaseApple;

/**
 * 消费撤销接口
 * 因人为原因而撤销已完成的消费,商户可以通过SDK向银联全渠道支付平台发起消费撤销交易,消费撤销必须是撤销CUPS当日当批的消费
 * 发卡行批准的消费撤销金额将即时地反映到该持卡人的账户上
 * 完成交易的过程不需要同持卡人交互,属于后台交易
 *
 * @package SyPay\Union\Channels\Apple
 */
class ConsumeCancel extends BaseApple
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
