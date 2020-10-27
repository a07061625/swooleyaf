# 介绍
目前支持的校验器分为三种: 字符串校验器、整数校验器、浮点数校验器

## 字符串校验器
- alnum: 数字,字母
- alpha: 字母
- baseimage: base64编码图片
- digit: 数字
- digitlower: 数字,小写字母
- digitupper: 数字,大写字母
- email: 邮箱
- frametoken: 框架令牌
- ip: IP地址
- json: JSON格式
- jwt: 会话JWT
- lat: 纬度
- lng: 经度
- lower: 小写字母
- max: 最大长度
- min: 最小长度
- noemoji: 不允许emoji表情
- nojs: 不允许js脚本
- phone: 手机号码
- regex: 正则表达式
- requestrate: 请求频率(仅api模块使用)
- required: 必填
- sign: 请求签名(仅api模块使用)
- tel: 联系方式
- upper: 大写字母
- url: URL链接
- zh: 中文,数字,字母

## 整数校验器
- between: 取值区间
- in: 取值枚举
- max: 最大值
- min: 最小值
- required: 必填

## 浮点数校验器
- between: 取值区间
- max: 最大值
- min: 最小值
- required: 必填
