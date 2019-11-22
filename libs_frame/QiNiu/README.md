# 使用介绍
## kodo
首先将yaconf/qiniu.ini中的kodo.access.key和kodo.secret.key配置改成自己的,并将该ini文件移动到yaconf配置目录下

    $bucketDel = new \QiNiu\Kodo\Bucket\BucketDel();
    $bucketDel->setBucketName('aaa');
    $res = \QiNiu\QiNiuUtilKodo::sendServiceRequest($bucketDel);
    var_dump($res);