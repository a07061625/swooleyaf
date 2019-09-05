<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/9/18 0018
 * Time: 14:41
 */
namespace Interfaces\Impl\Pay;

use SyConstant\ErrorCode;
use SyConstant\Project;
use SyException\Common\CheckException;
use Interfaces\PayBase;
use Interfaces\PayService;
use Request\SyRequest;

class OrderGoods extends PayBase implements PayService
{
    public function __construct()
    {
        $this->payType = Project::ORDER_PAY_TYPE_GOODS;
    }

    private function __clone()
    {
    }

    public function checkPayParams() : array
    {
        $orderSn = trim(SyRequest::getParams('goods_ordersn', ''));
        if (strlen($orderSn) == 0) {
            throw new CheckException('订单单号不能为空', ErrorCode::COMMON_PARAM_ERROR);
        }

        return [
            'order_sn' => $orderSn,
        ];
    }

    public function getPayInfo(array $data) : array
    {
        // TODO: Implement getPayInfo() method.
    }

    public function handlePaySuccess(array $data) : array
    {
        // TODO: Implement handlePaySuccess() method.
    }

    public function handlePaySuccessAttach(array $data)
    {
        // TODO: Implement handlePaySuccessAttach() method.
    }
}
