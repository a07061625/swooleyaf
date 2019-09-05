<?php
/**
 * 个性化菜单创建
 * User: 姜伟
 * Date: 2018/11/1 0001
 * Time: 17:16
 */
namespace AliPay\Life;

use AliPay\AliPayBase;
use SyConstant\ErrorCode;
use SyException\AliPay\AliPayLifeException;

class PersonalMenuCreate extends AliPayBase
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
    /**
     * 标签规则
     * @var array
     */
    private $label_rule = [];

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->biz_content['type'] = 'text';
        $this->biz_content['button'] = [];
        $this->biz_content['label_rule'] = [];
        $this->setMethod('alipay.open.public.personalized.menu.create');
    }

    private function __clone()
    {
    }

    /**
     * @param string $type
     * @throws \SyException\AliPay\AliPayLifeException
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
     * @throws \SyException\AliPay\AliPayLifeException
     */
    public function addButton(array $button)
    {
        if (!empty($button)) {
            $this->biz_content['button'][] = $button;
        } else {
            throw new AliPayLifeException('菜单内容不合法', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
        }
    }

    /**
     * @param array $labelRule
     * @throws \SyException\AliPay\AliPayLifeException
     */
    public function addLabelRule(array $labelRule)
    {
        if (!empty($labelRule)) {
            $this->biz_content['label_rule'][] = $labelRule;
        } else {
            throw new AliPayLifeException('标签规则不合法', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (count($this->biz_content['button']) == 0) {
            throw new AliPayLifeException('菜单列表不能为空', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
        }
        if (count($this->biz_content['label_rule']) == 0) {
            throw new AliPayLifeException('标签规则不能为空', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
