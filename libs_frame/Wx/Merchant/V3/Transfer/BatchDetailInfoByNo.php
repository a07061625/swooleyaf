<?php
/**
 * 通过商家明细单号查询明细单
 * User: 姜伟
 * Date: 2022/12/20
 * Time: 11:24
 */

namespace Wx\Merchant\V3\Transfer;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use Wx\WxBaseMerchantV3;
use Wx\WxUtilBase;

/**
 * Class BatchDetailInfoByNo
 *
 * @package Wx\Merchant\V3\Transfer
 */
class BatchDetailInfoByNo extends WxBaseMerchantV3
{
    /**
     * 商家批次单号
     *
     * @var string
     */
    private $out_batch_no = '';
    /**
     * 商家明细单号
     *
     * @var string
     */
    private $out_detail_no = '';

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
    public function setOutBatchNo(string $outBatchNo)
    {
        if (ctype_alnum($outBatchNo) && (\strlen($outBatchNo) <= 32)) {
            $this->out_batch_no = $outBatchNo;
        } else {
            throw new WxException('商家批次单号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setOutDetailNo(string $outDetailNo)
    {
        if (ctype_alnum($outDetailNo) && (\strlen($outDetailNo) <= 32)) {
            $this->out_detail_no = $outDetailNo;
        } else {
            throw new WxException('商家明细单号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Common\CheckException
     * @throws \SyException\Wx\WxException
     */
    public function getDetail(): array
    {
        if (0 == \strlen($this->out_batch_no)) {
            throw new WxException('商家批次单号不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (0 == \strlen($this->out_detail_no)) {
            throw new WxException('商家明细单号不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = 'https://api.mch.weixin.qq.com/v3/transfer/batches/out-batch-no/'
                                          . $this->out_batch_no
                                          . '/details/out-detail-no/'
                                          . $this->out_detail_no;
        $this->setHeadAuth();
        $sendRes = WxUtilBase::sendGetReq($this->curlConfigs, 2);

        return $this->handleRespJson($sendRes);
    }
}
