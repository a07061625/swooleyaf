<?php
require_once __DIR__ . '/helper_load.php';

//$config = new \Mail\MailConfig();
//$config->setServerType('smtp');
//$config->setServerNum('2');
//$config->setSenderEmail('jiangwei07061625@163.com');
//$config->setSenderName('jw');
//$config->addReceiver('837483732@qq.com', 'jw');
//$config->addReceiver('jiangwei07061625@163.com', 'jw');
//$config->setTitle('my test');
//$config->setBody('hao123456发达的');
//$config->setAlt('ddd');
//
//\Mail\Mailer::sendSMTPMail($config);

//$goods = new \Entities\Test\Goods();
//$model = $goods->getContainer()->getModel();
//$dbTable = $model->getOrmDbTable();
//echo $dbTable->select('`id`,`images`,`title`')->where('`id` > ?', 2)->order('`id` DESC');
//echo "\n";
//$data = $model->findPage($dbTable, 2, 5);
//print_r($data);
//echo "\n";
//$dbTable2 = $model->getOrmDbTable();
//$dbTable2->select('`id`,`images`,`title`,`created`')->where('`id` > ?', 5);
//$data2 = $model->findOne($dbTable2);
//print_r($data2);
//echo "\n";
//
//try {
//    $r1 = $model->getOrmDbTable()->where('`id`=?', 26)->update([
//        'title' => 'fadsjfads',
//        'price' => '`price`+10'
//    ]);
//    echo $r1;
//    echo "\n";
//} catch (Exception $e) {
//    \SyLog\Log::error($e->getMessage(), 0, $e->getTraceAsString());
//}

//$nowTime = time();
//$salt = \SyTool\Tool::createNonceStr(32);
//$user = new \Entities\Test\Users();
//$model2 = $user->getContainer()->getModel();
//$dbTable3 = $model2->getOrmDbTable();
//$dbTable3->insert([
//    'name' => 'jw112233',
//    'sex' => 1,
//    'phone' => '13222332355',
//    'pwd' => \SyTool\Tool::encryptPassword('123456', $salt),
//    'pwd_salt' => $salt,
//    'created' => $nowTime,
//    'updated' => $nowTime,
//]);
//$dbTable3->select('`id`,`name`,`phone`,`pwd`')->where('`id` > ?', 1);
//$data3 = $model->findPage($dbTable3, 1, 10);
//print_r($data3);
//echo "\n";
////echo $dbTable->insert_id();
//$aa = new \AliPay\PayWap();
//$num = preg_match('/^(http|https|ftp)\:\/\/\S+$/', 'http://wp.xshapp.cn/Index/User/myOrder?type=0');
//echo $num;

//$goods = new \Entities\Test\Goods();
//$arr1 = $goods->getContainer()->getModel()->getDbs(true);
//print_r($arr1);
//echo PHP_EOL;
//$redis =  \DesignPatterns\Singletons\RedisSingleton::getInstance()->getConn();
//$redis->hSet('test123', 'uid', '112233');
//$redis->expire('test123', 30);
//$res = $redis->sCard('test123');
//var_dump($res);
//$uid = $redis->hGet('test123', 'uid');
//if ($uid === false) {
//    echo 'false';
//}else {
//    echo $uid;
//}

//$aaa = new \Map\BaiDu\CoordinateTranslate();
//$aaa->addCoordinate('112.332233', '22.125532');
//$aaa->addCoordinate('112.1122', '21.334422');
//$aaa->setFromType(3);
//$aaa->setServerIp('120.24.225.248');
//$arr = \DesignPatterns\Singletons\MapBaiduSingleton::getInstance()->translateCoord($aaa);

//$client = new swoole_client(SWOOLE_SOCK_TCP);
//if (!$client->connect('127.0.0.1', 7100, 0.5, 0)) {
//    echo 'connect socket server fail';
//    echo PHP_EOL;
//}
//
//$openStr = "GET / HTTP/1.1\r\n";
//$openStr .= "Origin: http://127.0.0.1\r\n";
//$openStr .= "Host: 127.0.0.1:7100\r\n";
//$openStr .= "Sec-WebSocket-Key: " . base64_encode(time()) . "\r\n";
//$openStr .= "User-Agent: PHPWebSocketClient/1.0\r\n";
//$openStr .= "Upgrade: websocket\r\n";
//$openStr .= "Connection: Upgrade\r\n";
//$openStr .= "Sec-WebSocket-Protocol: wamp\r\n";
//$openStr .= "Sec-WebSocket-Version: 13\r\n\r\n";
//$client->send($openStr);
//if (!$client->recv()) {
//    echo 'error:' . $client->errMsg;
//    echo PHP_EOL;
//}
//$client->send("hello world\n");
//echo $client->recv();
//echo PHP_EOL;
//$client->close();

//$client = new \SyServer\SwooleSocketClient('127.0.0.1', 7100);
//$client->sendMessage('0002', [
//    '_api_uri' => '/Index/Image/index',
//    'callback' => 'abcdefff',
//]);
//$data = $client->recv();
//if (is_string($data)) {
//    echo 'aa|'.$data;
//} else {
//    echo 'xxx';
//}
//echo PHP_EOL;
//unset($client);
//$yac = \DesignPatterns\Factories\CacheSimpleFactory::getYacInstance();
//$yac->set('myname', 'jiangwei' . time(), 3);
//echo $yac->get('myname') . '|||';
//echo PHP_EOL;
//sleep(5);
//$aaa = $yac->get('myname');
//if (is_null($aaa)) {
//    echo  'null';
//} elseif (is_string($aaa)) {
//    echo  's>tring';
//} elseif (is_bool($aaa)) {
//    echo $aaa ? 'true' : 'false';
//}
//echo PHP_EOL;
//$swift = new \Mailer\SySwiftMailer('0001');
//$swift->setTitle('juest test');
//$swift->setBody('112233');
//$swift->setSenderNameAndEmail('837483732@qq.com', 'jw');
//$swift->addReceiver('837483732@qq.com', '');
//echo $swift->sendEmail();
//echo PHP_EOL;
//echo preg_replace('/[^0-9a-zA-Z\x{4e00}-\x{9fa5}]+/u', '', 'abc ccab  cee当地的22编程33');
//if (preg_match('/<\x{4e00}-\x{9fa5}>+\u/', '当地的编程') > 0) {
//    echo 11;
//} else {
//    echo 22;
//}
//echo preg_replace('/^<\x{4e00}-\x{9fa5}>+$/u', '666', '当地的编程');
//$className = '\Entities\Test\Shop';
//$shop = new $className();
//$shop->title = 'jwtest112233';
//$shop->images = 'http://www.baidu.com';
//$shop->lat = mt_rand(-90, 90) . '.' . mt_rand(1, 150000);
//$shop->lng = mt_rand(-180, 180) . '.' . mt_rand(1, 150000);
//$shop->created = time();
//$shopId = $shop->getContainer()->insert($shop->getEntityDataArray());
//echo $shopId;
//$result = $shop->getContainer()->getModel()->getOrmDbTable()->where('`title` LIKE ? AND `id` > ?', ['%test%', 2])->order('`id` DESC');
//$shopList = $shop->getContainer()->getModel()->setFields([
//    'id',
//    'title',
//    'images',
//    'lat',
//    'lng',
//])->findPage($result, 1, 10);
//echo print_r($shopList, true);
//echo PHP_EOL;
