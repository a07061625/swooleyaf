<?php
/**
 * 添加卡券配置
 * User: 姜伟
 * Date: 2019/8/1 0001
 * Time: 9:00
 */

namespace Wx\Alone;

use DesignPatterns\Singletons\WxConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseAlone;
use Wx\WxUtilAlone;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

class CardExtConfig extends WxBaseAlone
{
    /**
     * 应用ID
     *
     * @var string
     */
    private $appid = '';
    /**
     * 卡券列表
     *
     * @var array
     */
    private $card_list = [];
    /**
     * 时间戳
     *
     * @var int
     */
    private $timestamp = 0;
    /**
     * 随机字符串
     *
     * @var string
     */
    private $nonce_str = '';
    /**
     * 平台类型 shop：公众号 openshop：第三方平台代理公众号
     *
     * @var string
     */
    private $platType = '';
    /**
     * JS签名标识,true:需要JS签名 false:不需要JS签名
     *
     * @var bool
     */
    private $needJs = false;

    public function __construct(string $appId)
    {
        parent::__construct();
        $accountConfig = WxConfigSingleton::getInstance()->getAccountConfig($appId);
        $this->appid = $accountConfig->getAppId();
        $this->timestamp = Tool::getNowTime();
        $this->nonce_str = Tool::createNonceStr(32, 'numlower');
        $this->platType = WxUtilBase::PLAT_TYPE_SHOP;
    }

    private function __clone()
    {
        //do nothing
    }

    public function setCardList(array $cardList)
    {
        foreach ($cardList as $eCardInfo) {
            $cardId = \is_string($eCardInfo['card_id']) && (\strlen($eCardInfo['card_id']) > 0) ? $eCardInfo['card_id'] : '';
            if (\strlen($cardId) > 0) {
                $this->card_list[$cardId] = [
                    'code' => '',
                    'openid' => '',
                    'outer_str' => '',
                ];
                if (\is_string($eCardInfo['code']) && (\strlen($eCardInfo['code']) > 0)) {
                    $this->card_list[$cardId]['code'] = $eCardInfo['code'];
                }
                if (\is_string($eCardInfo['openid']) && (\strlen($eCardInfo['openid']) > 0)) {
                    $this->card_list[$cardId]['openid'] = $eCardInfo['openid'];
                }
                if (\is_string($eCardInfo['outer_str']) && (\strlen($eCardInfo['outer_str']) > 0)) {
                    $this->card_list[$cardId]['outer_str'] = $eCardInfo['outer_str'];
                }
                if (\is_int($eCardInfo['fixed_begintimestamp']) && ($eCardInfo['fixed_begintimestamp'] > 0)) {
                    $this->card_list[$cardId]['fixed_begintimestamp'] = (string)$eCardInfo['fixed_begintimestamp'];
                }
            }
        }
    }

    /**
     * @param string $platType 平台类型 shop：公众号 openshop：第三方平台代理公众号
     *
     * @throws \SyException\Wx\WxException
     */
    public function setPlatType(string $platType)
    {
        if (\in_array($platType, [WxUtilBase::PLAT_TYPE_SHOP, WxUtilBase::PLAT_TYPE_OPEN_SHOP], true)) {
            $this->platType = $platType;
        } else {
            throw new WxException('平台类型不支持', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function setNeedJs(bool $needJs)
    {
        $this->needJs = $needJs;
    }

    public function getDetail(): array
    {
        if (empty($this->card_list)) {
            throw new WxException('卡券列表不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (WxUtilBase::PLAT_TYPE_SHOP == $this->platType) { //公众号获取card_ticket
            $ticket = WxUtilAlone::getCardTicket($this->appid);
        } else { //第三方平台获取card_ticket
            $ticket = WxUtilOpenBase::getAuthorizerCardTicket($this->appid);
        }

        $resArr = [
            'card_list' => [],
        ];
        foreach ($this->card_list as $cardId => $cardInfo) {
            $signData = [
                'api_ticket' => $ticket,
                'timestamp' => (string)$this->timestamp,
                'card_id' => $cardId,
                'code' => $cardInfo['code'],
                'openid' => $cardInfo['openid'],
                'nonce_str' => $this->nonce_str,
            ];
            sort($signData);
            $cardInfo['signature'] = sha1(implode('', $signData));
            $cardInfo['timestamp'] = $signData['timestamp'];
            $cardInfo['nonce_str'] = $signData['nonce_str'];
            $resArr['card_list'][] = [
                'cardId' => $cardId,
                'cardExt' => Tool::jsonEncode($cardInfo, JSON_UNESCAPED_UNICODE),
            ];
        }

        if ($this->needJs) {
            $jsConfig = new JsConfig($this->appid);
            $jsConfig->setPlatType($this->platType);
            $jsConfig->setTimestamp($this->timestamp);
            $jsConfig->setNonceStr($this->nonce_str);
            $resArr['js_config'] = $jsConfig->getDetail();
        }

        return $resArr;
    }
}
