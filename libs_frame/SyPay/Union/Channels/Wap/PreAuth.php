<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 8:47
 */
namespace SyPay\Union\Channels\Wap;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;
use SyPay\Union\Channels\BaseWap;
use SyPay\Union\Channels\Traits\AccessTypeTrait;
use SyPay\Union\Channels\Traits\AccInfoTrait;
use SyPay\Union\Channels\Traits\AcqInsCodeTrait;
use SyPay\Union\Channels\Traits\BackUrlTrait;
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
use SyPay\Union\Channels\Traits\PayCardTypeTrait;
use SyPay\Union\Channels\Traits\ReqReservedTrait;
use SyPay\Union\Channels\Traits\ReservedTrait;
use SyPay\Union\Channels\Traits\RiskRateInfoTrait;
use SyPay\Union\Channels\Traits\SubMerInfoTrait;
use SyPay\Union\Channels\Traits\TermIdTrait;
use SyPay\Union\Channels\Traits\TokenPayDataTrait;
use SyPay\Union\Channels\Traits\TxnAmtTrait;
use SyPay\Union\Channels\Traits\UserMacTrait;
use SyPay\UtilUnionChannels;

/**
 * 预授权接口
 * 用于受理方向持卡人的发卡方确认交易许可
 * 受理方将预估的消费金额作为预授权金额,发送给持卡人的发卡方
 *
 * @package SyPay\Union\Channels\Wap
 */
class PreAuth extends BaseWap
{
    use BackUrlTrait;
    use CurrencyCodeTrait;
    use TxnAmtTrait;
    use AccessTypeTrait;
    use ChannelTypeTrait;
    use OrderIdTrait;
    use CertIdTrait;
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
    use PayCardTypeTrait;
    use ReservedTrait;
    use CustomerIpTrait;
    use IssInsCodeTrait;
    use RiskRateInfoTrait;
    use FrontUrlTrait;
    use ReqReservedTrait;
    use TermIdTrait;
    use UserMacTrait;

    public function __construct(string $merId, string $envType)
    {
        $this->reqDomains = [
            self::ENV_TYPE_PRODUCT => 'https://gateway.95516.com',
            self::ENV_TYPE_DEV => 'https://101.231.204.80:5000',
        ];
        parent::__construct($merId, $envType);
        $this->reqDomain .= '/gateway/api/frontTransReq.do';
        $this->reqData['bizType'] = '000301';
        $this->reqData['backUrl'] = 'http://www.specialUrl.com';
        $this->reqData['currencyCode'] = '156';
        $this->reqData['txnType'] = '02';
        $this->reqData['txnSubType'] = '01';
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
        if (in_array($txnSubType, ['01', '03'])) {
            $this->reqData['txnSubType'] = $txnSubType;
        } else {
            throw new UnionException('交易子类不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @param string $bindId 绑定标识号
     */
    public function setBindId(string $bindId)
    {
        if (strlen($bindId) > 0) {
            $this->reqData['bindId'] = $bindId;
        }
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
        if (!isset($this->reqData['certId'])) {
            throw new UnionException('证书ID不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        UtilUnionChannels::createSign($this->reqData['merId'], $this->reqData);

        return $this->getChannelsContent();
    }
}
