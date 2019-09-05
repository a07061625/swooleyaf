<?php
/**
 * 生活号广告位修改接口
 * User: 姜伟
 * Date: 2018/11/1 0001
 * Time: 15:02
 */
namespace AliPay\Life;

use AliPay\AliPayBase;
use SyConstant\ErrorCode;
use SyException\AliPay\AliPayLifeException;

class AdvertModify extends AliPayBase
{
    /**
     * 广告ID
     * @var string
     */
    private $advert_id = '';
    /**
     * 广告内容列表
     * @var array
     */
    private $advert_items = [];

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->biz_content['advert_items'] = [];
        $this->setMethod('alipay.open.public.advert.modify');
    }

    private function __clone()
    {
    }

    /**
     * @param string $advertId
     * @throws \SyException\AliPay\AliPayLifeException
     */
    public function setAdvertId(string $advertId)
    {
        if (ctype_alnum($advertId) && (strlen($advertId) <= 20)) {
            $this->biz_content['advert_id'] = $advertId;
        } else {
            throw new AliPayLifeException('广告ID不合法', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
        }
    }

    /**
     * @param array $advertItem
     * @throws \SyException\AliPay\AliPayLifeException
     */
    public function addAdvertItems(array $advertItem)
    {
        if (count($this->biz_content['advert_items']) >= 3) {
            throw new AliPayLifeException('广告内容列表超过限制', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
        }
        if (empty($advertItem)) {
            throw new AliPayLifeException('广告内容不合法', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
        }
        $this->biz_content['advert_items'][] = $advertItem;
    }

    public function getDetail() : array
    {
        if (!isset($this->biz_content['advert_id'])) {
            throw new AliPayLifeException('广告ID不能为空', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
        }
        if (count($this->biz_content['advert_items']) == 0) {
            throw new AliPayLifeException('广告内容列表不能为空', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
