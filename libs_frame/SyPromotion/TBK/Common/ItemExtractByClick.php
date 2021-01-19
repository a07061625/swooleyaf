<?php
/**
 * 从淘宝客推广长链接或短链接中解析出open_iid(即识别商品的id)
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:38
 */

namespace SyPromotion\TBK\Common;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;

/**
 * Class ItemExtractByClick
 *
 * @package SyPromotion\TBK\Common
 */
class ItemExtractByClick extends BaseTBK
{
    /**
     * 推广链接
     *
     * @var string
     */
    private $click_url = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.item.click.extract');
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setClickUrl(string $clickUrl)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $clickUrl) > 0) {
            $this->reqData['click_url'] = $clickUrl;
        } else {
            throw new TBKException('推广链接不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['click_url'])) {
            throw new TBKException('推广链接不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
