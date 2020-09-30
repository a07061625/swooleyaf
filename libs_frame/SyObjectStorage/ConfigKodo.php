<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/4 0004
 * Time: 13:39
 */
namespace SyObjectStorage;

use SyCloud\QiNiu\ConfigTrait;
use SyTrait\SimpleConfigTrait;

/**
 * Class ConfigKodo
 *
 * @package SyObjectStorage
 */
class ConfigKodo
{
    use ConfigTrait;
    use SimpleConfigTrait;

    public function __construct()
    {
    }

    private function __clone()
    {
    }
}
