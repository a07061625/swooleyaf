<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/13 0013
 * Time: 10:19
 */
namespace SyPay\Union\Channels\CustomsDeclaration;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;
use SyPay\Union\Channels\BaseCustomsDeclaration;
use SyPay\Union\Channels\Traits\AccessTypeTrait;
use SyPay\Union\Channels\Traits\AcqInsCodeTrait;
use SyPay\Union\Channels\Traits\CertIdTrait;
use SyPay\Union\Channels\Traits\ChannelTypeTrait;
use SyPay\Union\Channels\Traits\CurrencyCodeTrait;
use SyPay\Union\Channels\Traits\CustomerInfoTrait;
use SyPay\Union\Channels\Traits\EncryptCertIdTrait;
use SyPay\Union\Channels\Traits\MerEnNameTrait;
use SyPay\Union\Channels\Traits\MerInfoTrait;
use SyPay\Union\Channels\Traits\OrderIdTrait;
use SyPay\Union\Channels\Traits\OrigOrderIdTrait;
use SyPay\Union\Channels\Traits\OrigTxnTimeTrait;
use SyPay\Union\Channels\Traits\ReqReservedTrait;
use SyPay\Union\Channels\Traits\ReservedTrait;
use SyPay\Union\Channels\Traits\SubMerInfoTrait;
use SyPay\Union\Channels\Traits\TxnAmtTrait;
use SyPay\UtilUnionChannels;

/**
 * 海关申报接口
 * 用于商户提交银联支付订单进行报关申请,同步应答仅为受理结果,申报结果必须需要发起申报查询交易
 *
 * @package SyPay\Union\Channels\CustomsDeclaration
 */
class DeclarationApply extends BaseCustomsDeclaration
{
    use CurrencyCodeTrait;
    use TxnAmtTrait;
    use AccessTypeTrait;
    use ChannelTypeTrait;
    use OrderIdTrait;
    use CustomerInfoTrait;
    use ReservedTrait;
    use SubMerInfoTrait;
    use EncryptCertIdTrait;
    use MerInfoTrait;
    use MerEnNameTrait;
    use AcqInsCodeTrait;
    use OrigOrderIdTrait;
    use OrigTxnTimeTrait;
    use CertIdTrait;
    use ReqReservedTrait;

    public function __construct(string $merId, string $envType)
    {
        parent::__construct($merId, $envType);
        $this->reqDomain .= '/gateway/api/backTransReq.do';
        $this->reqData['bizType'] = '000000';
        $this->reqData['currencyCode'] = '156';
        $this->reqData['txnType'] = '82';
        $this->reqData['txnSubType'] = '00';
        $this->reqData['accessType'] = 0;
        $this->reqData['origTransChannel'] = 0;
    }

    public function __clone()
    {
    }

    /**
     * @param string $txnSubType
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setTxnSubType(string $txnSubType)
    {
        if (in_array($txnSubType, ['00', '01'])) {
            $this->reqData['txnSubType'] = $txnSubType;
        } else {
            throw new UnionException('交易子类不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @param array $customsData
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setCustomsData(array $customsData)
    {
        if (empty($customsData)) {
            throw new UnionException('海关申报信息域不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        $this->reqData['customsData'] = UtilUnionChannels::getSignStr($customsData);
    }

    /**
     * @param string $origTraceNo
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setOrigTraceNo(string $origTraceNo)
    {
        if (ctype_digit($origTraceNo) && (strlen($origTraceNo) == 6)) {
            $this->reqData['origTraceNo'] = $origTraceNo;
        } else {
            throw new UnionException('原系统跟踪号不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @param string $origAcqInsCode
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setOrigAcqInsCode(string $origAcqInsCode)
    {
        if (ctype_digit($origAcqInsCode) && (strlen($origAcqInsCode) <= 11)) {
            $this->reqData['origAcqInsCode'] = $origAcqInsCode;
        } else {
            throw new UnionException('原受理机构标识码不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @param string $origFwdInsCode
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setOrigFwdInsCode(string $origFwdInsCode)
    {
        if (ctype_digit($origFwdInsCode) && (strlen($origFwdInsCode) <= 11)) {
            $this->reqData['origFwdInsCode'] = $origFwdInsCode;
        } else {
            throw new UnionException('原发送机构标识码不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @param int $origTraceTime
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setOrigTraceTime(int $origTraceTime)
    {
        if ($origTraceTime > 0) {
            $this->reqData['origTraceTime'] = date('YmdHis', $origTraceTime);
        } else {
            throw new UnionException('原交易传输时间不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @param int $origTransChannel
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setOrigTransChannel(int $origTransChannel)
    {
        if (in_array($origTransChannel, [0, 1])) {
            $this->reqData['origTransChannel'] = $origTransChannel;
        } else {
            throw new UnionException('原交易渠道不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @return array
     *
     * @throws \SyException\Pay\UnionException
     */
    public function getDetail() : array
    {
        if (!isset($this->reqData['customsData'])) {
            throw new UnionException('海关申报信息域不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        if (!isset($this->reqData['txnAmt'])) {
            throw new UnionException('交易金额不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        if (!isset($this->reqData['channelType'])) {
            throw new UnionException('渠道类型不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        if (!isset($this->reqData['customerInfo'])) {
            throw new UnionException('银行卡验证信息不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        UtilUnionChannels::createSign($this->reqData['merId'], $this->reqData);

        return $this->getChannelsContent();
    }
}
