<?php
/**
 * 查询分账结果
 * User: 姜伟
 * Date: 2022/12/21
 * Time: 15:30
 */

namespace Wx\Merchant\V3\ProfitSharing;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use Wx\WxBaseMerchantV3;
use Wx\WxUtilBase;

/**
 * Class OrderInfo
 *
 * @package Wx\Merchant\V3\ProfitSharing
 */
class OrderInfo extends WxBaseMerchantV3
{
    /**
     * 微信订单号
     *
     * @var string
     */
    private $transaction_id = '';
    /**
     * 商户分账单号
     *
     * @var string
     */
    private $out_order_no = '';

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->reqMethod = self::REQUEST_METHOD_GET;
        $this->setHeadJson();
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setTransactionId(string $transactionId)
    {
        if (ctype_alnum($transactionId) && (\strlen($transactionId) <= 32)) {
            $this->reqData['transaction_id'] = $transactionId;
        } else {
            throw new WxException('微信订单号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setOutOrderNo(string $outOrderNo)
    {
        if (ctype_alnum($outOrderNo) && (\strlen($outOrderNo) <= 64)) {
            $this->out_order_no = $outOrderNo;
        } else {
            throw new WxException('商户分账单号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Common\CheckException
     * @throws \SyException\Wx\WxException
     */
    public function getDetail(): array
    {
        if (!isset($this->reqData['transaction_id'])) {
            throw new WxException('微信订单号不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (0 == \strlen($this->out_order_no)) {
            throw new WxException('商户分账单号不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = 'https://api.mch.weixin.qq.com/v3/profitsharing/orders/' . $this->out_order_no
                                          . '?' . http_build_query($this->reqData);
        $this->setHeadAuth();
        $sendRes = WxUtilBase::sendGetReq($this->curlConfigs, 2);

        return $this->handleRespJson($sendRes);
    }
}
