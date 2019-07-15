<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 17-9-2
 * Time: 下午9:38
 */
namespace SyException\Etcd;

use SyException\BaseException;

class EtcdException extends BaseException
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->tipName = 'Etcd配置异常';
    }
}
