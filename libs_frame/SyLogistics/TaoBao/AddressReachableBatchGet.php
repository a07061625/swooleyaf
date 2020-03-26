<?php
/**
 * 批量判定服务是否可达
 * User: 姜伟
 * Date: 2019/7/12 0012
 * Time: 9:56
 */
namespace SyLogistics\TaoBao;

use SyConstant\ErrorCode;
use SyException\Logistics\TaoBaoException;
use SyLogistics\LogisticsBaseTaoBao;
use SyTool\Tool;

class AddressReachableBatchGet extends LogisticsBaseTaoBao
{
    /**
     * 地址列表
     * @var array
     */
    private $address_list = [];

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.logistics.address.reachablebatch.get');
    }

    private function __clone()
    {
    }

    /**
     * @param array $addressList
     * @throws \SyException\Logistics\TaoBaoException
     */
    public function setAddressList(array $addressList)
    {
        $num = count($addressList);
        if ($num == 0) {
            throw new TaoBaoException('地址列表不能为空', ErrorCode::LOGISTICS_PARAM_ERROR);
        } elseif ($num > 20) {
            throw new TaoBaoException('地址列表长度不能超过20个', ErrorCode::LOGISTICS_PARAM_ERROR);
        }

        $this->reqData['address_list'] = Tool::jsonEncode($addressList, JSON_UNESCAPED_UNICODE);
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['address_list'])) {
            throw new TaoBaoException('地址列表不能为空', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
        return $this->getContent();
    }
}
