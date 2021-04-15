<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/14 0014
 * Time: 20:38
 */

namespace SyDouYin;

/**
 * Class BaseVideo
 *
 * @package SyDouYin
 */
abstract class BaseVideo extends Base
{
    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
    }
}
