<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/12 0012
 * Time: 13:42
 */
namespace SyPay;

/**
 * Class BaseUnion
 *
 * @package SyPay
 */
abstract class BaseUnion extends Base
{
    /**
     * BaseUnion constructor.
     *
     * @param string $envType
     *
     * @throws \SyException\Pay\PayException
     */
    public function __construct(string $envType)
    {
        parent::__construct($envType);
        $this->reqHeaders = [
            'Content-Type' => 'application/x-www-form-urlencoded;charset=UTF-8',
        ];
    }

    protected function getContent()
    {
        $this->curlConfigs[CURLOPT_RETURNTRANSFER] = true;
        $this->curlConfigs[CURLOPT_HEADER] = false;
        $this->curlConfigs[CURLOPT_SSL_VERIFYPEER] = false;
        $this->curlConfigs[CURLOPT_SSL_VERIFYHOST] = false;
        if (!isset($this->curlConfigs[CURLOPT_TIMEOUT_MS])) {
            $this->curlConfigs[CURLOPT_TIMEOUT_MS] = 3000;
        }
    }
}
