<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/12 0012
 * Time: 13:45
 */
namespace SyPay;

use DesignPatterns\Singletons\PayConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Pay\UnionException;
use SyTool\Tool;
use SyTrait\SimpleTrait;

/**
 * Class UtilUnionChannels
 *
 * @package SyPay
 */
final class UtilUnionChannels extends UtilUnion
{
    use SimpleTrait;

    private static $htmlTemplate = <<<'HTML'
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>支付</title>
</head>
<body>
    <div style="text-align:center">跳转中...</div>
    <form id="pay_form" name="pay_form" action="%s" method="post">
        %s
    </form>
    <script type="text/javascript">
        document.onreadystatechange = function(){
            if(document.readyState == "complete") {
                document.pay_form.submit();
            }
        };
    </script>
</body>
</html>
HTML;

    /**
     * 生成签名
     *
     * @param string $merId 商户号
     * @param array  $data  待签名数据
     *
     * @throws \SyException\Pay\UnionException
     */
    public static function createSign(string $merId, array &$data)
    {
        $signStr = self::getSignStr($data);
        $sha1Str = sha1(substr($signStr, 1), false);
        $sign = '';
        $config = PayConfigSingleton::getInstance()->getUnionChannelsConfig($merId);
        if (!openssl_sign($sha1Str, $sign, $config->getCertPrivateKey(), OPENSSL_ALGO_SHA1)) {
            throw new UnionException('银联支付生成签名出错', ErrorCode::PAY_UNION_PARAM_ERROR);
        }

        $data['signature'] = base64_encode($sign);
    }

    /**
     * 校验签名
     *
     * @param string $merId 商户号
     * @param array  $data  待校验数据
     *
     * @return bool
     *
     * @throws \SyException\Pay\UnionException
     */
    public static function verifySign(string $merId, array $data) : bool
    {
        $config = PayConfigSingleton::getInstance()->getUnionChannelsConfig($merId);
        if ($config->getCertPrivateId() != $data['certId']) {
            return false;
        }

        $nowSign = $data['signature'];
        $signStr = self::getSignStr($data);
        $sha1Str = sha1($signStr, false);
        $verifyRes = openssl_verify($sha1Str, base64_decode($nowSign), $config->getCertPublicKey(), OPENSSL_ALGO_SHA1);

        return $verifyRes == 1;
    }

    /**
     * 生成请求页面
     *
     * @param string $frontUrl 请求前端地址
     * @param array  $data     数据
     *
     * @return string
     */
    public static function createHtml(string $frontUrl, array $data) : string
    {
        $formHtml = '';
        foreach ($data as $key => $item) {
            $formHtml .= '<input type="hidden" name="' . $key . '" value="' . $item . '">';
        }

        return sprintf(self::$htmlTemplate, $frontUrl, $formHtml);
    }

    /**
     * @param \SyPay\BaseUnionChannels $channelsObj
     *
     * @return array
     *
     * @throws \SyException\Common\CheckException
     */
    public static function sendServerRequest(BaseUnionChannels $channelsObj)
    {
        $resArr = [
            'code' => ErrorCode::COMMON_SUCCESS,
        ];

        $curlConfigs = $channelsObj->getDetail();
        $sendRes = Tool::sendCurlReq($curlConfigs);
        if ($sendRes['res_no'] > 0) {
            $resArr['code'] = ErrorCode::PAY_UNION_REQ_ERROR;
            $resArr['msg'] = $sendRes['res_msg'];

            return $resArr;
        }

        $rspData = Tool::jsonDecode($sendRes['res_content']);
        if (isset($rspData['respCode'])) {
            $resArr['data'] = $rspData;
        } else {
            $resArr['code'] = ErrorCode::PAY_UNION_REQ_ERROR;
            $resArr['msg'] = $sendRes['res_content'];
        }

        return $resArr;
    }
}
