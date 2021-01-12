# 介绍
- JDK: 京东客
- TBK: 淘宝客

# 使用
## 京东客
## 淘宝客
```
$obj = new \SyPromotion\TBK\Promoter\TPwdConvert();
//其他参数设置参考类实现
$obj->setPasswordContent('111');
...
$res = \SyTaoBao\UtilBase::sendRequest($obj, \SyConstant\ErrorCode::PROMOTION_TBK_REQ_ERROR);
print_r($res);
```
