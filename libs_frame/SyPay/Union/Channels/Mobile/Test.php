<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/13 0013
 * Time: 10:20
 */
namespace SyPay\Union\Channels\Mobile;

use SyConstant\ErrorCode;
use SyPay\Union\Channels\BaseMobile;

/**
 * Class Test
 * @package SyPay\Union\Channels\Mobile
 */
class Test extends BaseMobile
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
