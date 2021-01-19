<?php
/**
 * 红人店物料集合
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Promoter;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;

/**
 * Class KolMaterialListQuery
 *
 * @package SyPromotion\TBK\Promoter
 */
class KolMaterialListQuery extends BaseTBK
{
    /**
     * 预留参数
     *
     * @var string
     */
    private $extend_info = '';
    /**
     * 达人pid
     *
     * @var string
     */
    private $pid = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.kol.material.querylist');
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setExtendInfo(string $extendInfo)
    {
        if (\strlen($extendInfo) > 0) {
            $this->reqData['extend_info'] = $extendInfo;
        } else {
            throw new TBKException('预留参数不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setPid(string $pid)
    {
        if (preg_match(ProjectBase::REGEX_PROMOTION_TBK_PID, $pid) > 0) {
            $this->reqData['pid'] = $pid;
        } else {
            throw new TBKException('达人pid不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        return $this->getContent();
    }
}
