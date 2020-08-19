<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 14:48
 */
namespace SyPay\Union\Channels\NoJump;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;
use SyPay\Union\Channels\BaseNoJump;
use SyPay\Union\Channels\Traits\AccessTypeTrait;
use SyPay\Union\Channels\Traits\BackUrlTrait;
use SyPay\Union\Channels\Traits\CertIdTrait;
use SyPay\Union\Channels\Traits\ChannelTypeTrait;
use SyPay\Union\Channels\Traits\CustomerInfoTrait;
use SyPay\Union\Channels\Traits\EncryptCertIdTrait;
use SyPay\Union\Channels\Traits\OrderIdTrait;
use SyPay\Union\Channels\Traits\ReqReservedTrait;
use SyPay\Union\Channels\Traits\ReservedTrait;
use SyPay\Union\Channels\Traits\RiskRateInfoTrait;
use SyPay\Union\Channels\Traits\SubMerInfoTrait;
use SyPay\Union\Channels\Traits\TokenPayDataTrait;
use SyPay\UtilUnionChannels;

/**
 * 更新标记接口
 * 更新之前在银联全渠道支付平台申请的Token标记
 *
 * @package SyPay\Union\Channels\NoJump
 */
class TokenRefresh extends BaseNoJump
{
    use TokenPayDataTrait;
    use BackUrlTrait;
    use AccessTypeTrait;
    use ChannelTypeTrait;
    use OrderIdTrait;
    use SubMerInfoTrait;
    use EncryptCertIdTrait;
    use CustomerInfoTrait;
    use CertIdTrait;
    use ReservedTrait;
    use RiskRateInfoTrait;
    use ReqReservedTrait;

    public function __construct(string $merId, string $envType)
    {
        parent::__construct($merId, $envType);
        $this->reqDomain .= '/gateway/api/backTransReq.do';
        $this->reqData['bizType'] = '000902';
        $this->reqData['backUrl'] = 'http://www.specialUrl.com';
        $this->reqData['txnType'] = '79';
        $this->reqData['txnSubType'] = '03';
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
