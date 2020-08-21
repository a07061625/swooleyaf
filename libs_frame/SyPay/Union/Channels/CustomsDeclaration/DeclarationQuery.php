<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/13 0013
 * Time: 10:19
 */
namespace SyPay\Union\Channels\CustomsDeclaration;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;
use SyPay\Union\Channels\BaseCustomsDeclaration;
use SyPay\Union\Channels\Traits\AccessTypeTrait;
use SyPay\Union\Channels\Traits\AcqInsCodeTrait;
use SyPay\Union\Channels\Traits\CertIdTrait;
use SyPay\Union\Channels\Traits\OrderIdTrait;
use SyPay\Union\Channels\Traits\ReqReservedTrait;
use SyPay\Union\Channels\Traits\ReservedTrait;
use SyPay\UtilUnionChannels;

/**
 * 申报查询接口
 *
 * @package SyPay\Union\Channels\CustomsDeclaration
 */
class DeclarationQuery extends BaseCustomsDeclaration
{
    use AccessTypeTrait;
    use OrderIdTrait;
    use ReservedTrait;
    use AcqInsCodeTrait;
    use CertIdTrait;
    use ReqReservedTrait;

    public function __construct(string $merId, string $envType)
    {
        parent::__construct($merId, $envType);
        $this->reqDomain .= '/gateway/api/backTransReq.do';
        $this->reqData['bizType'] = '000000';
        $this->reqData['txnType'] = '00';
        $this->reqData['txnSubType'] = '00';
        $this->reqData['accessType'] = 0;
        $this->reqData['certType'] = '01';
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
