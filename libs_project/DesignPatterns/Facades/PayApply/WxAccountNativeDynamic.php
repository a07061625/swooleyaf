<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-5
 * Time: 上午12:42
 */
namespace DesignPatterns\Facades\PayApply;

use DesignPatterns\Facades\PayApplyFacade;
use SyConstant\ErrorCode;
use SyException\Common\CheckException;
use SyTool\Tool;
use SyTrait\SimpleFacadeTrait;
use Wx\Payment\Way\UnifiedOrder;

class WxAccountNativeDynamic extends PayApplyFacade
{
    use SimpleFacadeTrait;

    protected static function checkParams(array $data) : array
    {
        return [
            'a00_appid' => Tool::getConfig('project.' . SY_ENV . SY_PROJECT . '.wx.appid.default'),
        ];
    }

    protected static function apply(array $data) : array
    {
        $profitSharingStatus = (int)Tool::getArrayVal($data['content_result'], 'pay_ps', 0);
        if ($profitSharingStatus == 0) {
            $order = new UnifiedOrder($data['a00_appid'], UnifiedOrder::TRADE_TYPE_NATIVE);
        } else {
            $order = new UnifiedOrder($data['a00_appid'], UnifiedOrder::TRADE_TYPE_NATIVE, UnifiedOrder::MERCHANT_TYPE_SUB);
            if ($profitSharingStatus == 1) {
                $order->setProfitSharing('N');
            } else {
                $order->setProfitSharing('Y');
            }
        }
        $order->setBody($data['content_result']['pay_name']);
        $order->setTotalFee($data['content_result']['pay_money']);
        $order->setOutTradeNo($data['content_result']['pay_sn']);
        $order->setAttach($data['content_result']['pay_attach']);
        $applyRes = $order->getDetail();
        unset($order);
        if ($applyRes['code'] > 0) {
            throw new CheckException($applyRes['message'], ErrorCode::COMMON_PARAM_ERROR);
        }

        return [
            'code_url' => $applyRes['data']['code_url']
        ];
    }
}
