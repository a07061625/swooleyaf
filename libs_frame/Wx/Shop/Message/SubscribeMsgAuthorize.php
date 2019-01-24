<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/22 0022
 * Time: 11:05
 */
namespace Wx\Shop\Message;

use Constant\ErrorCode;
use Exception\Wx\WxException;
use Tool\Tool;
use Wx\WxBaseShop;

class SubscribeMsgAuthorize extends WxBaseShop {
    /**
     * 公众号ID
     * @var string
     */
    private $appid = '';
    /**
     * 动作标识
     * @var string
     */
    private $action = '';
    /**
     * 订阅场景值
     * @var int
     */
    private $scene = 0;
    /**
     * 消息模板ID
     * @var string
     */
    private $template_id = '';
    /**
     * 重定向地址
     * @var string
     */
    private $redirect_url = '';
    /**
     * 防止跨站请求伪造攻击标识
     * @var string
     */
    private $reserved = '';

    public function __construct(string $appId){
        parent::__construct();
        $this->reqData['appid'] = $appId;
        $this->reqData['action'] = 'get_confirm';
        $this->reqData['reserved'] = Tool::createNonceStr(8);
    }

    private function __clone(){
    }

    /**
     * @param int $scene
     * @throws \Exception\Wx\WxException
     */
    public function setScene(int $scene){
        if(($scene >= 0) && ($scene <= 10000)){
            $this->reqData['scene'] = $scene;
        } else {
            throw new WxException('订阅场景值不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $templateId
     * @throws \Exception\Wx\WxException
     */
    public function setTemplateId(string $templateId){
        if(strlen($templateId) > 0){
            $this->reqData['template_id'] = $templateId;
        } else {
            throw new WxException('消息模板ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $redirectUrl
     * @throws \Exception\Wx\WxException
     */
    public function setRedirectUrl(string $redirectUrl){
        if (preg_match('/^(http|https)\:\/\/\S+$/', $redirectUrl) > 0) {
            $this->reqData['redirect_url'] = $redirectUrl;
        } else {
            throw new WxException('重定向地址不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $reserved
     * @throws \Exception\Wx\WxException
     */
    public function setReserved(string $reserved){
        if(ctype_alnum($reserved) && (strlen($reserved) <= 128)){
            $this->reqData['reserved'] = $reserved;
        } else {
            throw new WxException('防止跨站请求伪造攻击标识不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array {
        if(!isset($this->reqData['scene'])){
            throw new WxException('订阅场景值不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if(!isset($this->reqData['template_id'])){
            throw new WxException('消息模板ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if(!isset($this->reqData['redirect_url'])){
            throw new WxException('重定向地址不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        return [
            'url' => 'https://mp.weixin.qq.com/mp/subscribemsg?' . http_build_query($this->reqData) . '#wechat_redirect',
        ];
    }
}