<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/13 0013
 * Time: 10:14
 */
namespace SyPay;

/**
 * Class BaseUnionChannels
 * @package SyPay
 */
abstract class BaseUnionChannels extends BaseUnion
{
    public function __construct(string $merId, string $envType)
    {
        if (empty($this->reqDomains)) {
            $this->reqDomains = [
                self::ENV_TYPE_PRODUCT => 'https://gateway.95516.com',
                self::ENV_TYPE_DEV => 'https://gateway.test.95516.com',
            ];
        }
        parent::__construct($envType);
        $this->reqData['version'] = '5.1.0';
        $this->reqData['encoding'] = 'UTF-8';
        $this->reqData['txnTime'] = date('YmdHis');
        $this->reqData['merId'] = $merId;
        $this->reqData['signMethod'] = '01';
    }
}
