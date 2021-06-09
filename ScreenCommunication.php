<?php
/**
 * Class ScreenCommunication
 */
class ScreenCommunication
{
    const VERSION_100 = 100;
    const VERSION_200 = 200;

    private static $crcHigh = [
        0x00,
        0xC1,
        0x81,
        0x40,
        0x01,
        0xC0,
        0x80,
        0x41,
        0x01,
        0xC0,
        0x80,
        0x41,
        0x00,
        0xC1,
        0x81,
        0x40,
        0x01,
        0xC0,
        0x80,
        0x41,
        0x00,
        0xC1,
        0x81,
        0x40,
        0x00,
        0xC1,
        0x81,
        0x40,
        0x01,
        0xC0,
        0x80,
        0x41,
        0x01,
        0xC0,
        0x80,
        0x41,
        0x00,
        0xC1,
        0x81,
        0x40,
        0x00,
        0xC1,
        0x81,
        0x40,
        0x01,
        0xC0,
        0x80,
        0x41,
        0x00,
        0xC1,
        0x81,
        0x40,
        0x01,
        0xC0,
        0x80,
        0x41,
        0x01,
        0xC0,
        0x80,
        0x41,
        0x00,
        0xC1,
        0x81,
        0x40,
        0x01,
        0xC0,
        0x80,
        0x41,
        0x00,
        0xC1,
        0x81,
        0x40,
        0x00,
        0xC1,
        0x81,
        0x40,
        0x01,
        0xC0,
        0x80,
        0x41,
        0x00,
        0xC1,
        0x81,
        0x40,
        0x01,
        0xC0,
        0x80,
        0x41,
        0x01,
        0xC0,
        0x80,
        0x41,
        0x00,
        0xC1,
        0x81,
        0x40,
        0x00,
        0xC1,
        0x81,
        0x40,
        0x01,
        0xC0,
        0x80,
        0x41,
        0x01,
        0xC0,
        0x80,
        0x41,
        0x00,
        0xC1,
        0x81,
        0x40,
        0x01,
        0xC0,
        0x80,
        0x41,
        0x00,
        0xC1,
        0x81,
        0x40,
        0x00,
        0xC1,
        0x81,
        0x40,
        0x01,
        0xC0,
        0x80,
        0x41,
        0x01,
        0xC0,
        0x80,
        0x41,
        0x00,
        0xC1,
        0x81,
        0x40,
        0x00,
        0xC1,
        0x81,
        0x40,
        0x01,
        0xC0,
        0x80,
        0x41,
        0x00,
        0xC1,
        0x81,
        0x40,
        0x01,
        0xC0,
        0x80,
        0x41,
        0x01,
        0xC0,
        0x80,
        0x41,
        0x00,
        0xC1,
        0x81,
        0x40,
        0x00,
        0xC1,
        0x81,
        0x40,
        0x01,
        0xC0,
        0x80,
        0x41,
        0x01,
        0xC0,
        0x80,
        0x41,
        0x00,
        0xC1,
        0x81,
        0x40,
        0x01,
        0xC0,
        0x80,
        0x41,
        0x00,
        0xC1,
        0x81,
        0x40,
        0x00,
        0xC1,
        0x81,
        0x40,
        0x01,
        0xC0,
        0x80,
        0x41,
        0x00,
        0xC1,
        0x81,
        0x40,
        0x01,
        0xC0,
        0x80,
        0x41,
        0x01,
        0xC0,
        0x80,
        0x41,
        0x00,
        0xC1,
        0x81,
        0x40,
        0x01,
        0xC0,
        0x80,
        0x41,
        0x00,
        0xC1,
        0x81,
        0x40,
        0x00,
        0xC1,
        0x81,
        0x40,
        0x01,
        0xC0,
        0x80,
        0x41,
        0x01,
        0xC0,
        0x80,
        0x41,
        0x00,
        0xC1,
        0x81,
        0x40,
        0x00,
        0xC1,
        0x81,
        0x40,
        0x01,
        0xC0,
        0x80,
        0x41,
        0x00,
        0xC1,
        0x81,
        0x40,
        0x01,
        0xC0,
        0x80,
        0x41,
        0x01,
        0xC0,
        0x80,
        0x41,
        0x00,
        0xC1,
        0x81,
        0x40,
    ];
    private static $crcLow = [
        0x00,
        0xC0,
        0xC1,
        0x01,
        0xC3,
        0x03,
        0x02,
        0xC2,
        0xC6,
        0x06,
        0x07,
        0xC7,
        0x05,
        0xC5,
        0xC4,
        0x04,
        0xCC,
        0x0C,
        0x0D,
        0xCD,
        0x0F,
        0xCF,
        0xCE,
        0x0E,
        0x0A,
        0xCA,
        0xCB,
        0x0B,
        0xC9,
        0x09,
        0x08,
        0xC8,
        0xD8,
        0x18,
        0x19,
        0xD9,
        0x1B,
        0xDB,
        0xDA,
        0x1A,
        0x1E,
        0xDE,
        0xDF,
        0x1F,
        0xDD,
        0x1D,
        0x1C,
        0xDC,
        0x14,
        0xD4,
        0xD5,
        0x15,
        0xD7,
        0x17,
        0x16,
        0xD6,
        0xD2,
        0x12,
        0x13,
        0xD3,
        0x11,
        0xD1,
        0xD0,
        0x10,
        0xF0,
        0x30,
        0x31,
        0xF1,
        0x33,
        0xF3,
        0xF2,
        0x32,
        0x36,
        0xF6,
        0xF7,
        0x37,
        0xF5,
        0x35,
        0x34,
        0xF4,
        0x3C,
        0xFC,
        0xFD,
        0x3D,
        0xFF,
        0x3F,
        0x3E,
        0xFE,
        0xFA,
        0x3A,
        0x3B,
        0xFB,
        0x39,
        0xF9,
        0xF8,
        0x38,
        0x28,
        0xE8,
        0xE9,
        0x29,
        0xEB,
        0x2B,
        0x2A,
        0xEA,
        0xEE,
        0x2E,
        0x2F,
        0xEF,
        0x2D,
        0xED,
        0xEC,
        0x2C,
        0xE4,
        0x24,
        0x25,
        0xE5,
        0x27,
        0xE7,
        0xE6,
        0x26,
        0x22,
        0xE2,
        0xE3,
        0x23,
        0xE1,
        0x21,
        0x20,
        0xE0,
        0xA0,
        0x60,
        0x61,
        0xA1,
        0x63,
        0xA3,
        0xA2,
        0x62,
        0x66,
        0xA6,
        0xA7,
        0x67,
        0xA5,
        0x65,
        0x64,
        0xA4,
        0x6C,
        0xAC,
        0xAD,
        0x6D,
        0xAF,
        0x6F,
        0x6E,
        0xAE,
        0xAA,
        0x6A,
        0x6B,
        0xAB,
        0x69,
        0xA9,
        0xA8,
        0x68,
        0x78,
        0xB8,
        0xB9,
        0x79,
        0xBB,
        0x7B,
        0x7A,
        0xBA,
        0xBE,
        0x7E,
        0x7F,
        0xBF,
        0x7D,
        0xBD,
        0xBC,
        0x7C,
        0xB4,
        0x74,
        0x75,
        0xB5,
        0x77,
        0xB7,
        0xB6,
        0x76,
        0x72,
        0xB2,
        0xB3,
        0x73,
        0xB1,
        0x71,
        0x70,
        0xB0,
        0x50,
        0x90,
        0x91,
        0x51,
        0x93,
        0x53,
        0x52,
        0x92,
        0x96,
        0x56,
        0x57,
        0x97,
        0x55,
        0x95,
        0x94,
        0x54,
        0x9C,
        0x5C,
        0x5D,
        0x9D,
        0x5F,
        0x9F,
        0x9E,
        0x5E,
        0x5A,
        0x9A,
        0x9B,
        0x5B,
        0x99,
        0x59,
        0x58,
        0x98,
        0x88,
        0x48,
        0x49,
        0x89,
        0x4B,
        0x8B,
        0x8A,
        0x4A,
        0x4E,
        0x8E,
        0x8F,
        0x4F,
        0x8D,
        0x4D,
        0x4C,
        0x8C,
        0x44,
        0x84,
        0x85,
        0x45,
        0x87,
        0x47,
        0x46,
        0x86,
        0x82,
        0x42,
        0x43,
        0x83,
        0x41,
        0x81,
        0x80,
        0x40,
    ];
    private static $receiveMap = [
        '62' => 'receive_62',
    ];

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * 接收处理请求数据
     *
     * @param string $data 请求数据,二进制格式
     * @retrun array 响应数据
     *
     * @throws \Exception
     */
    public static function receive(string $data)
    {
        $vrOrigin = substr($data, 1, 1);
        $vr = (int)hexdec(bin2hex($vrOrigin));
        $totalLength = strlen($data);
        if (self::VERSION_100 == $vr) {
            if ($totalLength < 8) {
                throw new Exception('100版本请求数据过短', 1);
            }
        } elseif (self::VERSION_200 == $vr) {
            if ($totalLength < 9) {
                throw new Exception('200版本请求数据过短', 2);
            }
        } else {
            throw new Exception('请求数据版本不支持', 3);
        }

        $nowCrc = bin2hex(self::createCrc16(substr($data, 0, ($totalLength - 2))));
        $existCrc = bin2hex(substr($data, -2));
        if ($nowCrc !== $existCrc) {
            throw new Exception('请求数据crc校验失败', 4);
        }

        $cmdOrigin = substr($data, 4, 1);
        $cmd = bin2hex($cmdOrigin);
        $funcName = self::$receiveMap[$cmd] ?? '';
        if (0 == strlen($funcName)) {
            throw new Exception('请求数据cmd格式不支持', 5);
        }

        $receiveData = [
            'da' => substr($data, 0, 1),
            'vr' => $vr,
            'vr_origin' => $vrOrigin,
            'pn' => substr($data, 2, 2),
            'cmd' => $cmd,
            'cmd_origin' => $cmdOrigin,
        ];
        if (self::VERSION_100 == $vr) {
            $dlOrigin = substr($data, 5, 1);
            $dl = (int)hexdec(bin2hex($dlOrigin));
            $receiveData['dl'] = $dl;
            $receiveData['dl_origin'] = $dlOrigin;
            $receiveData['data'] = substr($data, 6, $dl);
        } else {
            $dlOrigin = substr($data, 5, 2);
            $dl = (int)hexdec(bin2hex($dlOrigin));
            $receiveData['dl'] = $dl;
            $receiveData['dl_origin'] = $dlOrigin;
            $receiveData['data'] = substr($data, 7, $dl);
        }

        return self::$funcName($receiveData);
    }

    /**
     * 生成crc16校验码
     *
     * @param string $str 待签名数据
     *
     * @return string
     */
    private static function createCrc16(string $str)
    {
        $strLength = strlen($str);
        $uchCRCHi = 0xFF;
        $uchCRCLo = 0xFF;
        for ($i = 0; $i < $strLength; ++$i ) {
            $uIndex = $uchCRCLo ^ ord(substr($str, $i, 1));
            $uchCRCLo = $uchCRCHi ^ self::$crcHigh[$uIndex];
            $uchCRCHi = self::$crcLow[$uIndex];
        }

        return chr($uchCRCLo) . chr($uchCRCHi);
    }

    /**
     * 0x62指令处理
     *
     * @return array
     *
     * @throws \Exception
     */
    private static function receive_62(array $receiveData)
    {
        if (strlen($receiveData['data']) < 19) {
            throw new Exception('0x62请求的数据字段不合法', 6);
        }

        $unpackRes1 = unpack('vk1', substr($receiveData['data'], 17, 2));
        if (!isset($unpackRes1['k1'])) {
            throw new Exception('0x62请求的文本长度获取失败', 7);
        }
        $txtLength = (int)$unpackRes1['k1'];

        $resData = [
            'extend' => [
                'twid' => (int)hexdec(bin2hex(substr($receiveData['data'], 0, 1))),
                'etm' => bin2hex(substr($receiveData['data'], 1, 1)),
                'ets' => (int)hexdec(bin2hex(substr($receiveData['data'], 2, 1))),
                'dm' => (int)hexdec(bin2hex(substr($receiveData['data'], 3, 1))),
                'dt' => (int)hexdec(bin2hex(substr($receiveData['data'], 4, 1))),
                'exm' => bin2hex(substr($receiveData['data'], 5, 1)),
                'exs' => (int)hexdec(bin2hex(substr($receiveData['data'], 6, 1))),
                'findex' => bin2hex(substr($receiveData['data'], 7, 1)),
                'drs' => (int)hexdec(bin2hex(substr($receiveData['data'], 8, 1))),
                'tc_r' => (int)hexdec(bin2hex(substr($receiveData['data'], 9, 1))),
                'tc_g' => (int)hexdec(bin2hex(substr($receiveData['data'], 10, 1))),
                'tc_b' => (int)hexdec(bin2hex(substr($receiveData['data'], 11, 1))),
                'tc_a' => (int)hexdec(bin2hex(substr($receiveData['data'], 12, 1))),
                'bc_r' => (int)hexdec(bin2hex(substr($receiveData['data'], 13, 1))),
                'bc_g' => (int)hexdec(bin2hex(substr($receiveData['data'], 14, 1))),
                'bc_b' => (int)hexdec(bin2hex(substr($receiveData['data'], 15, 1))),
                'bc_a' => (int)hexdec(bin2hex(substr($receiveData['data'], 16, 1))),
                'tl' => $txtLength,
                'text' => substr($receiveData['data'], 19, $txtLength),
            ],
        ];
        $resData['data'] = $receiveData['da'] . $receiveData['vr_origin'] . $receiveData['pn'] . $receiveData['cmd_origin'];
        $resData['data'] .= hex2bin('01');
        $resData['data'] .= hex2bin('00');
        $crc = self::createCrc16($resData['data']);
        $resData['data'] .= $crc;
        $resData['data_hex'] = bin2hex($resData['data']);

        return $resData;
    }
}

$str = '0064FFFF6225001501000215010300FF000000000000001200BBB6D3ADB9E2C1D9C7EBC8EBB3A1CDA3B3B5F4F5';
$res = ScreenCommunication::receive(hex2bin($str));
print_r($res);
