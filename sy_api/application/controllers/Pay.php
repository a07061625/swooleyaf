<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 17-4-19
 * Time: 下午1:55
 */
class PayController extends CommonController
{
    public function init()
    {
        parent::init();
    }

    /**
     * 发起支付申请
     */
    public function applyPayAction()
    {
        $allParams = \Request\SyRequest::getParams();
        $allParams['session_id'] = SyTool\SySession::getSessionId();
        $applyRes = \SyModule\SyModuleOrder::getInstance()->sendApiReq('/Index/Pay/applyPay', $allParams);
        $this->sendRsp($applyRes);
    }

    /**
     * 处理微信支付通知
     *
     * @api {post} /Index/Pay/handleWxPayNotify 处理微信支付通知
     * @apiDescription 处理微信支付通知
     * @apiGroup Pay
     * @SyFilter-{"field": "__symanager","explain": "接口管理","type": "string","rules": {"sign": 0}}
     */
    public function handleWxPayNotifyAction()
    {
        $wxMsg = SyTool\Tool::getArrayVal($GLOBALS, 'HTTP_RAW_POST_DATA', '');
        SyLog\Log::log('wx pay data:' . $wxMsg);
        $xmlData = SyTool\Tool::xmlToArray($wxMsg);
        if (\Wx\WxUtilAccount::checkSign($xmlData, $xmlData['appid'])) {
            $handleRes = \SyModule\SyModuleOrder::getInstance()->sendApiReq('/Index/Pay/handleWxPayNotify', $xmlData);
            $handleData = SyTool\Tool::jsonDecode($handleRes);
            if (is_array($handleData) && isset($handleData['code']) && ($handleData['code'] == \SyConstant\ErrorCode::COMMON_SUCCESS)) {
                $error = '';
            } else {
                $error = '处理失败';
            }
        } else {
            $error = '签名失败';
        }

        $resXml = '<xml>';
        if (strlen($error) == 0) {
            $resXml .= '<return_code>SUCCESS</return_code>';
        } else {
            $resXml .= '<return_code>FAIL</return_code><return_msg>' . $error . '</return_msg>';
        }
        $resXml .= '</xml>';
        $this->sendRsp($resXml);
    }

    /**
     * 处理微信扫码预支付通知
     *
     * @api {post} /Index/Pay/handleWxPrePayNotify 处理微信扫码预支付通知
     * @apiDescription 处理微信扫码预支付通知
     * @apiGroup Pay
     * @SyFilter-{"field": "__symanager","explain": "接口管理","type": "string","rules": {"sign": 0}}
     */
    public function handleWxPrePayNotifyAction()
    {
        $wxMsg = SyTool\Tool::getArrayVal($GLOBALS, 'HTTP_RAW_POST_DATA', '');
        SyLog\Log::log('wx pre pay data:' . $wxMsg);
        $xmlData = SyTool\Tool::xmlToArray($wxMsg);
        if (\Wx\WxUtilAccount::checkSign($xmlData, $xmlData['appid'])) {
            $handleRes = \SyModule\SyModuleOrder::getInstance()->sendApiReq('/Index/Pay/handleWxPrePayNotify', $xmlData);
            $resData = SyTool\Tool::jsonDecode($handleRes);
            if (is_array($resData) && isset($resData['code']) && ($resData['code'] == \SyConstant\ErrorCode::COMMON_SUCCESS)) {
                $this->sendRsp($resData['data']['result']);
            } else {
                $this->sendRsp('');
            }
        } else {
            $this->sendRsp('');
        }
    }

    /**
     * 处理支付宝付款异步通知消息
     *
     * @api {post} /Index/Pay/handleAliPayNotify 处理支付宝付款异步通知消息
     * @apiDescription 处理支付宝付款异步通知消息
     * @apiGroup Pay
     * @SyFilter-{"field": "__symanager","explain": "接口管理","type": "string","rules": {"sign": 0}}
     * @apiSuccess {String} HandleSuccess 处理成功
     * @apiSuccessExample success:
     *     success
     * @apiSuccess {String} HandleFail 处理失败
     * @apiSuccessExample fail:
     *     fail
     */
    public function handleAliPayNotifyAction()
    {
        $resultMsg = 'fail';
        $allParams = \Request\SyRequest::getParams();
        SyLog\Log::log('ali pay data:' . SyTool\Tool::jsonEncode($allParams, JSON_UNESCAPED_UNICODE));
        if (AliPay\AliPayUtilBase::verifyData($allParams, '2', 'RSA2')) {
            $handleRes = \SyModule\SyModuleOrder::getInstance()->sendApiReq('/Index/Pay/handleAliPayNotify', $allParams);
            $handleData = SyTool\Tool::jsonDecode($handleRes);
            if (is_array($handleData) && isset($handleData['code']) && ($handleData['code'] == \SyConstant\ErrorCode::COMMON_SUCCESS)) {
                $resultMsg = 'success';
            }
        }

        $this->sendRsp($resultMsg);
    }

    /**
     * 处理支付宝网页支付同步回跳地址
     *
     * @api {get} /Index/Pay/handleAliWebRedirect 处理支付宝网页支付同步回跳地址
     * @apiDescription 处理支付宝网页支付同步回跳地址
     * @apiGroup Pay
     * @apiParam {string} url 同步回跳URL地址
     * @SyFilter-{"field": "__symanager","explain": "接口管理","type": "string","rules": {"sign": 0}}
     * @SyFilter-{"field": "url","explain": "同步回跳URL地址","type": "string","rules": {"required": 1,"url": 1}}
     * @apiSuccess {String} HandleSuccess 处理成功
     * @apiSuccessExample success:
     *     HTTP/1.1 302
     *     {
     *         "Location": "http://www.baidu.com"
     *     }
     * @apiSuccess {String} HandleFail 处理失败
     * @apiSuccessExample fail:
     *     跳转地址不正确
     */
    public function handleAliWebRedirectAction()
    {
        $expireTime = SyTool\Tool::getNowTime() + 604800;
        $sessionId = SyTool\SySession::getSessionId();
        $cookieKey = SyTool\SySession::getCookieKey();
        $redirectUrl = \Request\SyRequest::getParams('url');
        \Response\SyResponseHttp::cookie($cookieKey, $sessionId, $expireTime, '/', '');
        \Response\SyResponseHttp::redirect($redirectUrl);
        $this->sendRsp();
    }

    /**
     * 处理支付宝退款异步通知消息
     *
     * @api {post} /Index/Pay/handleAliRefundNotify 处理支付宝退款异步通知消息
     * @apiDescription 处理支付宝退款异步通知消息
     * @apiGroup Pay
     * @SyFilter-{"field": "__symanager","explain": "接口管理","type": "string","rules": {"sign": 0}}
     * @apiSuccess {String} HandleSuccess 处理成功
     * @apiSuccessExample success:
     *     success
     * @apiSuccess {String} HandleFail 处理失败
     * @apiSuccessExample fail:
     *     fail
     */
    public function handleAliRefundNotifyAction()
    {
        $resultMsg = 'fail';
        $allParams = \Request\SyRequest::getParams();
        SyLog\Log::log('ali refund data:' . SyTool\Tool::jsonEncode($allParams, JSON_UNESCAPED_UNICODE));
        if (AliPay\AliPayUtilBase::verifyData($allParams, '2', 'RSA2')) {
            $handleRes = \SyModule\SyModuleOrder::getInstance()->sendApiReq('/Index/Pay/handleAliRefundNotify', $allParams);
            $handleData = SyTool\Tool::jsonDecode($handleRes);
            if (is_array($handleData) && isset($handleData['code']) && ($handleData['code'] == \SyConstant\ErrorCode::COMMON_SUCCESS)) {
                $resultMsg = 'success';
            }
        }

        $this->sendRsp($resultMsg);
    }
}
