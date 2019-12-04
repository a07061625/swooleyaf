<?php
/**
 * 快递公司查询
 * User: 姜伟
 * Date: 2019/6/18 0018
 * Time: 16:50
 */
namespace SyLogistics\AliMarket\Ali;

use SyConstant\ErrorCode;
use SyException\Logistics\AliMarketAliException;
use SyLogistics\LogisticsBaseAliMarketAli;

class ExpressCompanies extends LogisticsBaseAliMarketAli
{
    /**
     * 公司名称
     * @var string
     */
    private $expName = '';
    /**
     * 每页记录数
     * @var int
     */
    private $maxSize = 0;
    /**
     * 页数
     * @var int
     */
    private $page = 0;

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/showapi_expressList';
        $this->reqData['maxSize'] = 100;
        $this->reqData['page'] = 1;
    }

    private function __clone()
    {
    }

    /**
     * @param string $expName
     */
    public function setExpName(string $expName)
    {
        $this->reqData['expName'] = trim($expName);
    }

    /**
     * @param int $maxSize
     * @throws \SyException\Logistics\AliMarketAliException
     */
    public function setMaxSize(int $maxSize)
    {
        if ($maxSize > 0) {
            $this->reqData['maxSize'] = $maxSize;
        } else {
            throw new AliMarketAliException('每页记录数必须大于0', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    /**
     * @param int $page
     * @throws \SyException\Logistics\AliMarketAliException
     */
    public function setPage(int $page)
    {
        if ($page > 0) {
            $this->reqData['page'] = $page;
        } else {
            throw new AliMarketAliException('页数必须大于0', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        return $this->getContent();
    }
}
