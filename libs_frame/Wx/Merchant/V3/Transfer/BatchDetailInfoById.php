<?php
/**
 * 通过微信明细单号查询明细单
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
 * Class BatchDetailInfoById
 *
 * @package Wx\Merchant\V3\Transfer
 */
class BatchDetailInfoById extends WxBaseMerchantV3
{
    /**
     * 微信批次单号
     * @var string
     */
    private $batch_id = '';
    /**
     * 微信明细单号
     * @var string
     */
    private $detail_id = '';

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
     * @param string $batchId
     * @throws \SyException\Wx\WxException
     */
    public function setBatchId(string $batchId)
    {
        if (ctype_alnum($batchId) && (\strlen($batchId) <= 64)) {
            $this->batch_id = $batchId;
        } else {
            throw new WxException('微信批次单号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $detailId
     * @throws \SyException\Wx\WxException
     */
    public function setDetailId(string $detailId)
    {
        if (ctype_alnum($detailId) && (\strlen($detailId) <= 64)) {
            $this->detail_id = $detailId;
        } else {
            throw new WxException('微信明细单号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @return array
     * @throws \SyException\Common\CheckException
     * @throws \SyException\Wx\WxException
     */
    public function getDetail(): array
    {
        if (strlen($this->batch_id) == 0) {
            throw new WxException('微信批次单号不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (strlen($this->detail_id) == 0) {
            throw new WxException('微信明细单号不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = 'https://api.mch.weixin.qq.com/v3/transfer/batches/batch-id/'
                                          . $this->batch_id
                                          . '/details/detail-id/'
                                          . $this->detail_id;
        $this->setHeadAuth();
        $sendRes = WxUtilBase::sendGetReq($this->curlConfigs, 2);

        return $this->handleRespJson($sendRes);
    }
}
