# kodo
## 配置
- 将yaconf/qiniu.ini中的kodo.access.key和kodo.secret.key配置改成自己的
- 将yaconf/qiniu.ini文件移动到yaconf配置目录下

## 使用
    $bucketDel = new \QiNiu\Kodo\Bucket\BucketDel();
    $bucketDel->setBucketName('aaa');
    $res = \QiNiu\QiNiuUtilKodo::sendServiceRequest($bucketDel);
    var_dump($res);
    