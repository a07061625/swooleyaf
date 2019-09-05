<?php
/**
 * 实时查询物流轨迹
 * User: 姜伟
 * Date: 2019/6/28 0028
 * Time: 19:26
 */
namespace SyLogistics\KdNiao;

use SyConstant\ErrorCode;
use SyException\Logistics\KdNiaoException;
use SyLogistics\LogisticsBaseKdNiao;

class ExpressInfo extends LogisticsBaseKdNiao
{
    /**
     * 订单编号
     * @var string
     */
    private $OrderCode = '';
    /**
     * 快递公司编码
     * @var string
     */
    private $ShipperCode = '';
    /**
     * 物流单号
     * @var string
     */
    private $LogisticCode = '';

    public function __construct()
    {
        parent::__construct();
        $this->reqData['RequestType'] = '1002';
        $this->serviceUrl = 'http://api.kdniao.com/Ebusiness/EbusinessOrderHandle.aspx';
    }

    private function __clone()
    {
    }

    /**
     * @param string $orderCode
     * @throws \SyException\Logistics\KdNiaoException
     */
    public function setOrderCode(string $orderCode)
    {
        if (strlen($orderCode) > 0) {
            $this->extendData['OrderCode'] = $orderCode;
        } else {
            throw new KdNiaoException('订单编号不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    /**
     * @param string $shipperCode
     * @throws \SyException\Logistics\KdNiaoException
     */
    public function setShipperCode(string $shipperCode)
    {
        if (strlen($shipperCode) > 0) {
            $this->extendData['ShipperCode'] = $shipperCode;
        } else {
            throw new KdNiaoException('快递公司编码不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    /**
     * @param string $logisticCode
     * @throws \SyException\Logistics\KdNiaoException
     */
    public function setLogisticCode(string $logisticCode)
    {
        if (ctype_alnum($logisticCode)) {
            $this->extendData['LogisticCode'] = $logisticCode;
        } else {
            throw new KdNiaoException('物流单号不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->extendData['ShipperCode'])) {
            throw new KdNiaoException('快递公司编码不能为空', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
        if (!isset($this->extendData['LogisticCode'])) {
            throw new KdNiaoException('物流单号不能为空', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
        return $this->getContent();
    }
}
