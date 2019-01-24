<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-5
 * Time: 上午12:42
 */
namespace DesignPatterns\Facades\PayApply;

use Constant\ErrorCode;
use DesignPatterns\Facades\PayApplyFacade;
use Exception\Common\CheckException;
use Tool\Tool;
use Traits\SimpleFacadeTrait;
use Wx\Shop\Pay\UnifiedOrder;

class WxShopNativeDynamic extends PayApplyFacade {
    use SimpleFacadeTrait;

    protected static function checkParams(array $data) : array {
        return [
            'a00_appid' => Tool::getConfig('project.' . SY_ENV . SY_PROJECT . '.wx.appid.default'),
        ];
    }

    protected static function apply(array $data) : array {
        $order = new UnifiedOrder($data['a00_appid'], UnifiedOrder::TRADE_TYPE_NATIVE);
        $order->setBody($data['content_result']['pay_name']);
        $order->setTotalFee($data['content_result']['pay_money']);
        $order->setOutTradeNo($data['content_result']['pay_sn']);
        $order->setAttach($data['content_result']['pay_attach']);
        $applyRes = $order->getDetail();
        unset($order);
        if($applyRes['code'] > 0){
            throw new CheckException($applyRes['message'], ErrorCode::COMMON_PARAM_ERROR);
        }

        return [
            'code_url' => $applyRes['data']['code_url']
        ];
    }
}