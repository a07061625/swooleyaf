<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/8/12 0012
 * Time: 16:46
 */
namespace SyTool;

use SyTrait\SimpleTrait;

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

    /**
     * 解码字符串长度
     * @param string $data
     * @return int
     */
    public static function decodeStrLength(string $data)
    {
        return 256 * ord($data[0]) + ord($data[1]);
    }

    /**
     * 解码字符串
     * @param string $data
     * @return string
     */
    public static function decodeStr(string $data)
    {
        $length = self::decodeStrLength($data);
        return substr($data, 2, $length);
    }

    /**
     * 获取连接信息
     * @param string $data
     * @return array
     */
    public static function getConnectInfo(string $data)
    {
        $connectInfo = [
            'protocolName' => self::decodeStr($data),
        ];
        $offset = strlen($connectInfo['protocolName']) + 2;
        $connectInfo['version'] = ord(substr($data, $offset, 1));
        $offset += 1;
        $byte = ord($data[$offset]);
        $connectInfo['willRetain'] = ($byte & 0x20 == 0x20);
        $connectInfo['willQos'] = ($byte & 0x18 >> 3);
        $connectInfo['willFlag'] = ($byte & 0x04 == 0x04);
        $connectInfo['cleanStart'] = ($byte & 0x02 == 0x02);
        $offset += 1;
        $connectInfo['keepAlive'] = self::decodeStrLength(substr($data, $offset, 2));
        $offset += 2;
        $connectInfo['clientId'] = self::decodeStr(substr($data, $offset));
        return $connectInfo;
    }

    /**
     * 获取推送数据
     * @param array $data
     * @return string
     */
    public static function getPublishStr(array $data)
    {
        $needStr = chr(0x30);
        $length = strlen($data['topic']) + strlen($data['content']) + 2;
        do {
            $digit = $length % 128;
            $length = $length >> 7;
            if ($length > 0) {
                $digit = ($digit | 0x80);
            }
            $needStr .= chr($digit);
        } while ($length > 0);
        $needStr .= chr(0) . chr(0x06) . $data['topic'] . $data['content'];
        return $needStr;
    }
}
