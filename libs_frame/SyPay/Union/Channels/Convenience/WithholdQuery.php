<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/13 0013
 * Time: 10:19
 */
namespace SyPay\Union\Channels\Convenience;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;
use SyPay\Union\Channels\BaseConvenience;
use SyPay\Union\Channels\Traits\AccessTypeTrait;
use SyPay\Union\Channels\Traits\AccInfoTrait;
use SyPay\Union\Channels\Traits\CertIdTrait;
use SyPay\Union\Channels\Traits\ChannelTypeTrait;
use SyPay\Union\Channels\Traits\CustomerInfoTrait;
use SyPay\Union\Channels\Traits\EncryptCertIdTrait;
use SyPay\Union\Channels\Traits\OrderIdTrait;
use SyPay\Union\Channels\Traits\ReqReservedTrait;
use SyPay\Union\Channels\Traits\ReservedTrait;
use SyPay\UtilUnionChannels;

/**
 * 代缴查询接口
 * 对于未收到交易结果的代缴建立委托联机交易,商户应向银联全渠道平台发起代缴建立委托交易状态查询交易,查询是否成功建立代缴委托
 * 完成交易的过程不需要同持卡人交互,属于后台交易
 *
 * @package SyPay\Union\Channels\Convenience
 */
class WithholdQuery extends BaseConvenience
{
    use AccessTypeTrait;
    use ChannelTypeTrait;
    use OrderIdTrait;
    use EncryptCertIdTrait;
    use CustomerInfoTrait;
    use AccInfoTrait;
    use CertIdTrait;
    use ReservedTrait;
    use ReqReservedTrait;

    public function __construct(string $merId, string $envType)
    {
        parent::__construct($merId, $envType);
        $this->reqDomain .= '/jiaofei/api/backTransReq.do';
        $this->reqData['bizType'] = '000601';
        $this->reqData['txnType'] = '75';
        $this->reqData['txnSubType'] = '02';
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
