<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/8/12 0012
 * Time: 16:46
 */
namespace Tool;

use Traits\SimpleTrait;

final class MqttTool
{
    use SimpleTrait;

    /**
     * 获取消息长度
     * @param string $data
     * @return int
     */
    public static function getMsgLength(string $data)
    {
        $index = 1;
        $multiplier = 1;
        $length = 0;

        do {
            $digit = ord($data{$index});
            $length += ($digit & 127) * $multiplier;
            $multiplier *= 128;
            $index++;
        } while (($digit & 128) != 0);

        return $length;
    }
}
