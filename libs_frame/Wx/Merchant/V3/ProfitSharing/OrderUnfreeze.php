<?php
/**
 * 解冻剩余资金
 * User: 姜伟
 * Date: 2022/12/21
 * Time: 15:30
 */

namespace Wx\Merchant\V3\ProfitSharing;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseMerchantV3;
use Wx\WxUtilBase;

/**
 * Class OrderUnfreeze
 *
 * @package Wx\Merchant\V3\ProfitSharing
 */
class OrderUnfreeze extends WxBaseMerchantV3
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
    /**
     * 分账描述
     *
     * @var string
     */
    private $description = '';

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/v3/profitsharing/orders/unfreeze';
        $this->reqMethod = self::REQUEST_METHOD_POST;
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
            $this->reqData['out_order_no'] = $outOrderNo;
        } else {
            throw new WxException('商户分账单号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setDescription(string $description)
    {
        $trueDesc = trim($description);
        $descLength = \strlen($trueDesc);
        if (0 == $descLength) {
            throw new WxException('分账描述不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if ($descLength > 80) {
            throw new WxException('分账描述不能超过80个字节', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['description'] = $trueDesc;
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
        if (!isset($this->reqData['out_order_no'])) {
            throw new WxException('商户分账单号不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['description'])) {
            throw new WxException('分账描述不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl;
        $this->setHeadAuth();
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs, 2);

        return $this->handleRespJson($sendRes);
    }
}
