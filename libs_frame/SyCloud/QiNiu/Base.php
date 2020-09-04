<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/2 0002
 * Time: 10:39
 */
namespace SyCloud\QiNiu;

/**
 * Class Base
 *
 * @package SyCloud\QiNiu
 */
abstract class Base extends \SyCloud\Base
{
    /**
     * 请求头
     *
     * @var array
     */
    protected $reqHeader = [];

    public function __construct()
    {
        parent::__construct();
    }
}
