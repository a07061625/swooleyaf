<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/13 0013
 * Time: 10:12
 */
namespace SyPay;

/**
 * Class BaseUnionQuickPass
 *
 * @package SyPay
 */
abstract class BaseUnionQuickPass extends BaseUnion
{
    public function __construct(string $appId, string $envType)
    {
        parent::__construct($envType);
        $this->reqData['appId'] = $appId;
    }
}
