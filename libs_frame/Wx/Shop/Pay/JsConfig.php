<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/11 0011
 * Time: 11:21
 */
namespace Wx\Shop\Pay;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use SyException\Wx\WxException;
use Tool\Tool;
use Wx\WxBaseShop;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;
use Wx\WxUtilShop;

class JsConfig extends WxBaseShop
{
    /**
     * @var int
     */
    private $timestamp = 0;
    /**
     * @var string
     */
    private $nonceStr = '';
    /**
     * @var string
     */
    private $url = '';
    /**
     * 平台类型 shop：公众号 openshop：第三方平台代理公众号
     * @var string
     */
    private $platType = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $shopConfig = WxConfigSingleton::getInstance()->getShopConfig($appId);
        $this->reqData['appId'] = $shopConfig->getAppId();
        $this->reqData['timestamp'] = Tool::getNowTime();
        $this->reqData['nonceStr'] = Tool::createNonceStr(32, 'numlower');
        $this->url = $shopConfig->getPayAuthUrl();
        $this->platType = WxUtilBase::PLAT_TYPE_SHOP;
    }

    private function __clone()
    {
    }

    /**
     * @param int $timestamp
     */
    public function setTimestamp(int $timestamp)
    {
        if ($timestamp > 0) {
            $this->reqData['timestamp'] = $timestamp;
        }
    }

    /**
     * @param string $nonceStr
     */
    public function setNonceStr(string $nonceStr)
    {
        $length = strlen($nonceStr);
        if (ctype_alnum($nonceStr) && ($length >= 16) && ($length <= 32)) {
            $this->reqData['nonceStr'] = $nonceStr;
        }
    }

    /**
     * @param string $url
     * @throws \SyException\Wx\WxException
     */
    public function setUrl(string $url)
    {
        if (preg_match('/^(http|https)\:\/\/\S+$/', $url) > 0) {
            $this->url = $url;
        } else {
            throw new WxException('链接不合法', ErrorCode::WX_PARAM_ERROR);
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
     * @return array
     */
    public function getDetail() : array
    {
        if ($this->platType == WxUtilBase::PLAT_TYPE_SHOP) { //公众号获取jsapi_ticket
            $ticket = WxUtilShop::getJsTicket($this->reqData['appId']);
        } else { //第三方平台获取jsapi_ticket
            $ticket = WxUtilOpenBase::getAuthorizerJsTicket($this->reqData['appId']);
        }

        $needStr = 'jsapi_ticket=' . $ticket . '&noncestr=' . $this->reqData['nonceStr'] . '&timestamp=' . $this->reqData['timestamp'] . '&url=' . $this->url;
        $this->reqData['signature'] = sha1($needStr);
        return $this->reqData;
    }
}
