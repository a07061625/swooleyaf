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
 * 代缴申请接口
 *
 * @package SyPay\Union\Channels\Convenience
 */
class WithholdApply extends BaseConvenience
{
    use AccessTypeTrait;
    use ChannelTypeTrait;
    use OrderIdTrait;
    use BussCodeTrait;
    use BillQueryInfoTrait;
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
        $this->reqDomain .= '/jiaofei/api/backTransReq.do';
        $this->reqData['bizType'] = '000601';
        $this->reqData['backUrl'] = 'http://www.specialUrl.com';
        $this->reqData['txnType'] = '72';
        $this->reqData['txnSubType'] = '08';
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
        if (!isset($this->reqData['billQueryInfo'])) {
            throw new UnionException('账单要素不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        UtilUnionChannels::createSign($this->reqData['merId'], $this->reqData);

        return $this->getChannelsContent();
    }
}
