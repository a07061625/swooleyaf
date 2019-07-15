<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/11 0011
 * Time: 8:52
 */
namespace Wx;

use Constant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use SyException\Wx\WxException;

abstract class WxBaseShop extends WxBase
{
    const MATERIAL_TYPE_IMAGE = 'image';
    const MATERIAL_TYPE_VOICE = 'voice';
    const MATERIAL_TYPE_VIDEO = 'video';
    const MATERIAL_TYPE_THUMB = 'thumb';
    const MESSAGE_TYPE_MPNEWS = 'mpnews';
    const MESSAGE_TYPE_TEXT = 'text';
    const MESSAGE_TYPE_VOICE = 'voice';
    const MESSAGE_TYPE_MUSIC = 'music';
    const MESSAGE_TYPE_IMAGE = 'image';
    const MESSAGE_TYPE_VIDEO = 'video';
    const MESSAGE_TYPE_WXCARD = 'wxcard';
    const MERCHANT_TYPE_SELF = 'self'; //商户类型-自身
    const MERCHANT_TYPE_SUB = 'sub'; //商户类型-子商户,属于服务商下

    protected static $totalMaterialType = [
        self::MATERIAL_TYPE_IMAGE => '图片',
        self::MATERIAL_TYPE_VOICE => '语音',
        self::MATERIAL_TYPE_VIDEO => '视频',
        self::MATERIAL_TYPE_THUMB => '缩略图',
    ];
    protected static $totalMessageType = [
        self::MESSAGE_TYPE_MPNEWS => '图文',
        self::MESSAGE_TYPE_TEXT => '文本',
        self::MESSAGE_TYPE_VOICE => '语音',
        self::MESSAGE_TYPE_MUSIC => '音乐',
        self::MESSAGE_TYPE_IMAGE => '图片',
        self::MESSAGE_TYPE_VIDEO => '视频',
        self::MESSAGE_TYPE_WXCARD => '卡券',
    ];
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
                throw new \SyException\Wx\WxException('服务商微信号不能为空', ErrorCode::WX_PARAM_ERROR);
            }
            $merchantConfig = WxConfigSingleton::getInstance()->getShopConfig($merchantAppId);
            $this->reqData['appid'] = $merchantConfig->getAppId();
            $this->reqData['mch_id'] = $merchantConfig->getPayMchId();
            $this->reqData['sub_appid'] = $configAccount->getAppId();
            $this->reqData['sub_mch_id'] = $configAccount->getPayMchId();
        }
    }
}
