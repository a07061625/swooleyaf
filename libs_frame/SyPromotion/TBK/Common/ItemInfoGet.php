<?php
/**
 * 查询商品详情
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:38
 */

namespace SyPromotion\TBK\Common;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyPromotion\TBK\Traits\SetNumIidsTrait;
use SyPromotion\TBK\Traits\SetPlatformTrait;

/**
 * Class ItemInfoGet
 *
 * @package SyPromotion\TBK\Common
 */
class ItemInfoGet extends BaseTBK
{
    use SetNumIidsTrait;
    use SetPlatformTrait;

    /**
     * 商品ID列表
     *
     * @var array
     */
    private $num_iids = [];
    /**
     * 链接形式 1:PC 2:无线 默认１
     *
     * @var int
     */
    private $platform = 0;
    /**
     * ip地址
     *
     * @var string
     */
    private $ip = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.item.info.get');
        $this->reqData['platform'] = 1;
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setIp(string $ip)
    {
        if (preg_match(ProjectBase::REGEX_IP, '.' . $ip) > 0) {
            $this->reqData['ip'] = $ip;
        } else {
            throw new TBKException('ip地址不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['num_iids'])) {
            throw new TBKException('商品ID列表不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
