<?php
/**
 * 查询返利商家授权
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Promoter;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyPromotion\TBK\Traits\SetFieldsTrait;

/**
 * Class RebateAuthGet
 *
 * @package SyPromotion\TBK\Promoter
 */
class RebateAuthGet extends BaseTBK
{
    use SetFieldsTrait;

    /**
     * 返回字段列表
     *
     * @var array
     */
    private $fields = [];
    /**
     * 查询参数
     *
     * @var string
     */
    private $params = '';
    /**
     * 查询类型 1-按nick查询 2-按seller_id查询 3-按num_iid查询
     *
     * @var int
     */
    private $type = 0;

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.rebate.auth.get');
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setParams(string $params)
    {
        if (\strlen($params) > 0) {
            $this->reqData['params'] = $params;
        } else {
            throw new TBKException('查询参数不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setType(int $type)
    {
        if (\in_array($type, [1, 2, 3])) {
            $this->reqData['type'] = $type;
        } else {
            throw new TBKException('查询类型不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['fields'])) {
            throw new TBKException('返回字段列表不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['params'])) {
            throw new TBKException('查询参数不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['type'])) {
            throw new TBKException('查询类型不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
