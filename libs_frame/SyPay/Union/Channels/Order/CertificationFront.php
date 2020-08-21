<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/13 0013
 * Time: 10:22
 */
namespace SyPay\Union\Channels\Order;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;
use SyPay\Union\Channels\BaseOrder;
use SyPay\Union\Channels\Traits\AccessTypeTrait;
use SyPay\Union\Channels\Traits\AccInfoTrait;
use SyPay\Union\Channels\Traits\AcqInsCodeTrait;
use SyPay\Union\Channels\Traits\BackUrlTrait;
use SyPay\Union\Channels\Traits\CertIdTrait;
use SyPay\Union\Channels\Traits\ChannelTypeTrait;
use SyPay\Union\Channels\Traits\CustomerInfoTrait;
use SyPay\Union\Channels\Traits\EncryptCertIdTrait;
use SyPay\Union\Channels\Traits\FrontUrlTrait;
use SyPay\Union\Channels\Traits\IssInsCodeTrait;
use SyPay\Union\Channels\Traits\MerInfoTrait;
use SyPay\Union\Channels\Traits\OrderIdTrait;
use SyPay\Union\Channels\Traits\PayCardTypeTrait;
use SyPay\Union\Channels\Traits\ReqReservedTrait;
use SyPay\Union\Channels\Traits\ReservedTrait;
use SyPay\Union\Channels\Traits\RiskRateInfoTrait;
use SyPay\Union\Channels\Traits\SubMerInfoTrait;
use SyPay\Union\Channels\Traits\UserMacTrait;
use SyPay\UtilUnionChannels;

/**
 * 前台实名认证接口
 * 为了验证银行卡验证信息及身份信息如证件类型、证件号码、姓名、密码、CVN2、有效期、手机号等与银行卡号的一致性,并支持实名认证通过后在银联留存绑定关系,方便后续扣款
 *
 * @package SyPay\Union\Channels\Order
 */
class CertificationFront extends BaseOrder
{
    use AccessTypeTrait;
    use ChannelTypeTrait;
    use OrderIdTrait;
    use SubMerInfoTrait;
    use BackUrlTrait;
    use EncryptCertIdTrait;
    use FrontUrlTrait;
    use MerInfoTrait;
    use AcqInsCodeTrait;
    use CustomerInfoTrait;
    use AccInfoTrait;
    use CertIdTrait;
    use ReservedTrait;
    use IssInsCodeTrait;
    use RiskRateInfoTrait;
    use ReqReservedTrait;
    use PayCardTypeTrait;
    use UserMacTrait;

    public function __construct(string $merId, string $envType)
    {
        parent::__construct($merId, $envType);
        $this->reqDomain .= '/gateway/api/frontTransReq.do';
        $this->reqData['bizType'] = '001001';
        $this->reqData['backUrl'] = 'http://www.specialUrl.com';
        $this->reqData['txnType'] = '72';
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
