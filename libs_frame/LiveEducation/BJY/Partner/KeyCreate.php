<?php
/**
 * 获取/重置partner_key
 * User: 姜伟
 * Date: 2020/3/28 0028
 * Time: 11:10
 */
namespace LiveEducation\BJY\Partner;

use DesignPatterns\Singletons\LiveEducationConfigSingleton;
use LiveEducation\BaseBJY;
use SyConstant\ErrorCode;
use SyException\LiveEducation\BJYException;

/**
 * Class KeyCreate
 * @package LiveEducation\BJY\Partner
 */
class KeyCreate extends BaseBJY
{
    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/partner/createkey';
        $this->reqData['secret_key'] = LiveEducationConfigSingleton::getInstance()->getBJYConfig($partnerId)->getSecretKey();
        $this->reqData['regenerate'] = 1;
    }

    private function __clone()
    {
    }

    /**
     * @param int $regenerate
     * @throws \SyException\LiveEducation\BJYException
     */
    public function SetRegenerate(int $regenerate)
    {
        if (($regenerate == 0) || ($regenerate == 1)) {
            $this->reqData['regenerate'] = $regenerate;
        } else {
            throw new BJYException('强制更新标识不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        return $this->getContent();
    }
}
