<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/11/21 0021
 * Time: 18:01
 */
namespace QiNiu;

abstract class QiNiuBaseKodo extends QiNiuBase
{
    /**
     * 服务uri
     * @var string
     */
    protected $serviceUri = '';

    public function __construct()
    {
        parent::__construct();
    }

    protected function getContent() : array
    {
        return $this->curlConfigs;
    }
}
