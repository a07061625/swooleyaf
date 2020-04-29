<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/5/8 0008
 * Time: 10:10
 */
namespace SyImage;

use SyConstant\ErrorCode;
use SyConstant\SyInner;
use SyException\Image\ImageException;
use Grafika\Grafika;

/**
 * 图片滤镜处理类
 * Class Filter
 * @package SyImage
 */
class Filter
{
    /**
     * 来源文件全路径
     * @var string
     */
    private $srcFile = '';
    /**
     * 目的文件全路径
     * @var string
     */
    private $dstFile = '';
    /**
     * @var \Grafika\EditorInterface|null
     */
    private $editor = null;
    /**
     * @var \Grafika\ImageInterface|null
     */
    private $image = null;

    /**
     * @param string $srcFile 来源全路径文件名
     * @throws \SyException\Image\ImageException
     */
    public function __construct(string $srcFile)
    {
        $imageInfo = getimagesize($srcFile);
        if ($imageInfo === false) {
            throw new ImageException('解析图片失败', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        } elseif (!in_array($imageInfo[2], [1, 2, 3], true)) {
            throw new ImageException('图片类型不支持', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        $this->editor = Grafika::createEditor();
        $this->editor->open($this->image, $srcFile);
        $this->srcFile = $srcFile;
        $this->dstFile = $srcFile;
    }

    public function __destruct()
    {
        if (!is_null($this->image)) {
            unset($this->image);
        }
        if (!is_null($this->editor)) {
            unset($this->editor);
        }
    }

    private function __clone()
    {
    }

    /**
     * @return string
     */
    public function getSrcFile() : string
    {
        return $this->srcFile;
    }

    /**
     * @return string
     */
    public function getDstFile() : string
    {
        return $this->dstFile;
    }

    /**
     * @param string $dstFile
     * @throws \SyException\Image\ImageException
     */
    public function setDstFile(string $dstFile)
    {
        $trueFile = preg_replace([
            '/\s+/',
            '/\\+/',
            '/\/{2,}/',
        ], [
            '',
            '/',
            '/',
        ], $dstFile);
        if (strlen($trueFile) > 0) {
            $this->dstFile = $trueFile;
        } else {
            throw new ImageException('目标文件不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }
    }

    /**
     * 图片模糊
     * @param int $blur 模糊度,0到100,数值越大越模糊
     * @return $this
     * @throws \SyException\Image\ImageException
     */
    public function handleBlur(int $blur)
    {
        if (($blur >= 0) && ($blur <= 100)) {
            $filter = Grafika::createFilter('Blur', $blur);
            $this->editor->apply($this->image, $filter);
        } else {
            throw new ImageException('模糊度不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        return $this;
    }

    /**
     * 图片亮度调整
     * @param int $brightness 亮度,-100到100,<0变暗 >0变亮
     * @return $this
     * @throws \SyException\Image\ImageException
     */
    public function handleBrightness(int $brightness)
    {
        if (($brightness >= -100) && ($brightness <= 100)) {
            $filter = Grafika::createFilter('Brightness', $brightness);
            $this->editor->apply($this->image, $filter);
        } else {
            throw new ImageException('亮度不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        return $this;
    }

    /**
     * 改变图片颜色
     * @param int $red 红色色值,-100到100,<0色值减少 >0色值增加
     * @param int $green 绿色色值,-100到100,<0色值减少 >0色值增加
     * @param int $blue 蓝色色值,-100到100,<0色值减少 >0色值增加
     * @return $this
     * @throws \SyException\Image\ImageException
     */
    public function handleColorize(int $red, int $green, int $blue)
    {
        if (($red < -100) || ($red > 100)) {
            throw new ImageException('红色色值不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }
        if (($green < -100) || ($green > 100)) {
            throw new ImageException('绿色色值不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }
        if (($blue < -100) || ($blue > 100)) {
            throw new ImageException('蓝色色值不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        $filter = Grafika::createFilter('Colorize', $red, $green, $blue);
        $this->editor->apply($this->image, $filter);

        return $this;
    }

    /**
     * 改变图片对比度
     * @param int $contrast 对比度,-100到100,<0对比度减少 >0对比度增加
     * @return $this
     * @throws \SyException\Image\ImageException
     */
    public function handleContrast(int $contrast)
    {
        if (($contrast >= -100) && ($contrast <= 100)) {
            $filter = Grafika::createFilter('Contrast', $contrast);
            $this->editor->apply($this->image, $filter);
        } else {
            throw new ImageException('对比度不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        return $this;
    }

    /**
     * 图像噪点
     * @param string $ditherType 噪点类型,diffusion:扩散 ordered:规整
     * @return $this
     * @throws \SyException\Image\ImageException
     */
    public function handleDither(string $ditherType)
    {
        if (in_array($ditherType, SyInner::$totalImageFilterDither, true)) {
            $filter = Grafika::createFilter('Dither', $ditherType);
            $this->editor->apply($this->image, $filter);
        } else {
            throw new ImageException('噪点类型不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        return $this;
    }

    /**
     * 图像色阶调整,使图像看起来颜色更加正确
     * @param float $gamma 色阶
     * @return $this
     * @throws \SyException\Image\ImageException
     */
    public function handleGamma($gamma)
    {
        if (is_numeric($gamma) && ($gamma >= 1.0)) {
            $filter = Grafika::createFilter('Gamma', (float)$gamma);
            $this->editor->apply($this->image, $filter);
        } else {
            throw new ImageException('色阶不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        return $this;
    }

    /**
     * 图片灰度,只保留黑白两种颜色
     * @return $this
     */
    public function handleGrayscale()
    {
        $filter = Grafika::createFilter('Grayscale');
        $this->editor->apply($this->image, $filter);

        return $this;
    }

    /**
     * 图像反色处理
     * @return $this
     */
    public function handleInvert()
    {
        $filter = Grafika::createFilter('Invert');
        $this->editor->apply($this->image, $filter);

        return $this;
    }

    /**
     * 图片像素化、栅格化
     * @param int $pixel 像素
     * @return $this
     * @throws \SyException\Image\ImageException
     */
    public function handlePixelate(int $pixel)
    {
        if ($pixel >= 1) {
            $filter = Grafika::createFilter('Pixelate', $pixel);
            $this->editor->apply($this->image, $filter);
        } else {
            throw new ImageException('像素不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        return $this;
    }

    /**
     * 图片锐化,补偿图像的轮廓,增强图像的边缘及灰度跳变的部分,使图像变得清晰
     * @param int $sharpen 锐化值,1到100
     * @return $this
     * @throws \SyException\Image\ImageException
     */
    public function handleSharpen(int $sharpen)
    {
        if (($sharpen >= 1) && ($sharpen <= 100)) {
            $filter = Grafika::createFilter('Sharpen', $sharpen);
            $this->editor->apply($this->image, $filter);
        } else {
            throw new ImageException('锐化值不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        return $this;
    }

    /**
     * 图像查找边缘,检测出图像的边缘
     * @return $this
     */
    public function handleSobel()
    {
        $filter = Grafika::createFilter('Sobel');
        $this->editor->apply($this->image, $filter);

        return $this;
    }

    /**
     * 保存文件
     */
    public function save()
    {
        $this->editor->save($this->image, $this->dstFile);
    }
}
