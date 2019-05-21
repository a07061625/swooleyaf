<?php
/**
 * 默认菜单更新接口
 * User: 姜伟
 * Date: 2018/11/1 0001
 * Time: 16:58
 */
namespace AliPay\Life;

use AliPay\AliPayBase;
use Constant\ErrorCode;
use Exception\AliPay\AliPayLifeException;

class MenuModify extends AliPayBase
{
    /**
     * 菜单类型
     * @var string
     */
    private $type = '';
    /**
     * 菜单列表
     * @var array
     */
    private $button = [];

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setMethod('alipay.open.public.menu.modify');
    }

    private function __clone()
    {
    }

    /**
     * @param string $type
     * @throws \Exception\AliPay\AliPayLifeException
     */
    public function setType(string $type)
    {
        if (in_array($type, ['icon', 'text'], true)) {
            $this->biz_content['type'] = $type;
        } else {
            throw new AliPayLifeException('菜单类型不合法', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
        }
    }

    /**
     * @param array $button
     * @throws \Exception\AliPay\AliPayLifeException
     */
    public function addButton(array $button)
    {
        if (!empty($button)) {
            $this->biz_content['button'][] = $button;
        } else {
            throw new AliPayLifeException('菜单内容不合法', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (count($this->biz_content['button']) == 0) {
            throw new AliPayLifeException('菜单列表不能为空', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
