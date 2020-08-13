<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/12 0012
 * Time: 13:41
 */
namespace SyPay;

/**
 * Class BasePayPal
 *
 * @package SyPay
 */
abstract class BasePayPal extends Base
{
    public function __construct(string $clientId, string $envType)
    {
        $this->reqDomains = [
            self::ENV_TYPE_PRODUCT => 'https://api.paypal.com',
            self::ENV_TYPE_DEV => 'https://api.sandbox.paypal.com',
        ];
        parent::__construct($envType);
    }
}
