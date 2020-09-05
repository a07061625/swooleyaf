# 介绍
- AliYun: 阿里云
- BaiJia: 百家云
- Tencent: 腾讯云

# 使用
## AliYun
    $config = \DesignPatterns\Singletons\LiveConfigSingleton::getInstance()->getAliYunConfig();
    $iClientProfile = \AliOpen\Core\Profile\DefaultProfile::getProfile($config->getRegionId(), $config->getAccessKey(), $config->getAccessSecret());
    $client = new \AliOpen\Core\DefaultAcsClient($iClientProfile);
    $obj = new \SyLive\AliYun\LiveDomainAddRequest();
    $obj->setMethod('POST');
    $obj->setDomainName('aaa.com');
    //TODO: 参考类实现设置其他参数
    $response = $client->getAcsResponse($obj);
    print_r($response);

## BaiJia
    $obj = new \SyLive\BaiJia\LiveLargeClass\Live\ClassStart('111111');
    $obj->setRoomId(123);
    //TODO: 参考类实现设置其他参数
    $response = \SyLive\UtilBaiJia::sendServiceRequest($obj);
    print_r($response);

## Tencent
    $obj = new \SyLive\Tencent\Auth\PlayKeyDescribe();
    $obj->setDomainName('aaa.com');
    //TODO: 参考类实现设置其他参数
    $response = \SyCloud\Tencent\Util::sendServiceRequest($obj, \SyConstant\ErrorCode::LIVE_TENCENT_REQ_ERROR);
    print_r($response);
