<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/7/5 0005
 * Time: 15:19
 */
namespace SyMessageHandler\Producers;

/**
 * Class BaseSms
 * @package SyMessageHandler\Producers
 */
abstract class BaseSms extends Base
{
    public function __construct(int $handlerType)
    {
        parent::__construct($handlerType);
    }

    protected function checkReceivers(array $data) : string
    {
        $receivers = $data['receivers'] ?? [];
        if (!is_array($receivers)) {
            return '接收人不合法';
        } elseif (empty($receivers)) {
            return '接收人不能为空';
        }

        $this->msgData['receivers'] = $receivers;
        return '';
    }
}
