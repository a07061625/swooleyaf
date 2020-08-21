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
use SyPay\Union\Channels\Traits\AcqInsCodeTrait;
use SyPay\Union\Channels\Traits\BillQueryInfoTrait;
use SyPay\Union\Channels\Traits\BussCodeTrait;
use SyPay\Union\Channels\Traits\CertIdTrait;
use SyPay\Union\Channels\Traits\ChannelTypeTrait;
use SyPay\Union\Channels\Traits\OrderIdTrait;
use SyPay\Union\Channels\Traits\OrigQryIdTrait;
use SyPay\Union\Channels\Traits\ReqReservedTrait;
use SyPay\Union\Channels\Traits\ReservedTrait;
use SyPay\Union\Channels\Traits\SubMerInfoTrait;
use SyPay\UtilUnionChannels;

/**
 * 账单查询接口
 * 通过填写账单编号等信息,使用账单查询类交易为持卡人提供如便民缴费、网上缴税、信用卡还款、保险缴费等相关的账单查询服务
 *
 * @package SyPay\Union\Channels\Convenience
 */
class BillQuery extends BaseConvenience
{
    use AccessTypeTrait;
    use ChannelTypeTrait;
    use OrderIdTrait;
    use BussCodeTrait;
    use SubMerInfoTrait;
    use AcqInsCodeTrait;
    use OrigQryIdTrait;
    use CertIdTrait;
    use ReservedTrait;
    use ReqReservedTrait;
    use BillQueryInfoTrait;

    public function __construct(string $merId, string $envType)
    {
        parent::__construct($merId, $envType);
        $this->reqDomain .= '/jiaofei/api/backTransReq.do';
        $this->reqData['bizType'] = '000601';
        $this->reqData['txnType'] = '73';
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
        if (!isset($this->reqData['bussCode'])) {
            throw new UnionException('业务代码不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        UtilUnionChannels::createSign($this->reqData['merId'], $this->reqData);

        return $this->getChannelsContent();
    }
}
