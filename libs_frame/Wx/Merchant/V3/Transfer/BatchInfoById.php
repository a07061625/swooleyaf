<?php
/**
 * 通过微信批次单号查询批次单
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
 * Class BatchInfoById
 *
 * @package Wx\Merchant\V3\Transfer
 */
class BatchInfoById extends WxBaseMerchantV3
{
    /**
     * 微信批次单号
     *
     * @var string
     */
    private $batch_id = '';
    /**
     * 是否查询指定状态
     *
     * @var bool
     */
    private $need_query_detail = false;
    /**
     * 起始位置
     *
     * @var int
     */
    private $offset = 0;
    /**
     * 最大明细条数
     *
     * @var int
     */
    private $limit = 0;
    /**
     * 转账明细单状态
     *
     * @var string
     */
    private $detail_status = '';

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->reqMethod = self::REQUEST_METHOD_GET;
        $this->setHeadJson();
        $this->reqData['need_query_detail'] = 'false';
        $this->reqData['offset'] = 0;
        $this->reqData['limit'] = 20;
    }

    private function __clone()
    {
        //do nothing
    }

    /**
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

    public function setNeedQueryDetail(bool $queryDetailStatus)
    {
        if ($queryDetailStatus) {
            $this->reqData['need_query_detail'] = 'true';
        } else {
            $this->reqData['need_query_detail'] = 'false';
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setOffset(int $offset)
    {
        if ($offset >= 0) {
            $this->reqData['offset'] = $offset;
        } else {
            throw new WxException('起始位置不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setLimit(int $limit)
    {
        if ($limit <= 0) {
            throw new WxException('最大明细条数必须大于0', ErrorCode::WX_PARAM_ERROR);
        }
        if ($limit > 100) {
            throw new WxException('最大明细条数不能大于100', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['limit'] = $limit;
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setDetailStatus(string $detailStatus)
    {
        if (\in_array($detailStatus, ['ALL', 'SUCCESS', 'FAIL'])) {
            $this->reqData['detail_status'] = $detailStatus;
        } else {
            throw new WxException('转账明细单状态不支持', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Common\CheckException
     * @throws \SyException\Wx\WxException
     */
    public function getDetail(): array
    {
        if (0 == \strlen($this->batch_id)) {
            throw new WxException('微信批次单号不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = 'https://api.mch.weixin.qq.com/v3/transfer/batches/batch-id/'
                                          . $this->batch_id
                                          . '?' . http_build_query($this->reqData);
        $this->setHeadAuth();
        $sendRes = WxUtilBase::sendGetReq($this->curlConfigs, 2);

        return $this->handleRespJson($sendRes);
    }
}
