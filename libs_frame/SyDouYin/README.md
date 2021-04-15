# 介绍
- Account: 帐号授权
- Data: 数据开放服务
- Enterprise: 企业号开放能力
- Interaction: 互动管理
- LifeService: 生活服务开放能力
- Search: 搜索管理
- Tool: 工具能力
- User: 用户管理
- Video: 视频管理

# 使用
```
$obj = new \SyDouYin\Account\AuthCodeDouYin('111111');
$obj->setRedirectUri('http://www.baidu.com');
//其它参数设置参考类实现
$res = \SyDouYin\Util::sendServiceRequest($obj, \SyConstant\ErrorCode::DOUYIN_ACCOUNT_REQ_ERROR);
print_r($res);
```
