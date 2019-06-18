<?php
/**
 * 快递物流节点跟踪
 * User: 姜伟
 * Date: 2019/6/18 0018
 * Time: 16:50
 */
namespace SyLogistics\AliMart;

use Constant\ErrorCode;
use Exception\Logistics\AliMartException;
use SyLogistics\LogisticsBaseAliMart;

class ExpressInfo extends LogisticsBaseAliMart
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
     * @throws \Exception\Logistics\AliMartException
     */
    public function setCom(string $com)
    {
        if (ctype_alnum($com)) {
            $this->reqData['com'] = $com;
        } else {
            throw new AliMartException('公司字母简称不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    /**
     * @param string $nu
     * @throws \Exception\Logistics\AliMartException
     */
    public function setNu(string $nu)
    {
        if (strlen($nu) > 0) {
            $this->reqData['nu'] = $nu;
        } else {
            throw new AliMartException('快递单号不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    /**
     * @param string $receiverPhone
     * @throws \Exception\Logistics\AliMartException
     */
    public function setReceiverPhone(string $receiverPhone)
    {
        if (ctype_digit($receiverPhone) && (strlen($receiverPhone) == 4)) {
            $this->reqData['receiverPhone'] = $receiverPhone;
        } else {
            throw new AliMartException('收件人手机号后四位不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    /**
     * @param string $senderPhone
     * @throws \Exception\Logistics\AliMartException
     */
    public function setSenderPhone(string $senderPhone)
    {
        if (ctype_digit($senderPhone) && (strlen($senderPhone) == 4)) {
            $this->reqData['senderPhone'] = $senderPhone;
        } else {
            throw new AliMartException('寄件人手机号后四位不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['com'])) {
            throw new AliMartException('公司字母简称不能为空', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
        if (!isset($this->reqData['nu'])) {
            throw new AliMartException('快递单号不能为空', ErrorCode::LOGISTICS_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
