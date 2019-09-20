<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 17-8-30
 * Time: 下午10:36
 */
namespace Images;

use SyConstant\ErrorCode;
use SyConstant\SyInner;
use SyException\Image\ImageException;
use Log\Log;
use Tool\Tool;

class SyImageImagick extends SyImageBase
{
    /**
     * @var \Imagick
     */
    private $image = null;

    private $resizeMap = [
        SyInner::IMAGE_MIME_TYPE_GIF => 'resizeImageGif',
        SyInner::IMAGE_MIME_TYPE_PNG => 'resizeImagePng',
        SyInner::IMAGE_MIME_TYPE_JPEG => 'resizeImageJpeg',
    ];

    /**
     * @param string $byteStr 图片二进制流字符串
     * @throws \SyException\Image\ImageException
     */
    public function __construct(string $byteStr)
    {
        parent::__construct($byteStr);
        $this->image = new \Imagick();
        $this->quality = 100;

        try {
            $this->image->readImageBlob($byteStr);
            $this->image->stripImage();
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getCode(), $e->getTraceAsString());
            throw new ImageException('读取图片失败', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }
    }

    /**
     * 析构函数
     */
    public function __destruct()
    {
        if (!is_null($this->image)) {
            $this->image->destroy();
        }
    }

    private function __clone()
    {
    }

    public function resizeImage(int $width, int $height)
    {
        $funcName = Tool::getArrayVal($this->resizeMap, $this->mimeType, null);
        if (!is_null($funcName)) {
            $this->$funcName($width, $height);
        }

        return $this;
    }

    public function setQuality(int $quality)
    {
        if (($quality <= 0) || ($quality > 100)) {
            throw new ImageException('图片质量取值范围为1-100', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        $nowQuality = (int)($this->image->getImageCompressionQuality() * $quality / 100);
        $this->quality = ($nowQuality == 0) ? 75 : $nowQuality;
        $this->image->setImageCompressionQuality($this->quality);

        return $this;
    }

    public function addWaterTxt(string $txt, int $startX, int $startY, SyFont $font)
    {
        $fontTxt = trim($txt);
        if (strlen($fontTxt) == 0) {
            throw new ImageException('文本内容不能为空', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        $opacity = (float)(1 - $font->getColorAlpha() / 100);
        $draw = new \ImagickDraw();
        $draw->setFont($font->getFile());
        $draw->setFontSize($font->getSize());
        $draw->setFillColor($font->getRGB());
        $draw->setFillOpacity($opacity);
        $draw->setStrokeColor('rgb(255,255,255)');
        $draw->setStrokeWidth(1);
        $draw->setStrokeOpacity(1);
        $draw->setTextKerning(1);
        $draw->setTextEncoding('UTF-8');
        $draw->setGravity(\Imagick::GRAVITY_CENTER);
        if ($this->mimeType == SyInner::IMAGE_MIME_TYPE_GIF) {
            foreach ($this->image as $frame) {
                $frame->annotateImage($draw, $startX, $startY, 0, $fontTxt);
            }
        } else {
            $this->image->annotateImage($draw, $startX, $startY, 0, $fontTxt);
        }

        return $this;
    }

    public function addWaterImage(string $filePath, int $startX, int $startY, int $alpha)
    {
        $imageInfo = $this->checkImage($filePath, 1);
        $trueAlpha = $this->checkImageAlpha($alpha);
        $opacity = (float)(1 - $trueAlpha / 100);

        $water = new \Imagick($filePath);
        $water->stripImage();
        $water->setImageOpacity($opacity);

        $draw = new \ImagickDraw();
        $draw->composite($water->getImageCompose(), $startX, $startY, $imageInfo[0], $imageInfo[1], $water);
        $water->destroy();
        
        if ($this->mimeType == SyInner::IMAGE_MIME_TYPE_GIF) {
            $canvas = new \Imagick();
            $images = $this->image->coalesceImages();
            foreach ($images as $frame) {
                $eImage = new \Imagick();
                $eImage->readImageBlob($frame);
                $eImage->drawImage($draw);
                $canvas->addImage($eImage);
                $canvas->setImageDelay($eImage->getImageDelay());
                $eImage->destroy();
            }
            $this->image->destroy();
            $this->image = $canvas;
        } else {
            $this->image->drawImage($draw);
        }

        return $this;
    }

    public function cropImage(int $startX, int $startY, int $width, int $height)
    {
        $checkRes = $this->checkCropData($startX, $startY, $width, $height);
        $this->image->cropImage($width, $height, $startX, $startY);
        $this->width = $checkRes['crop_width'];
        $this->height = $checkRes['crop_height'];

        return $this;
    }

    public function writeImage(string $path)
    {
        if (!is_dir($path)) {
            throw new ImageException('目录不存在', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        if ($this->mimeType == SyInner::IMAGE_MIME_TYPE_JPEG) {
            $this->image->setImageFormat('jpeg');
            $this->image->setImageCompression(\Imagick::COMPRESSION_JPEG);
        } elseif ($this->mimeType == SyInner::IMAGE_MIME_TYPE_PNG) {
            $this->image->setImageFormat('png');
            $this->image->setImageCompression(\Imagick::COMPRESSION_LZW);
        }

        $fileName = Tool::createNonceStr(6) . Tool::getNowTime() . '_' . $this->width . '_' . $this->height . '.' . $this->ext;
        $fullFileName = substr($path, -1) == '/' ? $path . $fileName : $path . '/' . $fileName;
        if ($this->mimeType == SyInner::IMAGE_MIME_TYPE_GIF) {
            $writeRes = $this->image->writeImages($fullFileName, true);
        } else {
            $writeRes = $this->image->writeImage($fullFileName);
        }
        if (!$writeRes) {
            throw new ImageException('写图片失败', ErrorCode::IMAGE_UPLOAD_FAIL);
        }

        return $fileName;
    }

    private function resizeImageGif(int $width, int $height)
    {
        if (($this->width > $width) || ($this->height > $height)) {
            $resizeWidth = $width;
            $resizeHeight = $height;
        } else {
            $resizeWidth = $this->width;
            $resizeHeight = $this->height;
        }

        $gifImages = $this->image->coalesceImages();
        foreach ($gifImages as $eImage) {
            $eImage->thumbnailImage($resizeWidth, $resizeHeight, true);
        }

        $gifImages->deconstructImages();
        $gifImages->optimizeImageLayers();
        $this->image = $gifImages;
        $this->width = $gifImages->getImageWidth();
        $this->height = $gifImages->getImageHeight();
        $gifImages->destroy();
    }

    private function resizeImagePng(int $width, int $height)
    {
        if (($this->width > $width) || ($this->height > $height)) {
            $this->image->resizeImage($width, $height, \Imagick::FILTER_CATROM, 1, true);
        } else {
            $this->image->cropThumbnailImage($this->width, $this->height);
        }

        $this->width = $this->image->getImageWidth();
        $this->height = $this->image->getImageHeight();
    }

    private function resizeImageJpeg(int $width, int $height)
    {
        if (($this->width > $width) || ($this->height > $height)) {
            $this->image->resizeImage($width, $height, \Imagick::FILTER_CATROM, 1, true);
        } else {
            $this->image->cropThumbnailImage($this->width, $this->height);
        }

        $this->width = $this->image->getImageWidth();
        $this->height = $this->image->getImageHeight();
    }
}
