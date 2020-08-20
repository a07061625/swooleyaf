<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 8:47
 */
namespace SyPay\Union\Channels\Mobile;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;
use SyPay\Union\Channels\BaseMobile;
use SyPay\Union\Channels\Traits\AccessTypeTrait;
use SyPay\Union\Channels\Traits\BackUrlTrait;
use SyPay\Union\Channels\Traits\CertIdTrait;
use SyPay\Union\Channels\Traits\ChannelTypeTrait;
use SyPay\Union\Channels\Traits\OrderIdTrait;
use SyPay\Union\Channels\Traits\OrigQryIdTrait;
use SyPay\Union\Channels\Traits\ReqReservedTrait;
use SyPay\Union\Channels\Traits\ReservedTrait;
use SyPay\Union\Channels\Traits\SubMerInfoTrait;
use SyPay\Union\Channels\Traits\TermIdTrait;
use SyPay\Union\Channels\Traits\TxnAmtTrait;
use SyPay\UtilUnionChannels;

/**
 * 消费撤销接口
 * 因人为原因而撤销已完成的消费,商户可以通过SDK向银联全渠道支付平台发起消费撤销交易,消费撤销必须是撤销CUPS当日当批的消费
 * 发卡行批准的消费撤销金额将即时地反映到该持卡人的账户上
 * 完成交易的过程不需要同持卡人交互,属于后台交易
 *
 * @package SyPay\Union\Channels\Mobile
 */
class ConsumeCancel extends BaseMobile
{
    use BackUrlTrait;
    use TxnAmtTrait;
    use AccessTypeTrait;
    use ChannelTypeTrait;
    use OrderIdTrait;
    use OrigQryIdTrait;
    use SubMerInfoTrait;
    use CertIdTrait;
    use ReservedTrait;
    use ReqReservedTrait;
    use TermIdTrait;

    public function __construct(string $merId, string $envType)
    {
        parent::__construct($merId, $envType);
        $this->reqDomain .= '/gateway/api/backTransReq.do';
        $this->reqData['bizType'] = '000201';
        $this->reqData['backUrl'] = 'http://www.specialUrl.com';
        $this->reqData['txnType'] = '31';
        $this->reqData['txnSubType'] = '00';
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
        if (!isset($this->reqData['origQryId'])) {
            throw new UnionException('原交易查询流水号不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        UtilUnionChannels::createSign($this->reqData['merId'], $this->reqData);

        return $this->getChannelsContent();
    }
}
