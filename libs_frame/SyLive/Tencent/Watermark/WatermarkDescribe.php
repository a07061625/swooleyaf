<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/4 0004
 * Time: 8:34
 */
namespace SyLive\Tencent\Watermark;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Live\TencentException;
use SyLive\BaseTencent;

/**
 * 获取单个水印
 *
 * @package SyLive\Tencent\Watermark
 */
class WatermarkDescribe extends BaseTencent
{
    /**
     * 水印ID
     *
     * @var int
     */
    private $WatermarkId = 0;

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'DescribeLiveWatermark';
    }

    private function __clone()
    {
    }

    /**
     * @param int $watermarkId
     *
     * @throws \SyException\Live\TencentException
     */
    public function setWatermarkId(int $watermarkId)
    {
        if ($watermarkId > 0) {
            $this->reqData['WatermarkId'] = $watermarkId;
        } else {
            throw new TencentException('水印ID不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['WatermarkId'])) {
            throw new TencentException('水印ID不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }

        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
