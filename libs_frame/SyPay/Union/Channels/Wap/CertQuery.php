<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 9:36
 */
namespace SyPay\Union\Channels\Wap;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;
use SyPay\Union\Channels\BaseWap;
use SyPay\Union\Channels\Traits\AccessTypeTrait;
use SyPay\Union\Channels\Traits\AcqInsCodeTrait;
use SyPay\Union\Channels\Traits\CertIdTrait;
use SyPay\Union\Channels\Traits\ChannelTypeTrait;
use SyPay\Union\Channels\Traits\MerInfoTrait;
use SyPay\Union\Channels\Traits\OrderIdTrait;
use SyPay\Union\Channels\Traits\ReqReservedTrait;
use SyPay\Union\Channels\Traits\ReservedTrait;
use SyPay\Union\Channels\Traits\SubMerInfoTrait;
use SyPay\UtilUnionChannels;

/**
 * 银联加密公钥更新查询接口
 * 商户定期(1天1次)向银联全渠道系统发起获取加密公钥信息交易
 * 在加密公钥证书更新期间,全渠道系统支持新老证书的共同使用,新老证书并行期为1个月
 * 全渠道系统向商户返回最新的加密公钥证书,由商户服务器替换本地证书
 *
 * @package SyPay\Union\Channels\Wap
 */
class CertQuery extends BaseWap
{
    use AccessTypeTrait;
    use ChannelTypeTrait;
    use OrderIdTrait;
    use SubMerInfoTrait;
    use MerInfoTrait;
    use AcqInsCodeTrait;
    use ReservedTrait;
    use ReqReservedTrait;
    use CertIdTrait;

    public function __construct(string $merId, string $envType)
    {
        $this->reqDomains = [
            self::ENV_TYPE_PRODUCT => 'https://gateway.95516.com',
            self::ENV_TYPE_DEV => 'https://101.231.204.80:5000',
        ];
        parent::__construct($merId, $envType);
        $this->reqDomain .= '/gateway/api/backTransReq.do';
        $this->reqData['bizType'] = '000000';
        $this->reqData['txnType'] = '95';
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
