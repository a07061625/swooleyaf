<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2022/5/23
 * Time: 16:45
 */

namespace SyDingTalk;

/**
 * Class BaseRequest
 *
 * @package SyDingTalk
 */
abstract class BaseRequest
{
    protected $apiParas = [];

    public function __construct()
    {
        //do nothing
    }

    private function __clone()
    {
        //do nothing
    }

    abstract public function getApiMethodName(): string;

    public function getApiParas(): array
    {
        return $this->apiParas;
    }

    public function check()
    {
        //nothing
    }
}
