<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/3 0003
 * Time: 23:10
 */
namespace SyLive\Tencent\Record;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Live\TencentException;
use SyLive\BaseTencent;

/**
 * 获取录制模板列表
 *
 * @package SyLive\Tencent\Record
 */
class TemplatesDescribe extends BaseTencent
{
    /**
     * 直播类型
     *
     * @var int
     */
    private $IsDelayLive = 0;

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'DescribeLiveRecordTemplates';
        $this->reqData['IsDelayLive'] = 0;
    }

    private function __clone()
    {
    }

    /**
     * @param int $isDelayLive
     *
     * @throws \SyException\Live\TencentException
     */
    public function setIsDelayLive(int $isDelayLive)
    {
        if (in_array($isDelayLive, [0, 1])) {
            $this->reqData['IsDelayLive'] = $isDelayLive;
        } else {
            throw new TencentException('直播类型不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
