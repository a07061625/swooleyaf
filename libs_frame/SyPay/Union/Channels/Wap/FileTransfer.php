<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 10:30
 */
namespace SyPay\Union\Channels\Wap;

use SyPay\Union\Channels\BaseWap;

/**
 * 文件传输接口
 * 对账文件下载
 *
 * @package SyPay\Union\Channels\Wap
 */
class FileTransfer extends BaseWap
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
