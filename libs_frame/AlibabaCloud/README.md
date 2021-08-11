# 说明
- Afs:人机验证
- Cdn:内容分发网络
- CloudAPI:API网关
- Cloudauth:实人认证
- Dm:邮件推送
- Ecs:云服务器
- Green:内容安全
- Mts:媒体处理
- Nas:文件存储
- Ons:物联网微消息队列,可用于互动直播、车联网、金融支付、智能餐饮、即时聊天、移动 Apps等多种应用场景
- Ram:资源访问控制
- Rds:云数据库rds
- Sts:临时访问权限管理
- Vod:视频点播

## 备注
```
vim Client/Resolver/ApiResolver.php
    ...
    #warpEndpoint()方法中
    #将$product_dir = \dirname(\dirname($reflect->getFileName()));改成如下
    $product_dir = \dirname($reflect->getFileName());
    ...
```

# 用法
```
    \AlibabaCloud\Client\AlibabaCloud::accessKeyClient($config->getAppKey(), $config->getAppSecret())
        ->regionId($config->getRegionId())
        ->asDefaultClient();

    $smsBatch = new \AlibabaCloud\Dysmsapi\SendBatchSms();
    $smsBatch->withPhoneNumberJson(Tool::jsonEncode($msgData['receivers'], JSON_UNESCAPED_UNICODE))
        ->withTemplateCode($msgData['template_id'])
        ->withSignNameJson(Tool::jsonEncode($msgData['template_sign'], JSON_UNESCAPED_UNICODE));
    if (!empty($msgData['template_params'])) {
        $smsBatch->withTemplateParamJson(Tool::jsonEncode($msgData['template_params'], JSON_UNESCAPED_UNICODE));
    }
    $sendRes = $smsBatch->request()->toArray();
```