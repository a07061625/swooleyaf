<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 10:30
 */
namespace SyPay\Union\Channels\Mobile;

use SyPay\Union\Channels\BaseMobile;

/**
 * 文件传输接口
 * 对账文件下载
 *
 * @package SyPay\Union\Channels\Mobile
 */
class FileTransfer extends BaseMobile
{
    public function __construct(string $merId, string $envType)
    {
        $this->reqDomains = [
            self::ENV_TYPE_PRODUCT => 'https://filedownload.95516.com',
            self::ENV_TYPE_DEV => 'https://filedownload.test.95516.com',
        ];
        parent::__construct($merId, $envType);
    }

    public function __clone()
    {
    }

    public function getDetail() : array
    {
        // TODO: Implement getDetail() method.
    }
}
