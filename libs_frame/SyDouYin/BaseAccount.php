<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/14 0014
 * Time: 20:36
 */

namespace SyDouYin;

/**
 * Class BaseAccount
 *
 * @package SyDouYin
 */
abstract class BaseAccount extends Base
{
    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
    }
}
