<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/13 0013
 * Time: 10:23
 */
namespace SyPay\Union\Channels\Wap;

use SyConstant\ErrorCode;
use SyPay\Union\Channels\BaseWap;

/**
 * Class Test
 *
 * @package SyPay\Union\Channels\Wap
 */
class Test extends BaseWap
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
