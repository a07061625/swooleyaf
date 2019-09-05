<?php
/**
 * 单号查快递公司名
 * User: 姜伟
 * Date: 2019/6/18 0018
 * Time: 16:50
 */
namespace SyLogistics\AliMart;

use SyConstant\ErrorCode;
use SyException\Logistics\AliMartException;
use SyLogistics\LogisticsBaseAliMart;

class ExpressCompanyFetch extends LogisticsBaseAliMart
{
    /**
     * 快递单号
     * @var string
     */
    private $nu = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/fetchCom';
    }

    private function __clone()
    {
    }

    /**
     * @param string $nu
     * @throws \SyException\Logistics\AliMartException
     */
    public function setNu(string $nu)
    {
        if (strlen($nu) > 0) {
            $this->reqData['nu'] = $nu;
        } else {
            throw new AliMartException('快递单号不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['nu'])) {
            throw new AliMartException('快递单号不能为空', ErrorCode::LOGISTICS_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
