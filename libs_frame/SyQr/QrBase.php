<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/5/1 0001
 * Time: 10:26
 */
namespace SyQr;

use Grafika\Color;
use Grafika\Grafika;
use SyTool\Tool;

include_once 'phpqrcode/phpqrcode.php';

/**
 * Class QrBase
 * @package SyQr
 */
class QrBase
{
    /**
     * 临时文件路径
     * @var string
     */
    private $tmpPath = '';
    /**
     * 文件名
     * @var string
     */
    private $fileName = '';
    /**
     * @var \Grafika\EditorInterface
     */
    private $editor = null;

    /**
     * QrBase constructor.
     * @param string $url 链接地址
     * @param string $tmpPath 临时文件路径
     * @param array $options 配置数组
     *   error_level: int 选填 容错级别,可选级别为:0,1,2,3,默认为0
     *   image_size: int 选填 图片大小,可选大小:1-10,默认为5
     *   margin_size: int 选填 外边框间隙大小,默认为2
     */
    public function __construct(string $url, string $tmpPath, array $options)
    {
        $this->refreshFileName();
        $truePath = str_replace('\\', '/', $tmpPath);
        if (substr($truePath, - 1) == '/') {
            $this->tmpPath = $truePath;
        } else {
            $this->tmpPath = $truePath . '/';
        }

        $errorLevel = $options['error_level'] ?? QR_ECLEVEL_L;
        $imageSize = $options['image_size'] ?? 5;
        $marginSize = $options['margin_size'] ?? 2;
        \QRcode::png($url, $this->tmpPath . $this->fileName, $errorLevel, $imageSize, $marginSize);
        $this->editor = Grafika::createEditor();
    }

    private function __clone()
    {
    }

    public function __destruct()
    {
        if (!is_null($this->editor)) {
            unset($this->editor);
        }
        $this->deleteLocalFile();
    }

    /**
     * 删除本地文件
     */
    private function deleteLocalFile() {
        if (strlen($this->fileName) > 0) {
            $fullName = $this->tmpPath . $this->fileName;
            if (file_exists($fullName)) {
                unlink($fullName);
            }
        }
    }

    /**
     * 刷新文件名
     */
    private function refreshFileName()
    {
        $this->deleteLocalFile();
        $this->fileName = Tool::createNonceStr(8, 'numlower') . Tool::getNowTime() . '.png';
    }

    /**
     * 添加背景图
     * @param string $backgroundFile 背景图片地址
     * @param array $options 配置数组
     *   type: string 选填 类型,默认为normal
     *   opacity: float 选填 不透明度,默认为1
     *   position: string 选填 位置,选填,默认为top-left
     *   offsetX: int 必填 横坐标偏移值
     *   offsetY: int 必填 纵坐标偏移值
     * @return $this
     */
    public function addBackgroundImage(string $backgroundFile, array $options)
    {
        $type = $options['type'] ?? 'normal';
        $opacity = $options['opacity'] ?? 1;
        $position = $options['position'] ?? 'top-left';
        $this->editor->open($imageBackground, $backgroundFile);
        $this->editor->open($imageQr, $this->tmpPath . $this->fileName);
        $this->editor->blend($imageBackground, $imageQr, $type, $opacity, $position, $options['offsetX'], $options['offsetY']);
        $this->refreshFileName();
        $this->editor->save($imageBackground, $this->tmpPath . $this->fileName);
        unset($imageBackground, $imageQr);

        return $this;
    }

    /**
     * 添加图片水印
     * @param string $logoFile LOGO图片地址
     * @param array $options 配置数组
     *   type: string 选填 类型,默认为normal
     *   opacity: float 选填 不透明度,默认为1
     *   position: string 选填 位置,选填,默认为top-left
     *   offsetX: int 必填 横坐标偏移值
     *   offsetY: int 必填 纵坐标偏移值
     * @return $this
     */
    public function addWaterImage(string $logoFile, array $options)
    {
        $type = $options['type'] ?? 'normal';
        $opacity = $options['opacity'] ?? 1;
        $position = $options['position'] ?? 'top-left';
        $this->editor->open($imageQr, $this->tmpPath . $this->fileName);
        $this->editor->open($imageLogo, $logoFile);
        $this->editor->blend($imageQr, $imageLogo, $type, $opacity, $position, $options['offsetX'], $options['offsetY']);
        $this->refreshFileName();
        $this->editor->save($imageQr, $this->tmpPath . $this->fileName);
        unset($imageQr, $imageLogo);

        return $this;
    }

    /**
     * 添加文本水印
     * @param string $text 文本内容
     * @param array $options 配置数组
     *   size: int 选填 字体大小,默认为12
     *   startX: int 选填 文本起始横坐标,默认为0
     *   startY: int 选填 文本起始纵坐标,默认为12
     *   color: string 选填 字体颜色,默认为空字符串
     *   alpha: float 选填 字体透明度,默认为1.0
     *   font: string 选填 字体文件,默认为空字符串
     *   angle: float 选填 倾斜角度,默认为0
     * @return $this
     */
    public function addWaterText(string $text, array $options = [])
    {
        $size = $options['size'] ?? 12;
        $startX = $options['startX'] ?? 0;
        $startY = $options['startY'] ?? 12;
        $color = $options['color'] ?? '';
        $alpha = $options['alpha'] ?? 1.0;
        $font = $options['font'] ?? '';
        $angle = $options['angle'] ?? 0;
        if (strlen($color) > 0) {
            $colorObj = new Color($color, $alpha);
        } else {
            $colorObj = null;
        }
        $this->editor->open($imageQr, $this->tmpPath . $this->fileName);
        $this->editor->text($imageQr, $text, $size, $startX, $startY, $colorObj, $font, $angle);
        $this->refreshFileName();
        $this->editor->save($imageQr, $this->tmpPath . $this->fileName);
        unset($imageQr);

        return $this;
    }

    /**
     * 获取二维码图片内容(base64格式)
     * @return string
     */
    public function getContent() : string
    {
        $imageContent = file_get_contents($this->tmpPath . $this->fileName);
        return 'data:image/png;base64,' . base64_encode($imageContent);
    }
}
