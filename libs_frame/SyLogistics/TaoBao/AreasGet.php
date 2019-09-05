<?php
/**
 * 查询地址区域
 * User: 姜伟
 * Date: 2019/7/12 0012
 * Time: 9:56
 */
namespace SyLogistics\TaoBao;

use SyConstant\ErrorCode;
use SyException\Logistics\TaoBaoException;
use SyLogistics\LogisticsBaseTaoBao;

class AreasGet extends LogisticsBaseTaoBao
{
    /**
     * 返回字段列表
     * @var array
     */
    private $fields = [];

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.areas.get');
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

    public function getDetail() : array
    {
        if (!isset($this->reqData['fields'])) {
            throw new TaoBaoException('返回字段列表不能为空', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
        return $this->getContent();
    }
}
