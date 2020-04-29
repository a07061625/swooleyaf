<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 17-8-30
 * Time: 下午10:36
 */
namespace SyImage;

use SyConstant\ErrorCode;
use SyConstant\SyInner;
use SyException\Image\ImageException;
use SyTool\Tool;

class ImageGd extends ImageBase
{
    /**
     * @var resource
     */
    private $image = null;

    /**
     * @param string $data 图片数据
     * @param string $dataType 数据类型 binary:二进制 base64:base64编码
     */
    public function __construct(string $data, string $dataType)
    {
        $byteData = $this->getByteData($data, $dataType);
        parent::__construct($byteData);

        $this->image = imagecreatefromstring($byteData);
        if ($this->mimeType == SyInner::IMAGE_MIME_TYPE_PNG) {
            $this->quality = 6;
        } else {
            $this->quality = 80;
        }
    }

    /**
     * 析构函数
     */
    public function __destruct()
    {
        if (!is_null($this->image)) {
            imagedestroy($this->image);
            $this->image = null;
        }
    }

    private function __clone()
    {
    }

    public function resizeImage(int $width, int $height)
    {
        if (($this->width > $width) || ($this->height > $height)) {
            $widthPro = $width / $this->width;
            $heightPro = $height / $this->height;
            if ($widthPro > $heightPro) {
                $resizeWidth = (int)($this->width * $heightPro);
                $resizeHeight = (int)($this->height * $heightPro);
            } else {
                $resizeWidth = (int)($this->width * $widthPro);
                $resizeHeight = (int)($this->height * $widthPro);
            }
            if ($resizeWidth <= 0) {
                $resizeWidth = 1;
            }
            if ($resizeHeight <= 0) {
                $resizeHeight = 1;
            }
        } else {
            $resizeWidth = $this->width;
            $resizeHeight = $this->height;
        }

        $thumbImage = imagecreatetruecolor($resizeWidth, $resizeHeight);
        imagecopyresampled($thumbImage, $this->image, 0, 0, 0, 0, $resizeWidth, $resizeHeight, $this->width, $this->height);
        imagedestroy($this->image);
        $this->image = $thumbImage;
        $this->width = $resizeWidth;
        $this->height = $resizeHeight;

        return $this;
    }

    public function setQuality(int $quality)
    {
        if (($quality <= 0) || ($quality > 100)) {
            throw new ImageException('图片质量取值范围为1-100', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        if ($this->mimeType == SyInner::IMAGE_MIME_TYPE_PNG) {
            if ($quality < 10) {
                $this->quality = 1;
            } elseif ($quality < 100) {
                $this->quality = (int)floor($quality / 10);
            } else {
                $this->quality = 9;
            }
        } else {
            $this->quality = $quality;
        }

        return $this;
    }

    public function addWaterTxt(string $txt, int $startX, int $startY, Font $font)
    {
        $fontTxt = trim($txt);
        if (strlen($fontTxt) == 0) {
            throw new ImageException('文本内容不能为空', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        $color = imagecolorallocatealpha($this->image, $font->getColorRed(), $font->getColorGreen(), $font->getColorBlue(), $font->getColorAlpha());
        imagettftext($this->image, $font->getSize(), 0, $startX, $startY, $color, $font->getFile(), $fontTxt);

        return $this;
    }

    public function addWaterImage(string $filePath, int $startX, int $startY, int $alpha)
    {
        $imageInfo = $this->checkImage($filePath, 1);
        $trueAlpha = $this->checkImageAlpha($alpha);
        $water = imagecreatefromstring(file_get_contents($filePath));
        imagecopymerge($this->image, $water, $startX, $startY, 0, 0, $imageInfo[0], $imageInfo[1], $trueAlpha);
        imagedestroy($water);

        return $this;
    }

    public function cropImage(int $startX, int $startY, int $width, int $height)
    {
        $checkRes = $this->checkCropData($startX, $startY, $width, $height);
        $newImage = imagecreatetruecolor($checkRes['crop_width'], $checkRes['crop_height']);
        imagecopyresampled($newImage, $this->image, 0, 0, $startX, $startY, $checkRes['crop_width'], $checkRes['crop_height'], $width, $height);
        imagedestroy($this->image);
        $this->image = $newImage;
        $this->width = $checkRes['crop_width'];
        $this->height = $checkRes['crop_height'];

        return $this;
    }

    public function writeImage(string $path)
    {
        if (!is_dir($path)) {
            throw new ImageException('目录不存在', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        $fileName = Tool::createNonceStr(6) . Tool::getNowTime() . '_' . $this->width . '_' . $this->height . '.' . $this->ext;
        $fullFileName = substr($path, -1) == '/' ? $path . $fileName : $path . '/' . $fileName;
        if ($this->mimeType == SyInner::IMAGE_MIME_TYPE_GIF) {
            $writeRes = imagegif($this->image, $fullFileName);
        } elseif ($this->mimeType == SyInner::IMAGE_MIME_TYPE_PNG) {
            $writeRes = imagepng($this->image, $fullFileName, $this->quality);
        } else {
            $writeRes = imagejpeg($this->image, $fullFileName, $this->quality);
        }
        if (!$writeRes) {
            throw new ImageException('写图片失败', ErrorCode::IMAGE_UPLOAD_FAIL);
        }

        return $fileName;
    }
}
