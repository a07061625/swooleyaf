<?php
/**
 * 物流流转信息查询
 * User: 姜伟
 * Date: 2019/7/12 0012
 * Time: 9:56
 */
namespace SyLogistics\TaoBao;

use SyConstant\ErrorCode;
use SyException\Logistics\TaoBaoException;
use SyLogistics\LogisticsBaseTaoBao;

class TraceSearch extends LogisticsBaseTaoBao
{
    /**
     * 淘宝交易号
     * @var int
     */
    private $tid = 0;
    /**
     * 拆单标识 0:不拆单 1:拆单
     * @var int
     */
    private $is_split = 0;
    /**
     * 子订单列表
     * @var array
     */
    private $sub_tid = [];

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.logistics.trace.search');
        $this->reqData['is_split'] = 0;
    }

    private function __clone()
    {
    }

    /**
     * @param int $tid
     * @throws \SyException\Logistics\TaoBaoException
     */
    public function setTid(int $tid)
    {
        if ($tid > 0) {
            $this->reqData['tid'] = $tid;
        } else {
            throw new TaoBaoException('淘宝交易号不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    /**
     * @param int $isSplit
     * @throws \SyException\Logistics\TaoBaoException
     */
    public function setIsSplit(int $isSplit)
    {
        if (in_array($isSplit, [0, 1])) {
            $this->reqData['is_split'] = $isSplit;
        } else {
            throw new TaoBaoException('拆单标识不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    /**
     * @param array $subTidList
     * @throws \SyException\Logistics\TaoBaoException
     */
    public function setSubTidList(array $subTidList)
    {
        $num = count($subTidList);
        if ($num == 0) {
            throw new TaoBaoException('子订单列表不能为空', ErrorCode::LOGISTICS_PARAM_ERROR);
        } elseif ($num > 50) {
            throw new TaoBaoException('子订单列表数量不能超过50个', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
        $this->sub_tid = [];
        array_unique($subTidList);
        foreach ($subTidList as $eTid) {
            if (is_int($eTid)) {
                $this->sub_tid[] = $eTid;
            }
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['tid'])) {
            throw new TaoBaoException('淘宝交易号不能为空', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
        if ($this->reqData['is_split'] == 1) {
            if (empty($this->sub_tid)) {
                throw new TaoBaoException('子订单列表不能为空', ErrorCode::LOGISTICS_PARAM_ERROR);
            }
            $this->reqData['sub_tid'] = implode(',', $this->sub_tid);
        }
        return $this->getContent();
    }
}
