<?php
/**
 * 解析轻店铺淘口令
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Promoter;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyPromotion\TBK\Traits\SetAdZoneIdTrait;

/**
 * Class LightShopTPwdParse
 *
 * @package SyPromotion\TBK\Promoter
 */
class LightShopTPwdParse extends BaseTBK
{
    use SetAdZoneIdTrait;

    /**
     * 轻店铺淘口令
     *
     * @var string
     */
    private $tao_password = '';
    /**
     * 广告位ID
     *
     * @var int
     */
    private $adzone_id = 0;
    /**
     * 达人pid
     *
     * @var string
     */
    private $main_pid = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.lightshop.tbpswd.parse');
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setTaoPassword(string $taoPassword)
    {
        if (\strlen($taoPassword) > 0) {
            $this->reqData['tao_password'] = $taoPassword;
        } else {
            throw new TBKException('轻店铺淘口令不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setMainPid(string $mainPid)
    {
        if (preg_match(ProjectBase::REGEX_PROMOTION_TBK_PID, $mainPid) > 0) {
            $this->reqData['main_pid'] = $mainPid;
        } else {
            throw new TBKException('达人pid不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['tao_password'])) {
            throw new TBKException('轻店铺淘口令不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['adzone_id'])) {
            throw new TBKException('广告位ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['main_pid'])) {
            throw new TBKException('达人pid不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
