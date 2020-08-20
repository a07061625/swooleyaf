<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 17:37
 */
namespace SyPay\Union\Channels\NoJump;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;
use SyPay\Union\Channels\BaseNoJump;
use SyPay\Union\Channels\Traits\AccessTypeTrait;
use SyPay\Union\Channels\Traits\AccInfoTrait;
use SyPay\Union\Channels\Traits\AcqInsCodeTrait;
use SyPay\Union\Channels\Traits\BackUrlTrait;
use SyPay\Union\Channels\Traits\BizTypeTrait;
use SyPay\Union\Channels\Traits\CardTransDataTrait;
use SyPay\Union\Channels\Traits\CertIdTrait;
use SyPay\Union\Channels\Traits\ChannelTypeTrait;
use SyPay\Union\Channels\Traits\CurrencyCodeTrait;
use SyPay\Union\Channels\Traits\CustomerInfoTrait;
use SyPay\Union\Channels\Traits\CustomerIpTrait;
use SyPay\Union\Channels\Traits\EncryptCertIdTrait;
use SyPay\Union\Channels\Traits\FrontUrlTrait;
use SyPay\Union\Channels\Traits\InstalTransInfoTrait;
use SyPay\Union\Channels\Traits\IssInsCodeTrait;
use SyPay\Union\Channels\Traits\MerInfoTrait;
use SyPay\Union\Channels\Traits\OrderDescTrait;
use SyPay\Union\Channels\Traits\OrderIdTrait;
use SyPay\Union\Channels\Traits\OrderTimeoutTrait;
use SyPay\Union\Channels\Traits\PayTimeoutTrait;
use SyPay\Union\Channels\Traits\ReqReservedTrait;
use SyPay\Union\Channels\Traits\ReservedTrait;
use SyPay\Union\Channels\Traits\RiskRateInfoTrait;
use SyPay\Union\Channels\Traits\SignPubKeyCertTrait;
use SyPay\Union\Channels\Traits\SubMerInfoTrait;
use SyPay\Union\Channels\Traits\TermIdTrait;
use SyPay\Union\Channels\Traits\TokenPayDataTrait;
use SyPay\Union\Channels\Traits\TxnAmtTrait;
use SyPay\Union\Channels\Traits\UserMacTrait;
use SyPay\UtilUnionChannels;

/**
 * 自助消费接口
 * 消费交易和开通交易两者合一,发往前台交易地址
 *
 * @package SyPay\Union\Channels\NoJump
 */
class SelfServiceConsume extends BaseNoJump
{
    use BizTypeTrait;
    use BackUrlTrait;
    use CurrencyCodeTrait;
    use TxnAmtTrait;
    use AccessTypeTrait;
    use ChannelTypeTrait;
    use OrderIdTrait;
    use SignPubKeyCertTrait;
    use TokenPayDataTrait;
    use OrderDescTrait;
    use SubMerInfoTrait;
    use InstalTransInfoTrait;
    use EncryptCertIdTrait;
    use MerInfoTrait;
    use AcqInsCodeTrait;
    use CustomerInfoTrait;
    use CardTransDataTrait;
    use AccInfoTrait;
    use CertIdTrait;
    use ReservedTrait;
    use CustomerIpTrait;
    use OrderTimeoutTrait;
    use IssInsCodeTrait;
    use RiskRateInfoTrait;
    use FrontUrlTrait;
    use ReqReservedTrait;
    use PayTimeoutTrait;
    use TermIdTrait;
    use UserMacTrait;

    public function __construct(string $merId, string $envType)
    {
        parent::__construct($merId, $envType);
        $this->reqDomain .= '/gateway/api/frontTransReq.do';
        $this->reqData['bizType'] = '000301';
        $this->reqData['backUrl'] = 'http://www.specialUrl.com';
        $this->reqData['currencyCode'] = '156';
        $this->reqData['txnType'] = '01';
        $this->reqData['txnSubType'] = '01';
        $this->reqData['accessType'] = 0;
    }

    public function __clone()
    {
    }

    /**
     * @return array
     *
     * @throws \SyException\Pay\UnionException
     */
    public function getDetail() : array
    {
        if (!isset($this->reqData['txnAmt'])) {
            throw new UnionException('交易金额不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        if (!isset($this->reqData['channelType'])) {
            throw new UnionException('渠道类型不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        if (!isset($this->reqData['orderId'])) {
            throw new UnionException('商户订单号不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        UtilUnionChannels::createSign($this->reqData['merId'], $this->reqData);

        return $this->getChannelsContent();
    }
}
