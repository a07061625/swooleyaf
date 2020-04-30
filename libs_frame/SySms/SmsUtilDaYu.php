<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/7/12 0012
 * Time: 8:43
 */
namespace SySms;

use SyConstant\ErrorCode;
use SyTaoBao\ServiceBase;
use SyTaoBao\UtilBase;
use SyTrait\SimpleTrait;

class SmsUtilDaYu extends UtilBase
{
    use SimpleTrait;

    /**
     * 发送服务请求
     * @param \SyTaoBao\ServiceBase $service
     * @return array
     */
    public static function sendServiceRequest(ServiceBase $service)
    {
        return parent::sendRequest($service, ErrorCode::SMS_REQ_DAYU_ERROR);
    }
}
