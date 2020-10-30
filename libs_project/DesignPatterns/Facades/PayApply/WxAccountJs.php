<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-5
 * Time: 上午12:28
 */
namespace DesignPatterns\Facades\PayApply;

use DesignPatterns\Facades\PayApplyFacade;
use SyConstant\ErrorCode;
use SyConstant\ProjectCode;
use SyException\Common\CheckException;
use SyTool\SyUser;
use SyTool\Tool;
use SyTrait\SimpleFacadeTrait;
use Wx\Payment\Way\UnifiedOrder;
use Wx\WxUtilBase;

class WxAccountJs extends PayApplyFacade
{
    use SimpleFacadeTrait;

    protected static function checkParams(array $data) : array
    {
        $wxOpenid = SyUser::getOpenId();
        if (strlen($wxOpenid) == 0) {
            throw new CheckException('请先微信登录', ProjectCode::USER_NOT_LOGIN_WX_AUTH);
        }

        return [
            'a00_openid' => $wxOpenid,
            'a00_appid' => Tool::getConfig('project.' . SY_ENV . SY_PROJECT . '.wx.appid.default'),
        ];
    }

    protected static function apply(array $data) : array
    {
        $profitSharingStatus = (int)Tool::getArrayVal($data['content_result'], 'pay_ps', 0);
        if ($profitSharingStatus == 0) {
            $order = new UnifiedOrder($data['a00_appid'], UnifiedOrder::TRADE_TYPE_JSAPI);
        } else {
            $order = new UnifiedOrder($data['a00_appid'], UnifiedOrder::TRADE_TYPE_JSAPI, UnifiedOrder::MERCHANT_TYPE_SUB);
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
        $order->setOpenid($data['a00_openid']);
        $order->setPlatType(WxUtilBase::PLAT_TYPE_SHOP);
        $applyRes = $order->getDetail();
        unset($order);
        if ($applyRes['code'] > 0) {
            throw new CheckException($applyRes['message'], ErrorCode::COMMON_PARAM_ERROR);
        }

        return [
            'api' => $applyRes['data']['pay'],
            'config' => $applyRes['data']['config'],
        ];
    }
}
