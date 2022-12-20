<?php
/**
 * 发起商家转账
 * User: 姜伟
 * Date: 2022/12/19
 * Time: 19:49
 */

namespace Wx\Merchant\V3\Transfer;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseMerchantV3;
use Wx\WxUtilBase;

/**
 * Class BatchesApply
 *
 * @package Wx\Merchant\V3\Transfer
 */
class BatchesApply extends WxBaseMerchantV3
{
    /**
     * 商家批次单号
     *
     * @var string
     */
    private $out_batch_no = '';
    /**
     * 批量转账的名称
     *
     * @var string
     */
    private $batch_name = '';
    /**
     * 转账说明
     *
     * @var string
     */
    private $batch_remark = '';
    /**
     * 转账金额,单位为分
     *
     * @var int
     */
    private $total_amount = 0;
    /**
     * 转账总笔数
     *
     * @var int
     */
    private $total_num = 0;
    /**
     * 明细列表
     *
     * @var array
     */
    private $transfer_detail_list = [];
    /**
     * 转账场景ID
     *
     * @var string
     */
    private $transfer_scene_id = '';

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/v3/transfer/batches';
        $this->reqMethod = self::REQUEST_METHOD_POST;
        $this->setHeadJson();
        $this->reqData['appid'] = $appId;
        $this->reqData['batch_remark'] = '';
        $this->reqData['total_amount'] = 0;
        $this->reqData['total_num'] = 0;
        $this->reqData['transfer_detail_list'] = [];
        $this->reqData['transfer_scene_id'] = '';
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
     * @throws \SyException\Wx\WxException
     */
    public function setBatchName(string $batchName)
    {
        $trueName = trim($batchName);
        if (0 == \strlen($trueName)) {
            throw new WxException('批量转账名称不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (\strlen($trueName) > 32) {
            throw new WxException('批量转账名称不合法', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['batch_name'] = $trueName;
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setBatchRemark(string $batchRemark)
    {
        $trueRemark = trim($batchRemark);
        if (\strlen($trueRemark) <= 32) {
            $this->reqData['batch_remark'] = $trueRemark;
        } else {
            throw new WxException('转账说明不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function setTransferDetailList(array $transferDetailList)
    {
        $this->reqData['total_amount'] = 0;
        $this->reqData['total_num'] = 0;
        $this->reqData['transfer_detail_list'] = [];
        foreach ($transferDetailList as $detailInfo) {
            if (!\is_array($detailInfo)) {
                continue;
            }

            $nowAmount = Tool::getArrayVal($detailInfo, 'transfer_amount', 0);
            if (\is_int($nowAmount) && ($nowAmount > 0)) {
                $this->reqData['total_amount'] += $nowAmount;
                ++$this->reqData['total_num'];
                array_push($this->reqData['transfer_detail_list'], $detailInfo);
            }
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setTransferSceneId(string $transferSceneId)
    {
        $trueSceneId = trim($transferSceneId);
        if (\strlen($trueSceneId) <= 36) {
            $this->reqData['transfer_scene_id'] = $trueSceneId;
        } else {
            throw new WxException('转账场景ID不合法', ErrorCode::WX_PARAM_ERROR);
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
        if (!isset($this->reqData['batch_name'])) {
            throw new WxException('批量转账名称不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if ($this->reqData['total_num'] <= 0) {
            throw new WxException('明细列表不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if ($this->reqData['total_num'] > 1000) {
            throw new WxException('明细列表不能超过1000个', ErrorCode::WX_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl;
        $this->setHeadAuth();
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs, 2);

        return $this->handleRespJson($sendRes);
    }
}
