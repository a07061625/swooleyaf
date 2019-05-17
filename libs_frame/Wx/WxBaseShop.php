<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/11 0011
 * Time: 8:52
 */
namespace Wx;

use Constant\ErrorCode;
use Exception\Wx\WxException;

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
     * @param string $app_id
     * @throws \Exception\Wx\WxException
     */
    public function setMerchantAppId(string $app_id)
    {
        if ($this->merchantType != self::MERCHANT_TYPE_SUB) {
            throw new WxException('非服务商', ErrorCode::WX_PARAM_ERROR);
        }
        if (ctype_alnum($app_id)) {
            throw new WxException('服务商应用ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
        if (strlen($app_id) != 18) {
            throw new WxException('服务商应用ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['appid'] = $app_id;
    }

    /**
     * @param string $mch_id
     * @throws \Exception\Wx\WxException
     */
    public function setMerchantMchId(string $mch_id)
    {
        if ($this->merchantType != self::MERCHANT_TYPE_SUB) {
            throw new WxException('非服务商', ErrorCode::WX_PARAM_ERROR);
        }
        if (!ctype_digit($mch_id)) {
            throw new WxException('服务商商户号不合法', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['mch_id'] = $mch_id;
    }

    /**
     * @throws \Exception\Wx\WxException
     */
    protected function checkMerchantParams()
    {
        if ($this->merchantType == self::MERCHANT_TYPE_SUB) {
            if (!isset($this->reqData['appid'])) {
                throw new WxException('服务商应用ID不能为空', ErrorCode::WX_PARAM_ERROR);
            }
            if (!isset($this->reqData['mch_id'])) {
                throw new WxException('服务商商户号不能为空', ErrorCode::WX_PARAM_ERROR);
            }
        }
    }
}
