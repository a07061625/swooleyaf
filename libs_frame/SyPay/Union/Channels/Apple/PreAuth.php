<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 8:47
 */
namespace SyPay\Union\Channels\Apple;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;
use SyPay\Union\Channels\BaseApple;
use SyPay\Union\Channels\Traits\AccessTypeTrait;
use SyPay\Union\Channels\Traits\AccInfoTrait;
use SyPay\Union\Channels\Traits\AcqInsCodeTrait;
use SyPay\Union\Channels\Traits\BackUrlTrait;
use SyPay\Union\Channels\Traits\CardTransDataTrait;
use SyPay\Union\Channels\Traits\CertIdTrait;
use SyPay\Union\Channels\Traits\ChannelTypeTrait;
use SyPay\Union\Channels\Traits\CurrencyCodeTrait;
use SyPay\Union\Channels\Traits\CustomerInfoTrait;
use SyPay\Union\Channels\Traits\MerInfoTrait;
use SyPay\Union\Channels\Traits\OrderDescTrait;
use SyPay\Union\Channels\Traits\OrderIdTrait;
use SyPay\Union\Channels\Traits\ReqReservedTrait;
use SyPay\Union\Channels\Traits\RiskRateInfoTrait;
use SyPay\Union\Channels\Traits\TermIdTrait;
use SyPay\Union\Channels\Traits\TxnAmtTrait;
use SyPay\UtilUnionChannels;

/**
 * 预授权接口
 * 用于受理方向持卡人的发卡方确认交易许可
 * 受理方将预估的消费金额作为预授权金额,发送给持卡人的发卡方
 *
 * @package SyPay\Union\Channels\Apple
 */
class PreAuth extends BaseApple
{
    use BackUrlTrait;
    use CurrencyCodeTrait;
    use TxnAmtTrait;
    use AccessTypeTrait;
    use ChannelTypeTrait;
    use OrderIdTrait;
    use OrderDescTrait;
    use MerInfoTrait;
    use AcqInsCodeTrait;
    use CustomerInfoTrait;
    use CardTransDataTrait;
    use AccInfoTrait;
    use CertIdTrait;
    use RiskRateInfoTrait;
    use ReqReservedTrait;
    use TermIdTrait;

    public function __construct(string $merId, string $envType)
    {
        parent::__construct($merId, $envType);
        $this->reqDomain .= '/gateway/api/backTransReq.do';
        $this->reqData['bizType'] = '000802';
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
