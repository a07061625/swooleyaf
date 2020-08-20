<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 15:09
 */
namespace SyPay\Union\Channels\NoJump;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;
use SyPay\Union\Channels\BaseNoJump;
use SyPay\Union\Channels\Traits\AccessTypeTrait;
use SyPay\Union\Channels\Traits\AccInfoTrait;
use SyPay\Union\Channels\Traits\BizTypeTrait;
use SyPay\Union\Channels\Traits\CertIdTrait;
use SyPay\Union\Channels\Traits\ChannelTypeTrait;
use SyPay\Union\Channels\Traits\CurrencyCodeTrait;
use SyPay\Union\Channels\Traits\CustomerInfoTrait;
use SyPay\Union\Channels\Traits\EncryptCertIdTrait;
use SyPay\Union\Channels\Traits\MerInfoTrait;
use SyPay\Union\Channels\Traits\OrderIdTrait;
use SyPay\Union\Channels\Traits\ReqReservedTrait;
use SyPay\Union\Channels\Traits\ReservedTrait;
use SyPay\Union\Channels\Traits\SubMerInfoTrait;
use SyPay\Union\Channels\Traits\TokenPayDataTrait;
use SyPay\Union\Channels\Traits\TxnAmtTrait;
use SyPay\UtilUnionChannels;

/**
 * 发送短信验证码接口
 *
 * @package SyPay\Union\Channels\NoJump
 */
class SmsSend extends BaseNoJump
{
    use BizTypeTrait;
    use SubMerInfoTrait;
    use AccessTypeTrait;
    use ChannelTypeTrait;
    use OrderIdTrait;
    use TokenPayDataTrait;
    use EncryptCertIdTrait;
    use CurrencyCodeTrait;
    use TxnAmtTrait;
    use MerInfoTrait;
    use CustomerInfoTrait;
    use AccInfoTrait;
    use CertIdTrait;
    use ReservedTrait;
    use ReqReservedTrait;

    public function __construct(string $merId, string $envType)
    {
        parent::__construct($merId, $envType);
        $this->reqDomain .= '/gateway/api/backTransReq.do';
        $this->reqData['bizType'] = '000301';
        $this->reqData['txnType'] = '77';
        $this->reqData['accessType'] = 0;
        $this->reqData['currencyCode'] = '156';
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
        if (in_array($txnSubType, ['00', '02', '04', '05'])) {
            $this->reqData['txnSubType'] = $txnSubType;
        } else {
            throw new UnionException('交易子类不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @return array
     *
     * @throws \SyException\Pay\UnionException
     */
    public function getDetail() : array
    {
        if (!isset($this->reqData['txnSubType'])) {
            throw new UnionException('交易子类不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
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
