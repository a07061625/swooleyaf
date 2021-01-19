<?php
/**
 * 上传物料
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
 * Class MaterialUpload
 *
 * @package SyPromotion\TBK\Promoter
 */
class MaterialUpload extends BaseTBK
{
    /**
     * 请求参数
     *
     * @var array
     */
    private $param0 = [];

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.material.upload');
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setParam0(array $param0)
    {
        $trueParams = [];
        $mode = \is_string($param0['mode']) ? $param0['mode'] : '';
        if (\in_array($mode, ['overwrite', 'add', 'delete'])) {
            $trueParams['mode'] = $mode;
        } else {
            throw new TBKException('上传模式不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        $needTag = true;
        $materialId = \is_string($param0['material_id']) ? $param0['material_id'] : '';
        if (\strlen($materialId) > 0) {
            $trueParams['material_id'] = $materialId;
            $needTag = false;
        }

        $items = \is_array($param0['items']) ? $param0['items'] : [];
        $itemList = [];
        foreach ($items as $eItemId) {
            if (\is_string($eItemId) && (\strlen($eItemId) > 0)) {
                $itemList[] = [
                    'item_id' => $eItemId,
                ];
            }
        }
        if (\count($itemList) > 0) {
            $trueParams['items'] = $itemList;
            $needTag = false;
        }
        if ($needTag) {
            throw new TBKException('商品集id和商品列表不能都为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        $this->reqData['param0'] = Tool::jsonEncode($trueParams, JSON_UNESCAPED_UNICODE);
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['param0'])) {
            throw new TBKException('请求参数不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
