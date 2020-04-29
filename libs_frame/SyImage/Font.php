<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 17-11-8
 * Time: 下午11:19
 */
namespace SyImage;

use SyConstant\ErrorCode;
use SyException\Image\ImageException;

class Font
{
    /**
     * 字体三原色-黄色值
     * @var int
     */
    private $colorRed = 0;
    /**
     * 字体三原色-绿色值
     * @var int
     */
    private $colorGreen = 0;
    /**
     * 字体三原色-蓝色值
     * @var int
     */
    private $colorBlue = 0;
    /**
     * 透明度
     * @var int
     */
    private $colorAlpha = 0;
    /**
     * 字体大小
     * @var int
     */
    private $size = 0;
    /**
     * 字体文件路径
     * @var string
     */
    private $file = '';

    public function __construct()
    {
        $this->size = 18;
        $this->file = SY_ROOT . '/static/fonts/stsong.ttf';
    }

    private function __clone()
    {
    }

    /**
     * @return int
     */
    public function getColorRed() : int
    {
        return $this->colorRed;
    }

    /**
     * @param int $colorRed
     * @throws \SyException\Image\ImageException
     */
    public function setColorRed(int $colorRed)
    {
        if (($colorRed < 0) || ($colorRed > 255)) {
            throw new ImageException('字体颜色设置不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        $this->colorRed = $colorRed;
    }

    /**
     * @return int
     */
    public function getColorGreen() : int
    {
        return $this->colorGreen;
    }

    /**
     * @param int $colorGreen
     * @throws \SyException\Image\ImageException
     */
    public function setColorGreen(int $colorGreen)
    {
        if (($colorGreen < 0) || ($colorGreen > 255)) {
            throw new ImageException('字体颜色设置不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        $this->colorGreen = $colorGreen;
    }

    /**
     * @return int
     */
    public function getColorBlue() : int
    {
        return $this->colorBlue;
    }

    /**
     * @param int $colorBlue
     * @throws \SyException\Image\ImageException
     */
    public function setColorBlue(int $colorBlue)
    {
        if (($colorBlue < 0) || ($colorBlue > 255)) {
            throw new ImageException('字体颜色设置不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        $this->colorBlue = $colorBlue;
    }

    /**
     * @return int
     */
    public function getColorAlpha() : int
    {
        return $this->colorAlpha;
    }

    /**
     * @return string
     */
    public function getRGB() : string
    {
        return 'rgb(' . $this->colorRed . ',' . $this->colorGreen . ',' . $this->colorBlue . ')';
    }

    /**
     * @return string
     */
    public function getRGBA() : string
    {
        return 'rgba(' . $this->colorRed . ',' . $this->colorGreen . ',' . $this->colorBlue . ',' . number_format(($this->colorAlpha / 100), 2, '.', '') . ')';
    }

    /**
     * @param int $colorAlpha
     * @throws \SyException\Image\ImageException
     */
    public function setColorAlpha(int $colorAlpha)
    {
        if (($colorAlpha < 0) || ($colorAlpha > 100)) {
            throw new ImageException('字体透明度设置不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        $this->colorAlpha = $colorAlpha;
    }

    /**
     * @return int
     */
    public function getSize() : int
    {
        return $this->size;
    }

    /**
     * @param int $size
     * @throws \SyException\Image\ImageException
     */
    public function setSize(int $size)
    {
        if (($size < 0) || ($size > 200)) {
            throw new ImageException('字体大小设置不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        $this->size = $size;
    }

    /**
     * @return string
     */
    public function getFile() : string
    {
        return $this->file;
    }

    /**
     * @param string $file
     * @throws \SyException\Image\ImageException
     */
    public function setFile(string $file)
    {
        if (!is_file($file)) {
            throw new ImageException('字体文件不存在', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        } elseif (!is_readable($file)) {
            throw new ImageException('字体文件不可读', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        $this->file = $file;
    }
}
