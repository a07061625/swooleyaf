<?php
/**
 * 查询支持起始地到目的地范围的物流公司
 * User: 姜伟
 * Date: 2019/7/12 0012
 * Time: 9:56
 */
namespace SyLogistics\TaoBao;

use SyConstant\ErrorCode;
use SyException\Logistics\TaoBaoException;
use SyLogistics\LogisticsBaseTaoBao;

class PartnersGet extends LogisticsBaseTaoBao
{
    /**
     * 揽货地地区码
     * @var string
     */
    private $source_id = '';
    /**
     * 派送地地区码
     * @var string
     */
    private $target_id = '';
    /**
     * 服务类型 cod:货到付款 online:在线下单 offline:自己联系 limit:限时物流
     * @var string
     */
    private $service_type = '';
    /**
     * 货物价格
     * @var string
     */
    private $goods_value = '';
    /**
     * 揽收资费标识 true:需要揽收资费 false:不需要揽收资费
     * @var bool
     */
    private $is_need_carriage = false;

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.logistics.partners.get');
        $this->reqData['source_id'] = '0';
        $this->reqData['target_id'] = '0';
        $this->reqData['goods_value'] = '0';
        $this->reqData['is_need_carriage'] = false;
    }

    private function __clone()
    {
    }

    /**
     * @param string $sourceId
     * @throws \SyException\Logistics\TaoBaoException
     */
    public function setSourceId(string $sourceId)
    {
        if (ctype_digit($sourceId)) {
            $this->reqData['source_id'] = $sourceId;
        } else {
            throw new TaoBaoException('揽货地地区码不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    /**
     * @param string $targetId
     * @throws \SyException\Logistics\TaoBaoException
     */
    public function setTargetId(string $targetId)
    {
        if (ctype_digit($targetId)) {
            $this->reqData['target_id'] = $targetId;
        } else {
            throw new TaoBaoException('派送地地区码不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    /**
     * @param string $serviceType
     * @throws \SyException\Logistics\TaoBaoException
     */
    public function setServiceType(string $serviceType)
    {
        if (in_array($serviceType, ['cod', 'online', 'offline', 'limit'])) {
            $this->reqData['service_type'] = $serviceType;
        } else {
            throw new TaoBaoException('服务类型不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    /**
     * @param double $goodsValue
     * @throws \SyException\Logistics\TaoBaoException
     */
    public function setGoodsValue($goodsValue)
    {
        if (is_numeric($goodsValue) && ($goodsValue >= 0)) {
            $this->reqData['goods_value'] = number_format($goodsValue, 2, '.', '');
        } else {
            throw new TaoBaoException('货物价格不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    /**
     * @param bool $isNeedCarriage
     */
    public function setIsNeedCarriage(bool $isNeedCarriage)
    {
        $this->reqData['is_need_carriage'] = $isNeedCarriage;
    }

    public function getDetail() : array
    {
        return $this->getContent();
    }
}
