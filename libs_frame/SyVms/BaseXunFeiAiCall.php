<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/21 0021
 * Time: 16:06
 */
namespace SyVms;

use SyTool\Tool;

/**
 * Class BaseXunFeiAiCall
 *
 * @package SyVms
 */
abstract class BaseXunFeiAiCall extends BaseXunFei
{
    public function __construct()
    {
        parent::__construct();
        $this->reqMethod = 'POST';
    }

    protected function getContent() : array
    {
        parent::getContent();
        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);

        return $this->curlConfigs;
    }
}
