# 说明
## 备注
```
vim Client/Resolver/ApiResolver.php
    ...
    #warpEndpoint()方法中
    #将$product_dir = \dirname(\dirname($reflect->getFileName()));改成如下
    $product_dir = \dirname($reflect->getFileName());
    ...
```
