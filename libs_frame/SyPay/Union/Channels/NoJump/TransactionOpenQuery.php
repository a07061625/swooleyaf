<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 14:22
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
use SyPay\Union\Channels\Traits\CustomerInfoTrait;
use SyPay\Union\Channels\Traits\EncryptCertIdTrait;
use SyPay\Union\Channels\Traits\OrderIdTrait;
use SyPay\Union\Channels\Traits\ReqReservedTrait;
use SyPay\Union\Channels\Traits\ReservedTrait;
use SyPay\UtilUnionChannels;

/**
 * 银联全渠道支付交易开通查询接口
 * 用于查询银行卡是否已开通银联全渠道支付
 *
 * @package SyPay\Union\Channels\NoJump
 */
class TransactionOpenQuery extends BaseNoJump
{
    use BizTypeTrait;
    use AccessTypeTrait;
    use ChannelTypeTrait;
    use OrderIdTrait;
    use AccInfoTrait;
    use EncryptCertIdTrait;
    use CustomerInfoTrait;
    use CertIdTrait;
    use ReservedTrait;
    use ReqReservedTrait;

    public function __construct(string $merId, string $envType)
    {
        parent::__construct($merId, $envType);
        $this->reqDomain .= '/gateway/api/backTransReq.do';
        $this->reqData['bizType'] = '000301';
        $this->reqData['backUrl'] = 'http://www.specialUrl.com';
        $this->reqData['txnType'] = '78';
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
        if (in_array($txnSubType, ['00', '01', '02'])) {
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
        if (!isset($this->reqData['accessType'])) {
            throw new UnionException('接入类型不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        if (!isset($this->reqData['channelType'])) {
            throw new UnionException('渠道类型不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        if (!isset($this->reqData['orderId'])) {
            throw new UnionException('商户订单号不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        if (!isset($this->reqData['accNo'])) {
            throw new UnionException('账号不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        UtilUnionChannels::createSign($this->reqData['merId'], $this->reqData);

        return $this->getChannelsContent();
    }
}
