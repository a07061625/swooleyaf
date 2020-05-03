<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/11 0011
 * Time: 8:52
 */
namespace Wx;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use SyException\Wx\WxException;

abstract class WxBasePayment extends WxBase
{
    const MERCHANT_TYPE_SELF = 'self'; //商户类型-自身
    const MERCHANT_TYPE_SUB = 'sub'; //商户类型-子商户,属于服务商下

    protected static $totalMerchantType = [
        self::MERCHANT_TYPE_SELF => '自身',
        self::MERCHANT_TYPE_SUB => '子商户',
    ];

    /**
     * 商户类型
     * @var string
     */
    protected $merchantType = '';

    public function __construct()
    {
        parent::__construct();
        $this->merchantType = self::MERCHANT_TYPE_SELF;
    }

    /**
     * @param \Wx\WxConfigAccount $configAccount
     * @throws \SyException\Wx\WxException
     */
    protected function setAppIdAndMchId(WxConfigAccount $configAccount)
    {
        if ($this->merchantType == self::MERCHANT_TYPE_SELF) {
            $this->reqData['appid'] = $configAccount->getAppId();
            $this->reqData['mch_id'] = $configAccount->getPayMchId();
        } else {
            $merchantAppId = $configAccount->getMerchantAppId();
            if (strlen($merchantAppId) == 0) {
                throw new WxException('服务商微信号不能为空', ErrorCode::WX_PARAM_ERROR);
            }
            $merchantConfig = WxConfigSingleton::getInstance()->getAccountConfig($merchantAppId);
            $this->reqData['appid'] = $merchantConfig->getAppId();
            $this->reqData['mch_id'] = $merchantConfig->getPayMchId();
            $this->reqData['sub_appid'] = $configAccount->getAppId();
            $this->reqData['sub_mch_id'] = $configAccount->getPayMchId();
        }
    }
}
