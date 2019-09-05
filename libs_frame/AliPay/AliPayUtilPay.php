<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/6 0006
 * Time: 14:19
 */
namespace AliPay;

use AliPay\Pay\PayWap;
use SyTrait\SimpleTrait;

final class AliPayUtilPay extends AliPayUtilBase
{
    use SimpleTrait;

    /**
     * 生成网页支付表单
     * @param \AliPay\Pay\PayWap $wap
     * @return string
     */
    public static function createWapPayHtml(PayWap $wap) : string
    {
        $data = $wap->getDetail();
        $html = '<form id="' . $wap->getFormId() . '" name="' . $wap->getFormId() . '" action="' . self::$urlGateWay . '?charset=utf-8" method="POST">';
        foreach ($data as $key => $eData) {
            if (false === self::checkEmpty($eData)) {
                $val = str_replace("'", '&apos;', $eData);
                $html .= '<input type="hidden" name="' . $key . '" value="' . $val . '" />';
            }
        }
        $html .= '<input type="submit" value="ok" style="display:none;"/></form><script>document.forms["' . $wap->getFormId() . '"].submit();</script>';
        return $html;
    }
}
