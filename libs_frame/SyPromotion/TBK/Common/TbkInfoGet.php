<?php
/**
 * pid校验
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
 * Class TbkInfoGet
 *
 * @package SyPromotion\TBK\Common
 */
class TbkInfoGet extends BaseTBK
{
    /**
     * pid
     *
     * @var string
     */
    private $pid = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.tbkinfo.get');
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setPid(string $pid)
    {
        if (preg_match(ProjectBase::REGEX_PROMOTION_TBK_PID, $pid) > 0) {
            $this->reqData['pid'] = $pid;
        } else {
            throw new TBKException('pid不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['pid'])) {
            throw new TBKException('pid不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
