# 使用样例
    use Ecs\Request\V20140526 as Ecs;
    
    $iClientProfile = DefaultProfile::getProfile("cn-hangzhou", "<your accessKey>", "<your accessSecret>");
    $client = new DefaultAcsClient($iClientProfile);
    
    $request = new Ecs\DescribeRegionsRequest();
    $request->setMethod("GET");
    $response = $client->getAcsResponse($request);
    print_r($response);

# 介绍
- Afs:人机验证
- Dm:邮件推送
- Green:内容安全
- Live:视频直播
- Mts:媒体处理
- Ons:物联网微消息队列,可用于互动直播、车联网、金融支付、智能餐饮、即时聊天、移动 Apps等多种应用场景
- Ram:资源访问控制
- Sts:临时访问权限管理
- Vod:视频点播
