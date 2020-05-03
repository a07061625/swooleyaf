<?php
/**
 * 拉取卡券配置
 * User: 姜伟
 * Date: 2019/7/30 0030
 * Time: 19:13
 */
namespace Wx\Alone;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseAlone;
use Wx\WxUtilAlone;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

class CardConfig extends WxBaseAlone
{
    /**
     * 应用ID
     * @var string
     */
    private $appid = '';
    /**
     * 时间戳
     * @var int
     */
    private $timestamp = 0;
    /**
     * 随机字符串
     * @var string
     */
    private $nonceStr = '';
    /**
     * 签名方式
     * @var string
     */
    private $signType = '';
    /**
     * 门店ID
     * @var string
     */
    private $shopId = '';
    /**
     * 卡券ID
     * @var string
     */
    private $cardId = '';
    /**
     * 卡券类型
     * @var string
     */
    private $cardType = '';
    /**
     * 平台类型 shop：公众号 openshop：第三方平台代理公众号
     * @var string
     */
    private $platType = '';
    /**
     * JS签名标识,true:需要JS签名 false:不需要JS签名
     * @var bool
     */
    private $needJs = false;

    public function __construct(string $appId)
    {
        parent::__construct();
        $accountConfig = WxConfigSingleton::getInstance()->getAccountConfig($appId);
        $this->appid = $accountConfig->getAppId();
        $this->reqData['timestamp'] = Tool::getNowTime();
        $this->reqData['nonceStr'] = Tool::createNonceStr(32, 'numlower');
        $this->reqData['signType'] = 'SHA1';
        $this->reqData['shopId'] = '';
        $this->reqData['cardType'] = '';
        $this->reqData['cardId'] = '';
        $this->platType = WxUtilBase::PLAT_TYPE_SHOP;
    }

    private function __clone()
    {
    }

    /**
     * @param string $shopId
     * @throws \SyException\Wx\WxException
     */
    public function setShopId(string $shopId)
    {
        if (strlen($shopId) <= 24) {
            $this->reqData['shopId'] = $shopId;
        } else {
            throw new WxException('门店ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $cardId
     * @throws \SyException\Wx\WxException
     */
    public function setCardId(string $cardId)
    {
        if (strlen($cardId) <= 32) {
            $this->reqData['cardId'] = $cardId;
        } else {
            throw new WxException('卡券ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $cardType
     * @throws \SyException\Wx\WxException
     */
    public function setCardType(string $cardType)
    {
        if (strlen($cardType) <= 24) {
            $this->reqData['cardType'] = $cardType;
        } else {
            throw new WxException('卡券类型不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $platType 平台类型 shop：公众号 openshop：第三方平台代理公众号
     * @throws \SyException\Wx\WxException
     */
    public function setPlatType(string $platType)
    {
        if (in_array($platType, [WxUtilBase::PLAT_TYPE_SHOP, WxUtilBase::PLAT_TYPE_OPEN_SHOP], true)) {
            $this->platType = $platType;
        } else {
            throw new WxException('平台类型不支持', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param bool $needJs
     */
    public function setNeedJs(bool $needJs)
    {
        $this->needJs = $needJs;
    }

    public function getDetail() : array
    {
        if ($this->platType == WxUtilBase::PLAT_TYPE_SHOP) { //公众号获取card_ticket
            $ticket = WxUtilAlone::getCardTicket($this->appid);
        } else { //第三方平台获取card_ticket
            $ticket = WxUtilOpenBase::getAuthorizerCardTicket($this->appid);
        }
        $signData = [
            'api_ticket' => $ticket,
            'appid' => $this->appid,
            'location_id' => $this->reqData['shopId'],
            'timestamp' => (string)$this->reqData['timestamp'],
            'nonce_str' => $this->reqData['nonceStr'],
            'card_id' => $this->reqData['cardId'],
            'card_type' => $this->reqData['cardType'],
        ];
        sort($signData);
        $this->reqData['cardSign'] = sha1(implode('', $signData));

        if ($this->needJs) {
            $jsConfig = new JsConfig($this->appid);
            $jsConfig->setPlatType($this->platType);
            $jsConfig->setTimestamp($this->reqData['timestamp']);
            $jsConfig->setNonceStr($this->reqData['nonceStr']);
            $this->reqData['jsConfig'] = $jsConfig->getDetail();
        }

        return $this->reqData;
    }
}
