<?php
/**
 * 靠谱好货共建
 * 提供快手靠谱好货的同步接口,用于提报商品、2审商品、下架商品等操作的数据同步.注意:媒体端避免零点前后进行接口调用
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Promoter;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyTool\Tool;

/**
 * Class MediaReliableGoods
 *
 * @package SyPromotion\TBK\Promoter
 */
class MediaReliableGoods extends BaseTBK
{
    /**
     * 同步好货列表
     *
     * @var array
     */
    private $reliable_goods = [];

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.dg.media.reliable.goods');
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setReliableGoods(array $reliableGoods)
    {
        $goodsNum = \count($reliableGoods);
        if (0 == $goodsNum) {
            throw new TBKException('同步好货列表不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if ($goodsNum > 10) {
            throw new TBKException('同步好货列表不能超过10个', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        $this->reliable_goods = $reliableGoods;
    }

    public function getDetail(): array
    {
        if (empty($this->reliable_goods)) {
            throw new TBKException('同步好货列表不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        $this->reqData['reliable_good_request'] = Tool::jsonEncode([
            'reliable_good_request' => [
                'reliable_goods' => $this->reliable_goods,
            ],
        ], JSON_UNESCAPED_UNICODE);

        return $this->getContent();
    }
}
