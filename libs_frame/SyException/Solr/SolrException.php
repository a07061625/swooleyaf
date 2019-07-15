<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/6/19 0019
 * Time: 8:51
 */
namespace SyException\Solr;

use SyException\BaseException;

class SolrException extends BaseException
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->tipName = 'Solr异常';
    }
}
