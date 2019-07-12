<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/7/12 0012
 * Time: 8:43
 */
namespace SySms;

use Constant\ErrorCode;
use TaoBao\ServiceBase;
use TaoBao\UtilBase;
use Traits\SimpleTrait;

class SmsUtilDaYu extends UtilBase
{
    use SimpleTrait;

    /**
     * 发送服务请求
     * @param \TaoBao\ServiceBase $service
     * @return array
     */
    public static function sendServiceRequest(ServiceBase $service)
    {
        return parent::sendRequest($service, ErrorCode::SMS_POST_ERROR);
    }
}
