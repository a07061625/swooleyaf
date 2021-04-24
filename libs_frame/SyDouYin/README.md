# 介绍
- Comment: 评论
- Data: 数据
- Enterprise: 企业号
- Image: 图片
- Oauth: 授权
- Poi: 兴趣点
- Tool: 工具能力
- User: 用户管理
- Video: 视频管理

# 使用
```
$obj = new \SyDouYin\Oauth\AuthCodeDouYin('111111');
$obj->setRedirectUri('http://www.baidu.com');
//其它参数设置参考类实现
$res = \SyDouYin\Util::sendServiceRequest($obj, \SyConstant\ErrorCode::DOUYIN_OAUTH_REQ_ERROR);
print_r($res);
```
