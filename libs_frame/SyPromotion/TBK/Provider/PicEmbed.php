<?php
/**
 * 生成商业化图片
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Provider;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyPromotion\TBK\Traits\SetAdZoneIdTrait;
use SyPromotion\TBK\Traits\SetSiteIdTrait;

/**
 * Class PicEmbed
 *
 * @package SyPromotion\TBK\Provider
 */
class PicEmbed extends BaseTBK
{
    use SetAdZoneIdTrait;
    use SetSiteIdTrait;

    /**
     * 广告位ID
     *
     * @var int
     */
    private $adzone_id = 0;
    /**
     * 商品ID
     *
     * @var int
     */
    private $item_id = 0;
    /**
     * 图片地址
     *
     * @var string
     */
    private $pic_stream = '';
    /**
     * 渠道管理ID
     *
     * @var string
     */
    private $relation_id = '';
    /**
     * 网站ID
     *
     * @var int
     */
    private $site_id = 0;

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.sc.pic.embed');
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setItemId(int $itemId)
    {
        if ($itemId > 0) {
            $this->reqData['item_id'] = $itemId;
        } else {
            throw new TBKException('商品ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setPicStream(string $picStream)
    {
        if (is_file($picStream) && is_readable($picStream)) {
            $this->reqData['pic_stream'] = '@' . $picStream;
        } else {
            throw new TBKException('图片地址不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setRelationId(string $relationId)
    {
        if (\strlen($relationId) > 0) {
            $this->reqData['relation_id'] = $relationId;
        } else {
            throw new TBKException('渠道管理ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['adzone_id'])) {
            throw new TBKException('广告位ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['item_id'])) {
            throw new TBKException('商品ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['site_id'])) {
            throw new TBKException('网站ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['pic_stream'])) {
            throw new TBKException('图片地址不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
