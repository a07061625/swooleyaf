<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/14 0014
 * Time: 20:37
 */

namespace SyDouYin;

/**
 * Class BaseEnterprise
 *
 * @package SyDouYin
 */
abstract class BaseEnterprise extends Base
{
    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
    }
}
