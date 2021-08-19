<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 17-11-4
 * Time: 下午10:32
 */

namespace SyImage;

use SyConstant\ErrorCode;
use SyConstant\SyInner;
use SyException\Image\ImageException;

abstract class ImageBase
{
    /**
     * 图片sha1值
     *
     * @var string
     */
    protected $sha1 = '';
    /**
     * 图片类型
     *
     * @var string
     */
    protected $mimeType = '';
    /**
     * 图片类型
     *
     * @var string
     */
    protected $ext = '';
    /**
     * 图片的宽
     *
     * @var int
     */
    protected $width = 0;
    /**
     * 图片的高
     *
     * @var int
     */
    protected $height = 0;
    /**
     * 图片的大小,单位为字节
     *
     * @var int
     */
    protected $size = 0;
    /**
     * 图片质量,取值1-100,数值越大质量越好
     *
     * @var int
     */
    protected $quality = 0;

    /**
     * @param string $byteStr 图片二进制流字符串
     *
     * @throws \SyException\Image\ImageException
     */
    public function __construct(string $byteStr)
    {
        $imageInfo = getimagesize('data://application/octet-stream;base64,' . base64_encode($byteStr));
        if (false === $imageInfo) {
            throw new ImageException('解析图片失败', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }
        if (!\in_array($imageInfo[2], [1, 2, 3], true)) {
            throw new ImageException('图片类型不支持', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        $this->sha1 = sha1($byteStr);
        $this->size = \strlen($byteStr);
        $this->width = (int)$imageInfo[0];
        $this->height = (int)$imageInfo[1];
        if (1 == $imageInfo[2]) {
            $this->mimeType = SyInner::IMAGE_MIME_TYPE_GIF;
            $this->ext = 'gif';
        } elseif (2 == $imageInfo[2]) {
            $this->mimeType = SyInner::IMAGE_MIME_TYPE_JPEG;
            $this->ext = 'jpg';
        } else {
            $this->mimeType = SyInner::IMAGE_MIME_TYPE_PNG;
            $this->ext = 'png';
        }
    }

    /**
     * 获取图片sha1值
     */
    public function getSha1(): string
    {
        return $this->sha1;
    }

    /**
     * 获取图片mime类型
     */
    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    /**
     * 获取图片扩展名
     */
    public function getExt(): string
    {
        return $this->ext;
    }

    /**
     * 获取图片宽度
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * 获取图片高度
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * 获取图片原始大小
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * 获取图片质量
     */
    public function getQuality(): int
    {
        return $this->quality;
    }

    /**
     * 缩略图片
     *
     * @param int $width  缩略后的宽度
     * @param int $height 缩略后的高度
     *
     * @return $this
     */
    abstract public function resizeImage(int $width, int $height);

    /**
     * 设置图片质量
     *
     * @param int $quality 压缩质量,1-100,数字越大压缩质量越好
     *
     * @return $this
     *
     * @throws \SyException\Image\ImageException
     */
    abstract public function setQuality(int $quality);

    /**
     * 添加文本水印
     *
     * @param string        $txt    文本内容
     * @param int           $startX 文本起始横坐标
     * @param int           $startY 文本起始纵坐标
     * @param \SyImage\Font $font   字体信息对象
     *
     * @return $this
     *
     * @throws \SyException\Image\ImageException
     */
    abstract public function addWaterTxt(string $txt, int $startX, int $startY, Font $font);

    /**
     * 添加图片水印
     *
     * @param string $filePath 图片路径
     * @param int    $startX   起始横坐标
     * @param int    $startY   起始纵坐标
     * @param int    $alpha    透明度
     *
     * @return $this
     *
     * @throws \SyException\Image\ImageException
     */
    abstract public function addWaterImage(string $filePath, int $startX, int $startY, int $alpha);

    /**
     * 截取图片
     *
     * @param int $startX 起始横坐标
     * @param int $startY 起始纵坐标
     * @param int $width  宽度
     * @param int $height 高度
     *
     * @return $this
     *
     * @throws \SyException\Image\ImageException
     */
    abstract public function cropImage(int $startX, int $startY, int $width, int $height);

    /**
     * 写图片文件
     *
     * @param string $path       文件目录
     * @param string $namePrefix 文件名前缀
     *
     * @return string
     *
     * @throws \SyException\Image\ImageException
     */
    abstract public function writeImage(string $path, string $namePrefix = '');

    /**
     * 获取图片二进制数据
     *
     * @return string
     */
    protected function getByteData(string $data, string $dataType)
    {
        if (SyInner::IMAGE_DATA_TYPE_BINARY == $dataType) {
            return $data;
        }

        $byteData = base64_decode($data);

        return \is_string($byteData) ? $byteData : '';
    }

    /**
     * 检测图片
     *
     * @param string $filePath 图片路径
     * @param int    $type     图片类型 1:水印图片
     *
     * @return array|bool
     *
     * @throws \SyException\Image\ImageException
     */
    protected function checkImage(string $filePath, int $type)
    {
        $imageInfo = getimagesize($filePath);
        if (false === $imageInfo) {
            throw new ImageException('读取图片失败', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        $imageTypes = 1 == $type ? [2, 3] : [1, 2, 3];
        if (!\in_array($imageInfo[2], $imageTypes, true)) {
            throw new ImageException('图片类型不支持', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        return $imageInfo;
    }

    /**
     * 检测透明度
     *
     * @param int $alpha 透明度
     *
     * @return int
     */
    protected function checkImageAlpha(int $alpha)
    {
        if ($alpha < 0) {
            return 0;
        }
        if ($alpha > 100) {
            return 100;
        }

        return $alpha;
    }

    /**
     * 检测截图数据
     *
     * @param int $startX 起始横坐标
     * @param int $startY 起始纵坐标
     * @param int $width  截图宽度
     * @param int $height 截图高度
     *
     * @return array
     *
     * @throws \SyException\Image\ImageException
     */
    protected function checkCropData(int $startX, int $startY, int $width, int $height)
    {
        if (SyInner::IMAGE_MIME_TYPE_GIF == $this->mimeType) {
            throw new ImageException('gif图片不允许截图', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }
        if ($startX < 0) {
            throw new ImageException('起始横坐标不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }
        if ($startX >= $this->width) {
            throw new ImageException('起始横坐标必须小于图片宽度', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }
        if ($startY < 0) {
            throw new ImageException('起始纵坐标不合法', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }
        if ($startY >= $this->height) {
            throw new ImageException('起始纵坐标必须小于图片高度', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }
        if ($width <= 0) {
            throw new ImageException('截图宽度必须大于0', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }
        if ($height <= 0) {
            throw new ImageException('截图高度必须大于0', ErrorCode::IMAGE_UPLOAD_PARAM_ERROR);
        }

        $totalWidth = $startX + $width;
        $totalHeight = $startY + $height;

        return [
            'crop_width' => $totalWidth > $this->width ? ($totalWidth - $this->width) : $width,
            'crop_height' => $totalHeight > $this->height ? ($totalHeight - $this->height) : $height,
        ];
    }
}
