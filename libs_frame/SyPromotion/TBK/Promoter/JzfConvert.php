<?php
/**
 * 对输入商品相关查询内容进行找福利页面链接转链
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Promoter;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyPromotion\TBK\Traits\SetAdZoneIdTrait;

/**
 * Class JzfConvert
 *
 * @package SyPromotion\TBK\Promoter
 */
class JzfConvert extends BaseTBK
{
    use SetAdZoneIdTrait;

    /**
     * 内容
     *
     * @var string
     */
    private $content = '';
    /**
     * 类型
     *
     * @var int
     */
    private $type = 0;
    /**
     * 广告位ID
     *
     * @var int
     */
    private $adzone_id = 0;

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.jzf.convert');
        $this->reqData['type'] = 1;
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setContent(string $content)
    {
        if (\strlen($content) > 0) {
            $this->reqData['content'] = $content;
        } else {
            throw new TBKException('内容不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setType(int $type)
    {
        if (\in_array($type, [1, 2])) {
            $this->reqData['type'] = $type;
        } else {
            throw new TBKException('类型不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['content'])) {
            throw new TBKException('内容不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['adzone_id'])) {
            throw new TBKException('广告位ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
