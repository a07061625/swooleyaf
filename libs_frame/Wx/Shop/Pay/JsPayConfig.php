<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/11 0011
 * Time: 11:14
 */
namespace Wx\Shop\Pay;

use Constant\ErrorCode;
use Exception\Wx\WxException;
use Tool\Tool;
use Wx\WxBaseShop;
use Wx\WxUtilShop;

class JsPayConfig extends WxBaseShop {
    /**
     * 时间戳
     * @var string
     */
    private $timeStamp = '';
    /**
     * 随机字符串
     * @var string
     */
    private $nonceStr = '';
    /**
     * 预支付交易会话标识
     * @var string
     */
    private $package = '';
    /**
     * 签名类型
     * @var string
     */
    private $signType = '';

    public function __construct(string $appId) {
        parent::__construct();
        $this->reqData['appId'] = $appId;
        $this->reqData['signType'] = 'MD5';
        $this->reqData['nonceStr'] = Tool::createNonceStr(32, 'numlower');
    }

    private function __clone(){
    }

    /**
     * @param string $timeStamp
     * @throws \Exception\Wx\WxException
     */
    public function setTimeStamp(string $timeStamp) {
        if(ctype_digit($timeStamp) && (strlen($timeStamp) == 10) && ($timeStamp{0} != '0')){
            $this->reqData['timeStamp'] = $timeStamp;
        } else {
            throw new WxException('时间戳不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $package
     * @throws \Exception\Wx\WxException
     */
    public function setPackage(string $package) {
        if(ctype_alnum($package) && (strlen($package) <= 64)){
            $this->reqData['package'] = 'prepay_id=' . $package;
        } else {
            throw new WxException('预支付交易会话标识不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array {
        if(!isset($this->reqData['timeStamp'])){
            throw new WxException('时间戳不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if(!isset($this->reqData['package'])){
            throw new WxException('交易会话标识不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['paySign'] = WxUtilShop::createSign($this->reqData, $this->reqData['appId']);
        return $this->reqData;
    }
}