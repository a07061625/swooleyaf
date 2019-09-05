<?php
/**
 * 判定服务是否可达
 * User: 姜伟
 * Date: 2019/7/12 0012
 * Time: 9:56
 */
namespace SyLogistics\TaoBao;

use SyConstant\ErrorCode;
use SyException\Logistics\TaoBaoException;
use SyLogistics\LogisticsBaseTaoBao;

class AddressReachableGet extends LogisticsBaseTaoBao
{
    /**
     * 区域编码
     * @var string
     */
    private $area_code = '';
    /**
     * 详细地址
     * @var string
     */
    private $address = '';
    /**
     * 物流公司编码ID
     * @var array
     */
    private $partner_ids = [];
    /**
     * 服务编码
     * @var int
     */
    private $service_type = 0;
    /**
     * 发货地编码
     * @var string
     */
    private $source_area_code = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.logistics.address.reachable');
    }

    private function __clone()
    {
    }

    /**
     * @param string $areaCode
     * @throws \SyException\Logistics\TaoBaoException
     */
    public function setAreaCode(string $areaCode)
    {
        if (ctype_digit($areaCode)) {
            $this->reqData['area_code'] = $areaCode;
        } else {
            throw new TaoBaoException('区域编码不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    /**
     * @param string $address
     * @throws \SyException\Logistics\TaoBaoException
     */
    public function setAddress(string $address)
    {
        if (strlen($address) > 0) {
            $this->reqData['address'] = $address;
        } else {
            throw new TaoBaoException('详细地址不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    /**
     * @param array $partnerIds
     */
    public function setPartnerIds(array $partnerIds)
    {
        $this->partner_ids = [];
        foreach ($partnerIds as $ePartnerId) {
            if (ctype_digit($ePartnerId)) {
                $this->partner_ids[$ePartnerId] = 1;
            }
        }
    }

    /**
     * @param int $serviceType
     * @throws \SyException\Logistics\TaoBaoException
     */
    public function setServiceType(int $serviceType)
    {
        if ($serviceType > 0) {
            $this->reqData['service_type'] = $serviceType;
        } else {
            throw new TaoBaoException('服务编码不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    /**
     * @param string $sourceAreaCode
     * @throws \SyException\Logistics\TaoBaoException
     */
    public function setSourceAreaCode(string $sourceAreaCode)
    {
        if (ctype_digit($sourceAreaCode)) {
            $this->reqData['source_area_code'] = $sourceAreaCode;
        } else {
            throw new TaoBaoException('发货地编码不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['service_type'])) {
            throw new TaoBaoException('服务编码不能为空', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
        if (empty($this->partner_ids)) {
            throw new TaoBaoException('物流公司编码ID列表不能为空', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
        $this->reqData['partner_ids'] = implode(',', array_keys($this->partner_ids));
        return $this->getContent();
    }
}
