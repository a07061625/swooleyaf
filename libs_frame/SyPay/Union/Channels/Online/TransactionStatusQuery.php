<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 9:18
 */
namespace SyPay\Union\Channels\Online;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;
use SyPay\Union\Channels\BaseOnline;
use SyPay\Union\Channels\Traits\AccessTypeTrait;
use SyPay\Union\Channels\Traits\CertIdTrait;
use SyPay\Union\Channels\Traits\OrderIdTrait;
use SyPay\Union\Channels\Traits\ReservedTrait;
use SyPay\UtilUnionChannels;

/**
 * 交易状态查询接口
 * 对于未收到交易结果的联机交易,商户应向银联全渠道支付平台发起交易状态查询交易,查询交易结果
 * 完成交易的过程不需要同持卡人交互,属于后台交易
 * 交易查询类交易可由商户通过SDK向银联全渠道支付交易平台发起交易
 *
 * @package SyPay\Union\Channels\Online
 */
class TransactionStatusQuery extends BaseOnline
{
    use AccessTypeTrait;
    use OrderIdTrait;
    use CertIdTrait;
    use ReservedTrait;

    public function __construct(string $merId, string $envType)
    {
        parent::__construct($merId, $envType);
        $this->reqDomain .= '/gateway/api/queryTrans.do';
        $this->reqData['bizType'] = '000000';
        $this->reqData['txnType'] = '00';
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
        if (!isset($this->reqData['orderId'])) {
            throw new UnionException('商户订单号不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        UtilUnionChannels::createSign($this->reqData['merId'], $this->reqData);

        return $this->getChannelsContent();
    }
}
