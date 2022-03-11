<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/11 0011
 * Time: 11:37
 */

namespace Wx\Payment\Way;

use DesignPatterns\Singletons\WxConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\Account\Tools\ShortUrl;
use Wx\WxBasePayment;
use Wx\WxUtilAccount;

class PayNativePre extends WxBasePayment
{
    /**
     * 商户号
     *
     * @var string
     */
    private $mch_id = '';
    /**
     * 当前时间戳
     *
     * @var int
     */
    private $time_stamp = 0;
    /**
     * 随机字符串，不长于32位
     *
     * @var string
     */
    private $nonce_str = '';
    /**
     * 商户定义的商品id
     *
     * @var string
     */
    private $product_id = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $accountConfig = WxConfigSingleton::getInstance()->getAccountConfig($appId);
        $this->reqData['appid'] = $accountConfig->getAppId();
        $this->reqData['mch_id'] = $accountConfig->getPayMchId();
        $this->reqData['time_stamp'] = Tool::getNowTime();
        $this->reqData['nonce_str'] = Tool::createNonceStr(32);
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setProductId(string $productId)
    {
        if (ctype_alnum($productId) && (\strlen($productId) <= 32)) {
            $this->reqData['product_id'] = $productId;
        } else {
            throw  new WxException('商品ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * 获取预支付订单详情
     *
     * @throws \SyException\Wx\WxException
     */
    public function getDetail(): array
    {
        if (!isset($this->reqData['product_id'])) {
            throw  new WxException('商品ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['sign'] = WxUtilAccount::createSign($this->reqData, $this->reqData['appid']);
        //生成支付链接
        $codeUrl = 'weixin://wxpay/bizpayurl?sign=' . $this->reqData['sign']
                   . '&appid=' . $this->reqData['appid']
                   . '&mch_id=' . $this->reqData['mch_id']
                   . '&product_id=' . $this->reqData['product_id']
                   . '&time_stamp=' . $this->reqData['time_stamp']
                   . '&nonce_str=' . $this->reqData['nonce_str'];
        //转换成短链接
        $shortUrl = new ShortUrl($this->reqData['appid']);
        $shortUrl->setLongUrl($codeUrl);
        $detail = $shortUrl->getDetail();
        unset($shortUrl);

        return $detail;
    }
}
