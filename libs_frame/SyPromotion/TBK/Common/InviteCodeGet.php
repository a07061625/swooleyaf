<?php
/**
 * 生成私域用户邀请码
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:38
 */

namespace SyPromotion\TBK\Common;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;

/**
 * Class InviteCodeGet
 *
 * @package SyPromotion\TBK\Common
 */
class InviteCodeGet extends BaseTBK
{
    /**
     * 渠道关系ID
     *
     * @var int
     */
    private $relation_id = 0;
    /**
     * 物料类型
     *
     * @var string
     */
    private $relation_app = '';
    /**
     * 邀请码类型
     *
     * @var int
     */
    private $code_type = 0;

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.sc.invitecode.get');
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setRelationId(int $relationId)
    {
        if ($relationId > 0) {
            $this->reqData['relation_id'] = $relationId;
        } else {
            throw new TBKException('渠道关系ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setRelationApp(string $relationApp)
    {
        if (\strlen($relationApp) > 0) {
            $this->reqData['relation_app'] = $relationApp;
        } else {
            throw new TBKException('备案场景不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setCodeType(int $codeType)
    {
        if (\in_array($codeType, [1, 2, 3])) {
            $this->reqData['code_type'] = $codeType;
        } else {
            throw new TBKException('邀请码类型不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['relation_app'])) {
            throw new TBKException('物料类型不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['code_type'])) {
            throw new TBKException('邀请码类型不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
