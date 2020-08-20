<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 14:06
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
use SyPay\Union\Channels\Traits\CertIdTrait;
use SyPay\Union\Channels\Traits\ChannelTypeTrait;
use SyPay\Union\Channels\Traits\CtrlRuleTrait;
use SyPay\Union\Channels\Traits\CustomerInfoTrait;
use SyPay\Union\Channels\Traits\EncryptCertIdTrait;
use SyPay\Union\Channels\Traits\FrontUrlTrait;
use SyPay\Union\Channels\Traits\MerInfoTrait;
use SyPay\Union\Channels\Traits\OrderIdTrait;
use SyPay\Union\Channels\Traits\ReqReservedTrait;
use SyPay\Union\Channels\Traits\ReservedTrait;
use SyPay\Union\Channels\Traits\RiskRateInfoTrait;
use SyPay\Union\Channels\Traits\SubMerInfoTrait;
use SyPay\Union\Channels\Traits\TokenPayDataTrait;
use SyPay\UtilUnion;
use SyPay\UtilUnionChannels;

/**
 * 银联全渠道支付交易开通接口
 * 用于开通银行卡的银联全渠道支付功能
 *
 * @package SyPay\Union\Channels\NoJump
 */
class TransactionOpen extends BaseNoJump
{
    use BizTypeTrait;
    use TokenPayDataTrait;
    use BackUrlTrait;
    use AccessTypeTrait;
    use ChannelTypeTrait;
    use OrderIdTrait;
    use SubMerInfoTrait;
    use EncryptCertIdTrait;
    use CtrlRuleTrait;
    use FrontUrlTrait;
    use MerInfoTrait;
    use AcqInsCodeTrait;
    use AccInfoTrait;
    use CertIdTrait;
    use ReservedTrait;
    use RiskRateInfoTrait;
    use ReqReservedTrait;
    use CustomerInfoTrait;

    public function __construct(string $merId, string $envType)
    {
        parent::__construct($merId, $envType);
        $this->reqDomain .= '/gateway/api/frontTransReq.do';
        $this->reqData['bizType'] = '000301';
        $this->reqData['backUrl'] = 'http://www.specialUrl.com';
        $this->reqData['txnType'] = '79';
        $this->reqData['txnSubType'] = '00';
        $this->reqData['accessType'] = 0;
    }

    public function __clone()
    {
    }

    /**
     * @param array $billQueryInfo
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setBillQueryInfo(array $billQueryInfo)
    {
        if (empty($billQueryInfo)) {
            throw new UnionException('账单要素不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }

        $this->reqData['billQueryInfo'] = UtilUnion::getSignStr($billQueryInfo);
    }

    /**
     * @return array
     *
     * @throws \SyException\Pay\UnionException
     */
    public function getDetail() : array
    {
        if (!isset($this->reqData['tokenPayData'])) {
            throw new UnionException('标记化支付信息域不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
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
