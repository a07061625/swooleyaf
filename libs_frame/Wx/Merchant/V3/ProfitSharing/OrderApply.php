<?php
/**
 * 请求分账
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
 * Class OrderApply
 *
 * @package Wx\Merchant\V3\ProfitSharing
 */
class OrderApply extends WxBaseMerchantV3
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
     * 分账接收方列表
     *
     * @var array
     */
    private $receivers = [];
    /**
     * 解冻剩余未分资金状态
     *
     * @var bool
     */
    private $unfreeze_unsplit = false;

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/v3/profitsharing/orders';
        $this->reqMethod = self::REQUEST_METHOD_POST;
        $this->setHeadJson();
        $this->reqData['appid'] = $appId;
        $this->reqData['receivers'] = [];
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
    public function setReceivers(array $receivers)
    {
        $this->receivers = $receivers;
        $this->reqData['receivers'] = [];
        foreach ($receivers as $receiverInfo) {
            if (\is_array($receiverInfo) && \is_string($receiverInfo['account'])) {
                array_push($this->reqData['receivers'], $receiverInfo);
            }
        }

        $receiversNum = \count($this->reqData['receivers']);
        if (0 == $receiversNum) {
            throw new WxException('分账接收方不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if ($receiversNum > 50) {
            throw new WxException('分账接收方不能超过50个', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function setUnfreezeUnSplit(bool $unfreezeUnSplitStatus)
    {
        $this->reqData['unfreeze_unsplit'] = $unfreezeUnSplitStatus;
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
        if (0 == \count($this->reqData['receivers'])) {
            throw new WxException('分账接收方不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['unfreeze_unsplit'])) {
            throw new WxException('解冻剩余未分资金状态不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl;
        $this->setHeadAuth();
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs, 2);

        return $this->handleRespJson($sendRes);
    }
}
