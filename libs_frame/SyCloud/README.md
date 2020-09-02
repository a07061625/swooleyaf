# 使用
## QiNiu(七牛云)
## Tencent(腾讯云)
    $obj = new \SyIot\Tencent\Device\DeviceDataControl();
    $obj->setDeviceName('xxx');
    //TODO: 设置其他必要的参数
    $result = \SyCloud\Tencent\Util::sendServiceRequest($obj, \SyConstant\ErrorCode::IOT_REQ_TENCENT_ERROR);
    var_dump($result);
