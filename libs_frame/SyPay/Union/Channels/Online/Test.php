<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/13 0013
 * Time: 10:21
 */
namespace SyPay\Union\Channels\Online;

use SyConstant\ErrorCode;
use SyPay\Union\Channels\BaseOnline;

/**
 * Class Test
 *
 * @package SyPay\Union\Channels\Online
 */
class Test extends BaseOnline
{
    public function __construct(string $merId, string $envType)
    {
        parent::__construct($merId, $envType);
    }

    public function __clone()
    {
    }

    public function getDetail() : array
    {
        $resArr = [
            'code' => ErrorCode::COMMON_SUCCESS,
        ];

        return $resArr;
    }
}
