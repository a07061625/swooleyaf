## 接口签名
### 说明
- 所有接口都必须设置接口签名,且每个签名值只能使用一次
- 签名支持从请求头和GET请求参数获取,优先从请求头获取
- 签名对应的请求头为Sy-Sign
- 签名对应的GET请求参数为_sign

### 算法
```
//签名随机字符串,6位长度字符串,小写字母+数字随机组合
$signNonce = 'sdfes2';
//签名秒级时间戳
$signTime = time();
//签名密钥,固定
$signSecret = 'r2n2uyactaw9tiniyk';
$sign = $signNonce . $signTime . md5($signNonce . $signSecret . $signTime);
```
