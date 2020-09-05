# 介绍
- Cos: 腾讯云对象存储
- Kodo: 七牛云对象存储
- Oss: 阿里云对象存储

# 使用
## Cos
    $obj = new \SyObjectStorage\Cos\Object\ObjectPut();
    $obj->setObjectKey('aaa.jpg');
    //TODO: 参考类实现设置其他参数
    $response = \SyObjectStorage\UtilCos::sendServiceRequest($obj);
    print_r($response);

## Kodo
    $obj = new \SyObjectStorage\Kodo\Object\FileDelete();
    $obj->setFileName('aaa.jpg');
    //TODO: 参考类实现设置其他参数
    $response = \SyObjectStorage\UtilKodo::sendServiceRequest($obj);
    print_r($response);

## Oss
    $config = \DesignPatterns\Singletons\ObjectStorageConfigSingleton::getInstance()->getOssConfig();
    $client = \DesignPatterns\Singletons\ObjectStorageConfigSingleton::getInstance()->getOssClient();
    $response = $client->putObject($config->getBucketName(), 'aaa/bbb.jpg', '/path/to/file.jpg');
    print_r($response);
