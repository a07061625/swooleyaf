<?php
/**
 * 	用户分组创建接口
 * User: 姜伟
 * Date: 2018/11/1 0001
 * Time: 14:40
 */
namespace AliPay\Life;

use AliPay\AliPayBase;
use SyConstant\ErrorCode;
use SyException\AliPay\AliPayLifeException;

class GroupCreate extends AliPayBase
{
    /**
     * 分组名称
     * @var string
     */
    private $name = '';
    /**
     * 标签规则
     * @var array
     */
    private $label_rule = [];

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->biz_content['label_rule'] = [];
        $this->setMethod('alipay.open.public.group.create');
    }

    private function __clone()
    {
    }

    /**
     * @param string $name
     * @throws \SyException\AliPay\AliPayLifeException
     */
    public function setName(string $name)
    {
        $length = strlen($name);
        if (($length > 0) && ($length <= 30)) {
            $this->biz_content['name'] = $name;
        } else {
            throw new AliPayLifeException('分组名称不合法', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
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
        if (!isset($this->biz_content['name'])) {
            throw new AliPayLifeException('分组名称不能为空', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
        }
        if (count($this->biz_content['label_rule']) == 0) {
            throw new AliPayLifeException('标签规则不能为空', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
