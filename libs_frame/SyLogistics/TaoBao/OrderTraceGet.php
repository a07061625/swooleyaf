<?php
/**
 * 流转信息查询
 * User: 姜伟
 * Date: 2019/7/12 0012
 * Time: 9:56
 */
namespace SyLogistics\TaoBao;

use SyConstant\ErrorCode;
use SyException\Logistics\TaoBaoException;
use SyLogistics\LogisticsBaseTaoBao;

class OrderTraceGet extends LogisticsBaseTaoBao
{
    /**
     * 物流公司编码
     * @var string
     */
    private $company_code = '';
    /**
     * 运单号
     * @var string
     */
    private $mail_no = '';
    /**
     * 缓存状态 true:缓存 false:不缓存
     * @var bool
     */
    private $cache = false;

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.logistics.ordertrace.get');
        $this->reqData['cache'] = false;
    }

    private function __clone()
    {
    }

    /**
     * @param string $companyCode
     * @throws \SyException\Logistics\TaoBaoException
     */
    public function setCompanyCode(string $companyCode)
    {
        if (ctype_alnum($companyCode)) {
            $this->reqData['company_code'] = $companyCode;
        } else {
            throw new TaoBaoException('物流公司编码不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    /**
     * @param string $mailNo
     * @throws \SyException\Logistics\TaoBaoException
     */
    public function setMailNo(string $mailNo)
    {
        if (strlen($mailNo) > 0) {
            $this->reqData['mail_no'] = $mailNo;
        } else {
            throw new TaoBaoException('运单号不能为空', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    /**
     * @param bool $cacheStatus
     */
    public function setCacheStatus(bool $cacheStatus)
    {
        $this->reqData['cache'] = $cacheStatus;
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['company_code'])) {
            throw new TaoBaoException('物流公司编码不能为空', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
        if (!isset($this->reqData['mail_no'])) {
            throw new TaoBaoException('运单号不能为空', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
        return $this->getContent();
    }
}
