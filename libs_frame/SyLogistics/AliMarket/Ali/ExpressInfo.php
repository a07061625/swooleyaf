<?php
/**
 * 快递物流节点跟踪
 * User: 姜伟
 * Date: 2019/6/18 0018
 * Time: 16:50
 */
namespace SyLogistics\AliMarket\Ali;

use SyConstant\ErrorCode;
use SyException\Logistics\AliMarketAliException;
use SyLogistics\LogisticsBaseAliMarketAli;

class ExpressInfo extends LogisticsBaseAliMarketAli
{
    /**
     * 公司字母简称
     * @var string
     */
    private $com = '';
    /**
     * 快递单号
     * @var string
     */
    private $nu = '';
    /**
     * 收件人手机号后四位(顺丰需要)
     * @var string
     */
    private $receiverPhone = '';
    /**
     * 寄件人手机号后四位(顺丰需要)
     * @var string
     */
    private $senderPhone = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/showapi_expInfo';
    }

    private function __clone()
    {
    }

    /**
     * @param string $com
     * @throws \SyException\Logistics\AliMarketAliException
     */
    public function setCom(string $com)
    {
        if (ctype_alnum($com)) {
            $this->reqData['com'] = $com;
        } else {
            throw new AliMarketAliException('公司字母简称不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    /**
     * @param string $nu
     * @throws \SyException\Logistics\AliMarketAliException
     */
    public function setNu(string $nu)
    {
        if (strlen($nu) > 0) {
            $this->reqData['nu'] = $nu;
        } else {
            throw new AliMarketAliException('快递单号不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    /**
     * @param string $receiverPhone
     * @throws \SyException\Logistics\AliMarketAliException
     */
    public function setReceiverPhone(string $receiverPhone)
    {
        if (ctype_digit($receiverPhone) && (strlen($receiverPhone) == 4)) {
            $this->reqData['receiverPhone'] = $receiverPhone;
        } else {
            throw new AliMarketAliException('收件人手机号后四位不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    /**
     * @param string $senderPhone
     * @throws \SyException\Logistics\AliMarketAliException
     */
    public function setSenderPhone(string $senderPhone)
    {
        if (ctype_digit($senderPhone) && (strlen($senderPhone) == 4)) {
            $this->reqData['senderPhone'] = $senderPhone;
        } else {
            throw new AliMarketAliException('寄件人手机号后四位不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['com'])) {
            throw new AliMarketAliException('公司字母简称不能为空', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
        if (!isset($this->reqData['nu'])) {
            throw new AliMarketAliException('快递单号不能为空', ErrorCode::LOGISTICS_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
