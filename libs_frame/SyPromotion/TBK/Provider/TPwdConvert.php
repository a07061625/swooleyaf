<?php
/**
 * 淘口令解析&转链
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Provider;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyPromotion\TBK\Traits\SetAdZoneIdTrait;
use SyPromotion\TBK\Traits\SetDxTrait;
use SyPromotion\TBK\Traits\SetSiteIdTrait;

/**
 * Class TPwdConvert
 *
 * @package SyPromotion\TBK\Provider
 */
class TPwdConvert extends BaseTBK
{
    use SetAdZoneIdTrait;
    use SetDxTrait;
    use SetSiteIdTrait;

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
     * 计划链接
     *
     * @var string
     */
    private $dx = '';
    /**
     * 网站ID
     *
     * @var int
     */
    private $site_id = 0;
    /**
     * 会员人群ID
     *
     * @var int
     */
    private $ucrowd_id = 0;

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.sc.tpwd.convert');
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

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setUCrowdId(int $uCrowdId)
    {
        if ($uCrowdId > 0) {
            $this->reqData['ucrowd_id'] = $uCrowdId;
        } else {
            throw new TBKException('会员人群ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
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
        if (!isset($this->reqData['site_id'])) {
            throw new TBKException('网站ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
