<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/13 0013
 * Time: 10:26
 */
namespace SyPay\Union\QuickPass\Unconscious;

use SyConstant\ErrorCode;
use SyPay\BaseUnionQuickPass;

/**
 * Class Test
 *
 * @package SyPay\Union\QuickPass
 */
class Test extends BaseUnionQuickPass
{
    public function __construct(string $appId, string $envType)
    {
        parent::__construct($appId, $envType);
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
