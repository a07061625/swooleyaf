# 使用样例
    use Ecs\Request\V20140526 as Ecs;
    
    $iClientProfile = AliOpen\Core\Profile\DefaultProfile::getProfile("cn-hangzhou", "<your accessKey>", "<your accessSecret>");
    $client = new AliOpen\Core\DefaultAcsClient($iClientProfile);
    
    $request = new Ecs\DescribeRegionsRequest();
    $request->setMethod("GET");
    $response = $client->getAcsResponse($request);
    print_r($response);

# 介绍
- Afs:人机验证
- Cdn:内容分发网络
- CloudApi:API网关
- CloudAuth:实人认证
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
