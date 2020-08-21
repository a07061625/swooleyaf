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
use SyPay\Union\Channels\Traits\AccInfoTrait;
use SyPay\Union\Channels\Traits\AcqInsCodeTrait;
use SyPay\Union\Channels\Traits\CertIdTrait;
use SyPay\Union\Channels\Traits\ChannelTypeTrait;
use SyPay\Union\Channels\Traits\CustomerInfoTrait;
use SyPay\Union\Channels\Traits\EncryptCertIdTrait;
use SyPay\Union\Channels\Traits\MerEnNameTrait;
use SyPay\Union\Channels\Traits\MerInfoTrait;
use SyPay\Union\Channels\Traits\OrderIdTrait;
use SyPay\Union\Channels\Traits\OrigOrderIdTrait;
use SyPay\Union\Channels\Traits\OrigTxnTimeTrait;
use SyPay\Union\Channels\Traits\ReqReservedTrait;
use SyPay\Union\Channels\Traits\ReservedTrait;
use SyPay\Union\Channels\Traits\RiskRateInfoTrait;
use SyPay\Union\Channels\Traits\SubMerInfoTrait;
use SyPay\Union\Channels\Traits\UserMacTrait;
use SyPay\UtilUnionChannels;

/**
 * 实名认证接口
 * 为了验证银行卡验证信息及身份信息如证件类型、证件号码、姓名、密码、CVN2、有效期、手机号等与银行卡号的一致性
 *
 * @package SyPay\Union\Channels\CustomsDeclaration
 */
class Certification extends BaseCustomsDeclaration
{
    use AccessTypeTrait;
    use ChannelTypeTrait;
    use OrderIdTrait;
    use OrigOrderIdTrait;
    use OrigTxnTimeTrait;
    use CertIdTrait;
    use SubMerInfoTrait;
    use EncryptCertIdTrait;
    use MerInfoTrait;
    use MerEnNameTrait;
    use AcqInsCodeTrait;
    use CustomerInfoTrait;
    use ReservedTrait;
    use RiskRateInfoTrait;
    use ReqReservedTrait;
    use AccInfoTrait;
    use UserMacTrait;

    public function __construct(string $merId, string $envType)
    {
        parent::__construct($merId, $envType);
        $this->reqDomain .= '/gateway/api/backTransReq.do';
        $this->reqData['bizType'] = '000401';
        $this->reqData['txnType'] = '72';
        $this->reqData['txnSubType'] = '14';
        $this->reqData['accessType'] = 0;
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
        if (in_array($txnSubType, ['01', '14'])) {
            $this->reqData['txnSubType'] = $txnSubType;
        } else {
            throw new UnionException('交易子类不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @param string $payTransNo
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setPayTransNo(string $payTransNo)
    {
        if (ctype_digit($payTransNo) && (strlen($payTransNo) == 21)) {
            $this->reqData['payTransNo'] = $payTransNo;
        } else {
            throw new UnionException('支付单据号不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @return array
     *
     * @throws \SyException\Pay\UnionException
     */
    public function getDetail() : array
    {
        if (!isset($this->reqData['channelType'])) {
            throw new UnionException('渠道类型不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        if (!isset($this->reqData['orderId'])) {
            throw new UnionException('商户订单号不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        if (!isset($this->reqData['origOrderId'])) {
            throw new UnionException('原交易商户订单号不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        if (!isset($this->reqData['origTxnTime'])) {
            throw new UnionException('原交易商户发送交易时间不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        if (!isset($this->reqData['certId'])) {
            throw new UnionException('证书ID不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        UtilUnionChannels::createSign($this->reqData['merId'], $this->reqData);

        return $this->getChannelsContent();
    }
}
