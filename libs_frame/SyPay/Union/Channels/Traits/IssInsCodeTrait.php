<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 11:08
 */
namespace SyPay\Union\Channels\Traits;

/**
 * Trait IssInsCodeTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait IssInsCodeTrait
{
    /**
     * @param string $issInsCode 发卡机构代码
     */
    public function setIssInsCode(string $issInsCode)
    {
        if (strlen($issInsCode) > 0) {
            $this->reqData['issInsCode'] = $issInsCode;
        }
    }
}
