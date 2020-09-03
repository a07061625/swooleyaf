<?php
/**
 * 获取/重置partner_key
 * User: 姜伟
 * Date: 2020/3/28 0028
 * Time: 11:10
 */
namespace SyLive\BaiJia\Partner;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyLive\BaseBaiJia;
use SyConstant\ErrorCode;
use SyException\Live\BaiJiaException;

/**
 * Class KeyCreate
 * @package SyLive\BaiJia\Partner
 */
class KeyCreate extends BaseBaiJia
{
    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/partner/createkey';
        $this->reqData['secret_key'] = LiveConfigSingleton::getInstance()->getBaiJiaConfig($partnerId)->getSecretKey();
        $this->reqData['regenerate'] = 1;
    }

    private function __clone()
    {
    }

    /**
     * @param int $regenerate
     * @throws \SyException\Live\BaiJiaException
     */
    public function setRegenerate(int $regenerate)
    {
        if (($regenerate == 0) || ($regenerate == 1)) {
            $this->reqData['regenerate'] = $regenerate;
        } else {
            throw new BaiJiaException('强制更新标识不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        return $this->getContent();
    }
}
