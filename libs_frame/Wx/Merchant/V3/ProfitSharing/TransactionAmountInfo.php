<?php
/**
 * 查询剩余待分金额
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
 * Class TransactionAmountInfo
 *
 * @package Wx\Merchant\V3\ProfitSharing
 */
class TransactionAmountInfo extends WxBaseMerchantV3
{
    /**
     * 微信订单号
     *
     * @var string
     */
    private $transaction_id = '';

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
            $this->transaction_id = $transactionId;
        } else {
            throw new WxException('微信订单号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Common\CheckException
     * @throws \SyException\Wx\WxException
     */
    public function getDetail(): array
    {
        if (0 == \strlen($this->transaction_id)) {
            throw new WxException('微信订单号不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = 'https://api.mch.weixin.qq.com/v3/profitsharing/transactions/'
                                          . $this->transaction_id
                                          . '/amounts';
        $this->setHeadAuth();
        $sendRes = WxUtilBase::sendGetReq($this->curlConfigs, 2);

        return $this->handleRespJson($sendRes);
    }
}
