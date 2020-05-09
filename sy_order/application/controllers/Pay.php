<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 17-4-19
 * Time: 下午1:26
 */
class PayController extends CommonController
{
    public function init()
    {
        parent::init();
    }

    /**
     * 申请支付
     * @api {post} /Index/Pay/applyPay 申请支付
     * @apiDescription 申请支付
     * @apiGroup Pay
     * @apiParam {string} pay_type 支付类型 a000:微信公众号JS a001:微信公众号动态二维码 a002:微信公众号静态二维码 a003:微信小程序JS a100:支付宝二维码 a101:支付宝网页
     * @apiParam {string} pay_content 支付内容 1000:商品订单
     * @apiParam {string} pay_hash 支付hash,用于防止因客户端网络不好,连续多次申请
     * @apiParam {string} [a01_timeout] 支付宝订单过期时间
     * @apiParam {string} [a01_returnurl] 支付宝同步通知链接
     * @apiParam {string} [goods_ordersn] 商品订单单号
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "pay_type","explain": "支付类型","type": "string","rules": {"required": 1,"min": 4,"max": 4}}
     * @SyFilter-{"field": "pay_content","explain": "支付内容","type": "string","rules": {"required": 1,"min": 4,"max": 4}}
     * @SyFilter-{"field": "pay_hash","explain": "支付hash","type": "string","rules": {"required": 1,"min": 32,"max": 32,"alnum": 1}}
     * @SyFilter-{"field": "a01_timeout","explain": "订单过期时间","type": "string","rules": {"min": 0,"max": 20}}
     * @SyFilter-{"field": "a01_returnurl","explain": "同步通知链接","type": "string","rules": {"url": 1}}
     * @SyFilter-{"field": "goods_ordersn","explain": "订单单号","type": "string","rules": {"min": 10,"max": 32}}
     * @apiUse RequestSession
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function applyPayAction()
    {
        $needParams = [
            'pay_type' => trim(\Request\SyRequest::getParams('pay_type')),
            'pay_content' => trim(\Request\SyRequest::getParams('pay_content')),
            'pay_hash' => (string)\Request\SyRequest::getParams('pay_hash'),
        ];
        $applyRes = \Dao\PayDao::applyPay($needParams);
        $this->SyResult->setData($applyRes);
        $this->sendRsp();
    }

    /**
     * 处理微信支付通知
     */
    public function handleWxPayNotifyAction()
    {
        $allParams = \Request\SyRequest::getParams();
        $wxResultCode = (string)\SyTool\Tool::getArrayVal($allParams, 'result_code', '');
        $wxReturnCode = (string)\SyTool\Tool::getArrayVal($allParams, 'return_code', '');
        if (($wxResultCode == 'SUCCESS') && ($wxReturnCode == 'SUCCESS')) { //支付成功
            \Dao\PayDao::completePay([
                'pay_type' => \SyConstant\Project::PAY_WAY_WX,
                'pay_tradesn' => $allParams['transaction_id'],
                'pay_sellersn' => $allParams['out_trade_no'],
                'pay_appid' => $allParams['sub_appid'] ?? $allParams['appid'],
                'pay_buyerid' => $allParams['sub_openid'] ?? $allParams['openid'],
                'pay_money' => (int)$allParams['total_fee'],
                'pay_attach' => \SyTool\Tool::getArrayVal($allParams, 'attach', ''),
                'pay_status' => $wxReturnCode,
                'pay_data' => $allParams,
            ]);
            $this->SyResult->setData([
                'msg' => '支付成功',
            ]);
        } elseif ($wxResultCode == 'SUCCESS') { //业务出错
            $this->SyResult->setCodeMsg(\SyConstant\ErrorCode::COMMON_SERVER_ERROR, $allParams['err_code_des']);
        } else { //通信出错
            $this->SyResult->setCodeMsg(\SyConstant\ErrorCode::COMMON_SERVER_ERROR, $allParams['return_msg']);
        }

        $this->sendRsp();
    }

    /**
     * 处理微信扫码预支付通知
     */
    public function handleWxPrePayNotifyAction()
    {
        $appId = (string)\Request\SyRequest::getParams('appid');
        $productId = (string)\Request\SyRequest::getParams('product_id', '');
        $returnObj = new \Wx\Payment\Way\NativeReturn($appId);
        $redisKey = \SyConstant\Project::REDIS_PREFIX_WX_NATIVE_PRE . $productId;
        $cacheData = \DesignPatterns\Factories\CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if (is_array($cacheData) && isset($cacheData['cache_key']) && ($cacheData['cache_key'] == $redisKey)) {
            $nonceStr = (string)\Request\SyRequest::getParams('nonce_str');
            //生成一条新的单号记录
            $orderSn = substr($productId, 0, 4) . \SyTool\Tool::createUniqueId();
            //统一下单
            $order = new \Wx\Payment\Way\UnifiedOrder($appId, \Wx\Payment\Way\UnifiedOrder::TRADE_TYPE_NATIVE);
            $order->setBody($cacheData['pay_name']);
            $order->setOutTradeNo($orderSn);
            $order->setTotalFee($cacheData['pay_money']);
            $order->setAttach($cacheData['pay_attach']);
            $applyRes = $order->getDetail();
            unset($order);
            if ($applyRes['code'] == 0) {
                $returnObj->setNonceStr($nonceStr);
                $returnObj->setPrepayId($applyRes['data']['prepay_id']);
            } else {
                $returnObj->setErrorMsg($applyRes['message'], $applyRes['message']);
            }
        } else {
            $returnObj->setErrorMsg('支付信息不存在', '支付信息不存在');
        }

        //返回结果
        $resData = $returnObj->getDetail();
        unset($returnObj);
        $this->SyResult->setData([
            'result' => \SyTool\Tool::arrayToXml($resData),
        ]);
        $this->sendRsp();
    }

    /**
     * 处理支付宝退款异步通知消息
     */
    public function handleAliRefundNotifyAction()
    {
        $allParams = \Request\SyRequest::getParams();
        if ($allParams['notify_type'] == 'batch_refund_notify') { //即时到账批量退款
            $needData = [
                'refund_sn' => $allParams['batch_no'],
                'list' => []
            ];
            $dataArr = explode('#', $allParams['result_details']);
            foreach ($dataArr as $eData) {
                $eData1 = explode('$', $eData);
                $eData2 = explode('^', $eData1[0]);
                $needData['list'][] = [
                    'order_sn' => $eData2[0] . '',
                    'refund_money' => number_format($eData2[1], 2, '.', '') . '',
                    'refund_status' => $eData2[2]
                ];
            }

            //TODO: 处理退款数据
        }

        $this->SyResult->setData([
            'msg' => '退款处理成功',
        ]);
        $this->sendRsp();
    }

    /**
     * 处理支付宝付款异步通知消息
     */
    public function handleAliPayNotifyAction()
    {
        $allParams = \Request\SyRequest::getParams();
        if (($allParams['notify_type'] == 'trade_status_sync') && in_array($allParams['trade_status'], ['TRADE_SUCCESS', 'TRADE_FINISHED',], true)) {
            if (isset($allParams['payment_type'])) { //网页支付
                $payMoney = isset($allParams['total_fee']) && is_numeric($allParams['total_fee']) ? (int)bcadd($allParams['total_fee'] * 100, 0, 0) : 0;
            } else { //二维码支付
                if (isset($allParams['buyer_pay_amount']) && is_numeric($allParams['buyer_pay_amount'])) {
                    $payMoney = (int)bcadd($allParams['buyer_pay_amount'] * 100, 0, 0);
                } elseif (isset($allParams['total_amount']) && is_numeric($allParams['total_amount'])) {
                    $payMoney = (int)bcadd($allParams['total_amount'] * 100, 0, 0);
                } else {
                    $payMoney = 0;
                }
            }

            \Dao\PayDao::completePay([
                'pay_type' => \SyConstant\Project::PAY_WAY_ALI,
                'pay_tradesn' => $allParams['trade_no'],
                'pay_sellersn' => $allParams['out_trade_no'],
                'pay_appid' => $allParams['app_id'],
                'pay_buyerid' => $allParams['buyer_id'],
                'pay_money' => $payMoney,
                'pay_attach' => isset($allParams['body']) && is_string($allParams['body']) ? (string)$allParams['body'] : '',
                'pay_status' => $allParams['trade_status'],
                'pay_data' => $allParams,
            ]);
        }

        $this->SyResult->setData([
            'msg' => '支付处理成功',
        ]);
        $this->sendRsp();
    }
}
