<?php
/**
 * 回退请求分账
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
 * Class OrderReturn
 *
 * @package Wx\Merchant\V3\ProfitSharing
 */
class OrderReturn extends WxBaseMerchantV3
{
    /**
     * 微信分账单号
     *
     * @var string
     */
    private $order_id = '';
    /**
     * 商户分账单号
     *
     * @var string
     */
    private $out_order_no = '';
    /**
     * 商户回退单号
     *
     * @var string
     */
    private $out_return_no = '';
    /**
     * 回退商户号
     *
     * @var string
     */
    private $return_mchid = '';
    /**
     * 回退金额
     *
     * @var int
     */
    private $amount = 0;
    /**
     * 回退描述
     *
     * @var string
     */
    private $description = '';

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/v3/profitsharing/return-orders';
        $this->reqMethod = self::REQUEST_METHOD_POST;
        $this->setHeadJson();
        $this->reqData['order_id'] = '';
        $this->reqData['out_order_no'] = '';
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setOrderId(string $orderId)
    {
        if (ctype_alnum($orderId) && (\strlen($orderId) <= 64)) {
            $this->reqData['order_id'] = $orderId;
        } else {
            throw new WxException('微信分账单号不合法', ErrorCode::WX_PARAM_ERROR);
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
    public function setOutReturnNo(string $outReturnNo)
    {
        if (ctype_alnum($outReturnNo) && (\strlen($outReturnNo) <= 64)) {
            $this->reqData['out_return_no'] = $outReturnNo;
        } else {
            throw new WxException('商户回退单号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setReturnMchId(string $returnMchId)
    {
        if (ctype_alnum($returnMchId) && (\strlen($returnMchId) <= 32)) {
            $this->reqData['return_mchid'] = $returnMchId;
        } else {
            throw new WxException('回退商户号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setAmount(int $amount)
    {
        if ($amount > 0) {
            $this->reqData['amount'] = $amount;
        } else {
            throw new WxException('回退金额不合法', ErrorCode::WX_PARAM_ERROR);
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
            throw new WxException('回退描述不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if ($descLength > 80) {
            throw new WxException('回退描述不能超过80个字节', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['description'] = $trueDesc;
    }

    /**
     * @throws \SyException\Common\CheckException
     * @throws \SyException\Wx\WxException
     */
    public function getDetail(): array
    {
        if ((0 == \strlen($this->reqData['order_id'])) && (0 == \strlen($this->reqData['out_order_no']))) {
            throw new WxException('微信分账单号和商户分账单号不能都为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['out_return_no'])) {
            throw new WxException('商户回退单号不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['return_mchid'])) {
            throw new WxException('回退商户号不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['amount'])) {
            throw new WxException('回退金额不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['description'])) {
            throw new WxException('回退描述不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl;
        $this->setHeadAuth();
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs, 2);

        return $this->handleRespJson($sendRes);
    }
}
