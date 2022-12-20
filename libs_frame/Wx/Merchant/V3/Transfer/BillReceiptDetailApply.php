<?php
/**
 * 申请转账明细电子回单
 * User: 姜伟
 * Date: 2022/12/20
 * Time: 11:24
 */

namespace Wx\Merchant\V3\Transfer;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseMerchantV3;
use Wx\WxUtilBase;

/**
 * Class BillReceiptDetailApply
 *
 * @package Wx\Merchant\V3\Transfer
 */
class BillReceiptDetailApply extends WxBaseMerchantV3
{
    /**
     * 受理类型
     *
     * @var string
     */
    private $accept_type = '';
    /**
     * 转账批次单号
     *
     * @var string
     */
    private $out_batch_no = '';
    /**
     * 转账明细单号
     *
     * @var string
     */
    private $out_detail_no = '';

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/v3/transfer-detail/electronic-receipts';
        $this->reqMethod = self::REQUEST_METHOD_POST;
        $this->setHeadJson();
        $this->reqData['out_batch_no'] = '';
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setAcceptType(string $acceptType)
    {
        if (\in_array($acceptType, ['BATCH_TRANSFER', 'TRANSFER_TO_POCKET', 'TRANSFER_TO_BANK'])) {
            $this->reqData['accept_type'] = $acceptType;
        } else {
            throw new WxException('受理类型不支持', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setOutBatchNo(string $outBatchNo)
    {
        if (ctype_alnum($outBatchNo) && (\strlen($outBatchNo) <= 32)) {
            $this->reqData['out_batch_no'] = $outBatchNo;
        } else {
            throw new WxException('转账批次单号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setOutDetailNo(string $outDetailNo)
    {
        if (ctype_alnum($outDetailNo) && (\strlen($outDetailNo) <= 32)) {
            $this->reqData['out_detail_no'] = $outDetailNo;
        } else {
            throw new WxException('转账明细单号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Common\CheckException
     * @throws \SyException\Wx\WxException
     */
    public function getDetail(): array
    {
        if (!isset($this->reqData['accept_type'])) {
            throw new WxException('受理类型不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if ('BATCH_TRANSFER' == $this->reqData['accept_type']) {
            if (0 == \strlen($this->reqData['out_batch_no'])) {
                throw new WxException('转账批次单号不能为空', ErrorCode::WX_PARAM_ERROR);
            }
        } else {
            $this->reqData['out_batch_no'] = '';
        }
        if (!isset($this->reqData['out_detail_no'])) {
            throw new WxException('转账明细单号不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl;
        $this->setHeadAuth();
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs, 2);

        return $this->handleRespJson($sendRes);
    }
}
