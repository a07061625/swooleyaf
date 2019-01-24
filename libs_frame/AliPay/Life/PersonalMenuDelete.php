<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/11/1 0001
 * Time: 17:18
 */
namespace AliPay\Life;

use AliPay\AliPayBase;
use Constant\ErrorCode;
use Exception\AliPay\AliPayLifeException;

class PersonalMenuDelete extends AliPayBase {
    /**
     * 菜单key
     * @var string
     */
    private $menu_key = '';

    public function __construct(string $appId){
        parent::__construct($appId);
        $this->setMethod('alipay.open.public.personalized.menu.delete');
    }

    private function __clone(){
    }

    /**
     * @param string $menuKey
     * @throws \Exception\AliPay\AliPayLifeException
     */
    public function setMenuKey(string $menuKey){
        if(ctype_alnum($menuKey) && (strlen($menuKey) <= 32)){
            $this->biz_content['menu_key'] = $menuKey;
        } else {
            throw new AliPayLifeException('菜单key不合法', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
        }
    }

    public function getDetail() : array {
        if(!isset($this->biz_content['menu_key'])){
            throw new AliPayLifeException('菜单key不能为空', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
        }

        return $this->getContent();
    }
}