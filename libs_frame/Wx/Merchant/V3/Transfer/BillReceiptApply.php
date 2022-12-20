<?php
/**
 * 申请转账批次电子回单
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
 * Class BillReceiptApply
 *
 * @package Wx\Merchant\V3\Transfer
 */
class BillReceiptApply extends WxBaseMerchantV3
{
    /**
     * 商家批次单号
     *
     * @var string
     */
    private $out_batch_no = '';

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/v3/transfer/bill-receipt';
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
    public function setOutBatchNo(string $outBatchNo)
    {
        if (ctype_alnum($outBatchNo) && (\strlen($outBatchNo) <= 32)) {
            $this->reqData['out_batch_no'] = $outBatchNo;
        } else {
            throw new WxException('商家批次单号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Common\CheckException
     * @throws \SyException\Wx\WxException
     */
    public function getDetail(): array
    {
        if (!isset($this->reqData['out_batch_no'])) {
            throw new WxException('商家批次单号不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl;
        $this->setHeadAuth();
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs, 2);

        return $this->handleRespJson($sendRes);
    }
}
