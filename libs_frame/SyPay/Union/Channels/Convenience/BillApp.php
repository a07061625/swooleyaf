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
use SyPay\Union\Channels\Traits\AcqInsCodeTrait;
use SyPay\Union\Channels\Traits\BackUrlTrait;
use SyPay\Union\Channels\Traits\BillQueryInfoTrait;
use SyPay\Union\Channels\Traits\BussCodeTrait;
use SyPay\Union\Channels\Traits\CertIdTrait;
use SyPay\Union\Channels\Traits\ChannelTypeTrait;
use SyPay\Union\Channels\Traits\CtrlRuleTrait;
use SyPay\Union\Channels\Traits\CurrencyCodeTrait;
use SyPay\Union\Channels\Traits\CustomerInfoTrait;
use SyPay\Union\Channels\Traits\CustomerIpTrait;
use SyPay\Union\Channels\Traits\EncryptCertIdTrait;
use SyPay\Union\Channels\Traits\FrontUrlTrait;
use SyPay\Union\Channels\Traits\InstalTransInfoTrait;
use SyPay\Union\Channels\Traits\IssInsCodeTrait;
use SyPay\Union\Channels\Traits\MerInfoTrait;
use SyPay\Union\Channels\Traits\OrderIdTrait;
use SyPay\Union\Channels\Traits\OrigQryIdTrait;
use SyPay\Union\Channels\Traits\ReqReservedTrait;
use SyPay\Union\Channels\Traits\ReservedTrait;
use SyPay\Union\Channels\Traits\SubMerInfoTrait;
use SyPay\Union\Channels\Traits\TermIdTrait;
use SyPay\Union\Channels\Traits\TxnAmtTrait;
use SyPay\Union\Channels\Traits\UserMacTrait;
use SyPay\UtilUnionChannels;

/**
 * APP账单支付接口
 * 通过填写账单编号等信息,使用账单查询类交易为持卡人提供如便民缴费、网上缴税、信用卡还款、保险缴费等相关的账单支付服务
 *
 * @package SyPay\Union\Channels\Convenience
 */
class BillApp extends BaseConvenience
{
    use BackUrlTrait;
    use AccessTypeTrait;
    use ChannelTypeTrait;
    use OrderIdTrait;
    use BussCodeTrait;
    use ReservedTrait;
    use SubMerInfoTrait;
    use IssInsCodeTrait;
    use InstalTransInfoTrait;
    use EncryptCertIdTrait;
    use CurrencyCodeTrait;
    use TxnAmtTrait;
    use FrontUrlTrait;
    use MerInfoTrait;
    use AcqInsCodeTrait;
    use OrigQryIdTrait;
    use BillQueryInfoTrait;
    use AccInfoTrait;
    use CertIdTrait;
    use TermIdTrait;
    use CustomerIpTrait;
    use CtrlRuleTrait;
    use ReqReservedTrait;
    use CustomerInfoTrait;
    use UserMacTrait;

    public function __construct(string $merId, string $envType)
    {
        parent::__construct($merId, $envType);
        $this->reqDomain .= '/jiaofei/api/appTransReq.do';
        $this->reqData['bizType'] = '000601';
        $this->reqData['backUrl'] = 'http://www.specialUrl.com';
        $this->reqData['txnType'] = '13';
        $this->reqData['txnSubType'] = '01';
        $this->reqData['accessType'] = 0;
        $this->reqData['currencyCode'] = '156';
    }

    public function __clone()
    {
    }

    /**
     * @param string $bizType
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setBizType(string $bizType)
    {
        if (in_array($bizType, ['000601', '000902'])) {
            $this->reqData['bizType'] = $bizType;
        } else {
            throw new UnionException('产品类型不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
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
