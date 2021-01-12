<?php
/**
 * 通过淘口令解析商品id,并提供对应的三方分成淘客转链接
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Promoter;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyPromotion\TBK\Traits\SetAdZoneIdTrait;
use SyPromotion\TBK\Traits\SetDxTrait;
use SyPromotion\TBK\Traits\SetSubPidTrait;

/**
 * Class TPwdShareConvert
 *
 * @package SyPromotion\TBK\Promoter
 */
class TPwdShareConvert extends BaseTBK
{
    use SetAdZoneIdTrait;
    use SetSubPidTrait;
    use SetDxTrait;

    /**
     * 淘口令
     *
     * @var string
     */
    private $password_content = '';
    /**
     * 广告位ID
     *
     * @var int
     */
    private $adzone_id = 0;
    /**
     * 三方pid
     *
     * @var string
     */
    private $sub_pid = '';
    /**
     * 计划链接
     *
     * @var string
     */
    private $dx = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.tpwd.share.convert');
        $this->reqData['dx'] = '1';
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setPasswordContent(string $passwordContent)
    {
        if (\strlen($passwordContent) > 0) {
            $this->reqData['password_content'] = $passwordContent;
        } else {
            throw new TBKException('淘口令不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['password_content'])) {
            throw new TBKException('淘口令不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['adzone_id'])) {
            throw new TBKException('广告位ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['sub_pid'])) {
            throw new TBKException('三方pid不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
