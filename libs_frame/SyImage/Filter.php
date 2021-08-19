<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/5/8 0008
 * Time: 10:10
 */

namespace SyImage;

use Grafika\Color;
use Grafika\Grafika;
use SyConstant\ErrorCode;
use SyConstant\SyInner;
use SyException\Image\ImageException;

/**
 * 图片滤镜处理类
 * Class Filter
 *
 * @package SyImage
 */
class Filter
{
    /**
     * 来源文件全路径
     *
     * @var string
     */
    private $srcFile = '';
    /**
     * 目的文件全路径
     *
     * @var string
     */
    private $dstFile = '';
    /**
     * @var null|\Grafika\EditorInterface
     */
    private $editor;
    /**
     * @var null|\Grafika\ImageInterface
     */
    private $image;
    /**
     * @var string
     */
    private $mimeType = '';

    /**
     * @param string $srcFile 来源全路径文件名
     *
     * @throws \SyException\Image\ImageException
     */
    public function __construct(string $srcFile)
    {
        $imageInfo = getimagesize($srcFile);
        if (false === $imageInfo) {
            throw new ImageException('解析图片失败', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }
        if (!\in_array($imageInfo[2], [1, 2, 3], true)) {
            throw new ImageException('图片类型不支持', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        if (1 == $imageInfo[2]) {
            $this->mimeType = SyInner::IMAGE_MIME_TYPE_GIF;
        } elseif (2 == $imageInfo[2]) {
            $this->mimeType = SyInner::IMAGE_MIME_TYPE_JPEG;
        } else {
            $this->mimeType = SyInner::IMAGE_MIME_TYPE_PNG;
        }

        $this->editor = Grafika::createEditor();
        $this->editor->open($this->image, $srcFile);
        $this->srcFile = $srcFile;
        $this->dstFile = $srcFile;
    }

    public function __destruct()
    {
        if (null !== $this->image) {
            $this->image = null;
        }
        if (null !== $this->editor) {
            $this->editor = null;
        }
    }

    private function __clone()
    {
    }

    public function getSrcFile(): string
    {
        return $this->srcFile;
    }

    public function getDstFile(): string
    {
        return $this->dstFile;
    }

    /**
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
        if (\strlen($trueFile) > 0) {
            $this->dstFile = $trueFile;
        } else {
            throw new ImageException('目标文件不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }
    }

    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    /**
     * 图片模糊
     *
     * @param int $blur 模糊度,0到100,数值越大越模糊
     *
     * @return $this
     *
     * @throws \SyException\Image\ImageException
     * @throws \Exception
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
     *
     * @param int $brightness 亮度,-100到100,<0变暗 >0变亮
     *
     * @return $this
     *
     * @throws \SyException\Image\ImageException
     * @throws \Exception
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
     *
     * @param int $red   红色色值,-100到100,<0色值减少 >0色值增加
     * @param int $green 绿色色值,-100到100,<0色值减少 >0色值增加
     * @param int $blue  蓝色色值,-100到100,<0色值减少 >0色值增加
     *
     * @return $this
     *
     * @throws \SyException\Image\ImageException
     * @throws \Exception
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
     *
     * @param int $contrast 对比度,-100到100,<0对比度减少 >0对比度增加
     *
     * @return $this
     *
     * @throws \SyException\Image\ImageException
     * @throws \Exception
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
     *
     * @param string $ditherType 噪点类型,diffusion:扩散 ordered:规整
     *
     * @return $this
     *
     * @throws \SyException\Image\ImageException
     * @throws \Exception
     */
    public function handleDither(string $ditherType)
    {
        if (\in_array($ditherType, SyInner::$totalImageFilterDither, true)) {
            $filter = Grafika::createFilter('Dither', $ditherType);
            $this->editor->apply($this->image, $filter);
        } else {
            throw new ImageException('噪点类型不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        return $this;
    }

    /**
     * 图像色阶调整,使图像看起来颜色更加正确
     *
     * @param float $gamma 色阶
     *
     * @return $this
     *
     * @throws \SyException\Image\ImageException
     * @throws \Exception
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
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function handleGrayscale()
    {
        $filter = Grafika::createFilter('Grayscale');
        $this->editor->apply($this->image, $filter);

        return $this;
    }

    /**
     * 图像反色处理
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function handleInvert()
    {
        $filter = Grafika::createFilter('Invert');
        $this->editor->apply($this->image, $filter);

        return $this;
    }

    /**
     * 图片像素化、栅格化
     *
     * @param int $pixel 像素
     *
     * @return $this
     *
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
     *
     * @param int $sharpen 锐化值,1到100
     *
     * @return $this
     *
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
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function handleSobel()
    {
        $filter = Grafika::createFilter('Sobel');
        $this->editor->apply($this->image, $filter);

        return $this;
    }

    /**
     * 等比例缩放,缩放后不填充背景
     *
     * @param int $width  宽度
     * @param int $height 高度
     *
     * @return $this
     *
     * @throws \SyException\Image\ImageException
     */
    public function handleResizeFit(int $width, int $height)
    {
        if (($width >= 10) && ($height >= 10)) {
            $this->editor->resizeFit($this->image, $width, $height);
        } else {
            throw new ImageException('宽度或高度不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        return $this;
    }

    /**
     * 固定尺寸缩放,可能导致图片变形
     *
     * @param int $width  宽度
     * @param int $height 高度
     *
     * @return $this
     *
     * @throws \SyException\Image\ImageException
     */
    public function handleResizeExact(int $width, int $height)
    {
        if (($width >= 10) && ($height >= 10)) {
            $this->editor->resizeExact($this->image, $width, $height);
        } else {
            throw new ImageException('宽度或高度不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        return $this;
    }

    /**
     * 居中剪裁,长边的大于指定值的部分居中剪裁掉,图片不会变形
     *
     * @param int $width  宽度
     * @param int $height 高度
     *
     * @return $this
     *
     * @throws \SyException\Image\ImageException
     */
    public function handleResizeFill(int $width, int $height)
    {
        if (($width >= 10) && ($height >= 10)) {
            $this->editor->resizeFill($this->image, $width, $height);
        } else {
            throw new ImageException('宽度或高度不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        return $this;
    }

    /**
     * 等宽缩放,等比缩放,高度不管
     *
     * @param int $width 宽度
     *
     * @return $this
     *
     * @throws \SyException\Image\ImageException
     */
    public function handleResizeExactWidth(int $width)
    {
        if ($width >= 10) {
            $this->editor->resizeExactWidth($this->image, $width);
        } else {
            throw new ImageException('宽度不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        return $this;
    }

    /**
     * 等高缩放,等比缩放,宽度不管
     *
     * @param int $height 高度
     *
     * @return $this
     *
     * @throws \SyException\Image\ImageException
     */
    public function handleResizeExactHeight(int $height)
    {
        if ($height >= 10) {
            $this->editor->resizeExactHeight($this->image, $height);
        } else {
            throw new ImageException('高度不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        return $this;
    }

    /**
     * 移除GIF动画效果
     *
     * @return $this
     */
    public function handleFlatten()
    {
        if (SyInner::IMAGE_MIME_TYPE_GIF == $this->mimeType) {
            $this->editor->flatten($this->image);
        }

        return $this;
    }

    /**
     * 图片合并
     *
     * @param string $blendImage 待合并图片
     * @param array  $configs    配置<pre>
     *                           mode_type: string 选填 模式类型,默认为normal,可选值: normal multiply overlay screen
     *                           position_type: string 选填 位置类型,默认为center,可选值: top-left top-center top-right center-left center center-right bottom-left bottom-center bottom-right smart
     *                           opacity: float 选填 透明度,默认为1.0,完全不透明,最小为0.0,最大为1.0
     *                           offset_x: int 选填 待合并图片到原图左边的距离,默认为0,最小为0
     *                           offset_y: int 选填 待合并图片到原图上边的距离,默认为0,最小为0</pre>
     *
     * @return $this
     *
     * @throws \SyException\Image\ImageException
     * @throws \Exception
     */
    public function handleBlend(string $blendImage, array $configs = [])
    {
        if (!is_file($blendImage)) {
            throw new ImageException('待合并图片不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        $modeType = $configs['mode_type'] ?? 'normal';
        if (!\in_array($modeType, [
            'normal',
            'multiply',
            'overlay',
            'screen',
        ])) {
            throw new ImageException('模式类型不支持', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        $opacity = $configs['opacity'] ?? 1.0;
        if (($opacity < 0) || ($opacity > 1)) {
            throw new ImageException('透明度不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        $positionType = $configs['position_type'] ?? 'center';
        if (!\in_array($positionType, [
            'top-left',
            'top-center',
            'top-right',
            'center-left',
            'center',
            'center-right',
            'bottom-left',
            'bottom-center',
            'bottom-right',
            'smart',
        ])) {
            throw new ImageException('位置类型不支持', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        $offsetX = $configs['offset_x'] ?? 0;
        if ($offsetX < 0) {
            throw new ImageException('左边距不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        $offsetY = $configs['offset_y'] ?? 0;
        if ($offsetY < 0) {
            throw new ImageException('上边距不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        $this->editor->open($image2, $blendImage);
        $this->editor->blend($this->image, $image2, $modeType, $opacity, $positionType, $offsetX, $offsetY);
        unset($image2);

        return $this;
    }

    /**
     * 图像旋转
     *
     * @param int    $angle 角度
     * @param string $color 背景色,16进制rgb
     *
     * @return $this
     *
     * @throws \SyException\Image\ImageException
     * @throws \Exception
     */
    public function handleRotate(int $angle, string $color = '')
    {
        if (($angle < 0) || ($angle > 359)) {
            throw new ImageException('角度不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }
        if ((\strlen($color) > 0) && !ctype_alnum($color)) {
            throw new ImageException('背景色不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        if (0 == \strlen($color)) {
            $this->editor->rotate($this->image, $angle);
        } else {
            $this->editor->rotate($this->image, $angle, new Color('#' . $color));
        }

        return $this;
    }

    /**
     * 水印文字
     *
     * @param string $text    文字内容
     * @param array  $configs 配置<pre>
     *                        size: int 选填 字体大小,默认为12,最小为1
     *                        offset_x: int 选填 文字内容到原图左边的距离,默认为0,最小为0
     *                        offset_y: int 选填 文字内容到原图上边的距离,默认为12,最小为0
     *                        color: string 选填 背景色,16进制rgb,默认为黑色
     *                        font: string 选填 字体路径,默认为Sans font
     *                        angle: int 选填 旋转角度,默认为0,取值范围为0-359</pre>
     *
     * @return $this
     *
     * @throws \SyException\Image\ImageException
     * @throws \Exception
     */
    public function handleText(string $text, array $configs = [])
    {
        if (0 == \strlen($text)) {
            throw new ImageException('文字内容不能为空', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        $size = $configs['size'] ?? 12;
        if ($size <= 0) {
            throw new ImageException('字体大小不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        $offsetX = $configs['offset_x'] ?? 0;
        if ($offsetX < 0) {
            throw new ImageException('左边距不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        $offsetY = $configs['offset_y'] ?? $size;
        if ($offsetY < 0) {
            throw new ImageException('上边距不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        $color = $configs['color'] ?? '000000';
        if ((6 != \strlen($color)) || !ctype_alnum($color)) {
            throw new ImageException('背景色不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        $font = $configs['font'] ?? '';
        if ((\strlen($font) > 0) && !is_file($font)) {
            throw new ImageException('字体路径不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        $angle = $configs['angle'] ?? 0;
        if (($angle < 0) || ($angle > 359)) {
            throw new ImageException('角度不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        $this->editor->text($this->image, $text, $size, $offsetX, $offsetY, new Color('#' . $color), $font, $angle);

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
