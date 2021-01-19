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
use SyConstant\ProjectBase;
use SyException\Live\TencentException;
use SyLive\BaseTencent;

/**
 * 更新水印
 *
 * @package SyLive\Tencent\Watermark
 */
class WatermarkUpdate extends BaseTencent
{
    /**
     * 水印ID
     *
     * @var int
     */
    private $WatermarkId = 0;
    /**
     * 水印图片URL
     *
     * @var string
     */
    private $PictureUrl = '';
    /**
     * X轴偏移
     *
     * @var int
     */
    private $XPosition = 0;
    /**
     * Y轴偏移
     *
     * @var int
     */
    private $YPosition = 0;
    /**
     * 水印名称
     *
     * @var string
     */
    private $WatermarkName = '';
    /**
     * 水印宽度
     *
     * @var int
     */
    private $Width = 0;
    /**
     * 水印高度
     *
     * @var int
     */
    private $Height = 0;

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'UpdateLiveWatermark';
        $this->reqData['XPosition'] = 0;
        $this->reqData['YPosition'] = 0;
    }

    private function __clone()
    {
    }

    /**
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

    /**
     * @throws \SyException\Live\TencentException
     */
    public function setPictureUrl(string $pictureUrl)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $pictureUrl) > 0) {
            $this->reqData['PictureUrl'] = $pictureUrl;
        } else {
            throw new TencentException('水印图片URL不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Live\TencentException
     */
    public function setXPosition(int $xPosition)
    {
        if (($xPosition >= 0) && ($xPosition <= 100)) {
            $this->reqData['XPosition'] = $xPosition;
        } else {
            throw new TencentException('X轴偏移不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Live\TencentException
     */
    public function setYPosition(int $yPosition)
    {
        if (($yPosition >= 0) && ($yPosition <= 100)) {
            $this->reqData['YPosition'] = $yPosition;
        } else {
            throw new TencentException('y轴偏移不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Live\TencentException
     */
    public function setWatermarkName(string $watermarkName)
    {
        $length = \strlen($watermarkName);
        if (($length > 0) && ($length <= 16)) {
            $this->reqData['WatermarkName'] = $watermarkName;
        } else {
            throw new TencentException('水印名称不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Live\TencentException
     */
    public function setWidth(int $width)
    {
        if (($width >= 0) && ($width <= 100)) {
            $this->reqData['Width'] = $width;
        } else {
            throw new TencentException('水印宽度不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Live\TencentException
     */
    public function setHeight(int $height)
    {
        if (($height >= 0) && ($height <= 100)) {
            $this->reqData['Height'] = $height;
        } else {
            throw new TencentException('水印高度不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['WatermarkId'])) {
            throw new TencentException('水印ID不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
        if (!isset($this->reqData['PictureUrl'])) {
            throw new TencentException('水印图片URL不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }

        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
