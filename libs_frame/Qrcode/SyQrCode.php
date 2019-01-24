<?php
/**
 * 二维码生成类
 * User: 姜伟
 * Date: 2017/1/3 0003
 * Time: 12:47
 */
namespace Qrcode;
include_once 'phpqrcode/phpqrcode.php';

class SyQrCode {
    const QR_ERROR_LEVEL_ONE = 'L';
    const QR_ERROR_LEVEL_TWO = 'M';
    const QR_ERROR_LEVEL_THREE = 'Q';
    const QR_ERROR_LEVEL_FOUR = 'H';

    private static $errorLevels = [
        self::QR_ERROR_LEVEL_ONE,
        self::QR_ERROR_LEVEL_TWO,
        self::QR_ERROR_LEVEL_THREE,
        self::QR_ERROR_LEVEL_FOUR,
    ];

    /**
     * 生成二维码图片
     * @param string $url 链接地址
     * @param array $options 配置参数
     *   error_level: string 容错级别,可选级别为:L,M,Q,H
     *   image_size: int 图片大小,可选大小:1-10
     *   margin_size: int 外边框间隙大小
     */
    public static function createImage(string $url,array $options) {
        if(isset($options['error_level']) && (in_array($options['error_level'], self::$errorLevels))){
            $errorLevel = $options['error_level'];
        } else {
            $errorLevel = self::QR_ERROR_LEVEL_ONE;
        }
        if(isset($options['image_size']) && is_numeric($options['image_size']) && ($options['image_size'] >= 1) && ($options['image_size'] <= 10)){
            $imageSize = (int)$options['image_size'];
        } else {
            $imageSize = 5;
        }
        if(isset($options['margin_size']) && is_numeric($options['margin_size']) && ($options['margin_size'] >= 0) && ($options['margin_size'] <= 200)){
            $marginSize = (int)$options['margin_size'];
        } else {
            $marginSize = 2;
        }

        \QRcode::png($url, false, $errorLevel, $imageSize, $marginSize);
    }
}