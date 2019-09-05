<?php
/**
 * 查询物流公司信息
 * User: 姜伟
 * Date: 2019/7/12 0012
 * Time: 9:56
 */
namespace SyLogistics\TaoBao;

use SyConstant\ErrorCode;
use SyException\Logistics\TaoBaoException;
use SyLogistics\LogisticsBaseTaoBao;

class CompaniesGet extends LogisticsBaseTaoBao
{
    /**
     * 返回字段列表
     * @var array
     */
    private $fields = [];
    /**
     * 推荐标识,默认为true true:所有支持电话联系的物流公司 false:所有
     * @var bool
     */
    private $is_recommended = true;
    /**
     * 推荐物流公司的下单方式 offline:电话联系/自己联系 online:在线下单 all: 既电话联系又在线下单
     * @var string
     */
    private $order_mode = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.logistics.companies.get');
        $this->reqData['is_recommended'] = true;
        $this->reqData['order_mode'] = 'offline';
    }

    private function __clone()
    {
    }

    /**
     * @param array $fields
     * @throws \SyException\Logistics\TaoBaoException
     */
    public function setFields(array $fields)
    {
        if (empty($fields)) {
            throw new TaoBaoException('返回字段列表不能为空', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
        array_unique($fields);
        $this->reqData['fields'] = implode(',', $fields);
    }

    /**
     * @param bool $isRecommended
     */
    public function setIsRecommended(bool $isRecommended)
    {
        $this->reqData['is_recommended'] = $isRecommended;
    }

    /**
     * @param string $orderMode
     * @throws \SyException\Logistics\TaoBaoException
     */
    public function setOrderMode(string $orderMode)
    {
        if (in_array($orderMode, ['offline', 'online', 'all'])) {
            $this->reqData['order_mode'] = $orderMode;
        } else {
            throw new TaoBaoException('下单方式不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['fields'])) {
            throw new TaoBaoException('返回字段列表不能为空', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
        return $this->getContent();
    }
}
