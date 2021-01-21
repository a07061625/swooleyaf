# SwooleYaf-佳优框架
[![Latest Version](static/images/release.svg)](https://github.com/a07061625/swooleyaf/releases)
[![License](static/images/license.svg)](LICENSE)
![](static/images/php.svg)
![](static/images/swoole.svg)
![](static/images/yaf.svg)
![](static/images/redis.svg)

如果你满足以下条件:
- 资深PHP程序员
- 不愿意更换开发程序语言
- 期待一个分布式的高性能框架
- 期待一个维护方便简单的框架
- 具备基础的系统架构设计理念并有基本的实践

那就不要犹豫,不要怀疑,佳优框架(SwooleYaf)就是你的理想选择,使用该框架,你轻易做到以下事情:
- 框架升级维护异常顺心,一次升级,所有项目同步一次性升级框架,无需项目做任何变动
- 模块添加简单方便
- 分布式部署简单快捷
- 极低的接口处理耗时,10毫秒内返回接口响应非常容易
- 功能扩展简单

SwooleYaf是PHP语言的高性能分布式微服务框架,专注于restful api接口开发,也可适用于前后端分离架构设计下服务端渲染模式的前端项目开发
- 底层基于高性能通信框架swoole,业务框架以高性能MVC框架yaf为骨架
- 模块之间消息通信以msgpack为基础,自定义通信协议,降低通信数据大小,提升通信安全性
- 内置接口签名,异步任务,定时任务等实用功能,生产环境可实现api接口处理平均耗时在20毫秒左右
- 基于该框架搭建项目请参考下面的<a href="#1">项目部署</a>章节

正式生产环境api接口耗时截图:<br/>
![](static/images/apitime_env_product.png)
<br/>除了少部分非常耗时的接口,大部分接口的平均耗时在20毫秒内,相当多的接口耗时甚至在10毫秒内

# <a name="1">项目部署</a>
讲解视频链接：https://pan.baidu.com/s/1lwt9hConr8cbVKRxLsltdw 提取码：mqzb 

# 环境
## 搭建脚本
请移步至项目 https://github.com/a07061625/swooleyaf_install.git

## 必要扩展
- swoole4.2.8+
- msgpack
- yaf3.0.4+
- yaconf1.0+
- yac2.0+
- redis3.0+
- Seaslog1.6+
- bcmath
- PDO
- pcre
- pcntl
- opcache

## 可选扩展
- imgick3.4+
- mongodb1.2+
- xdebug2.5+
- xhprof1.0+

## 其他
- gcc4.8+ //php7编译用gcc4.8+会开启Global Register for opline and execute_data支持, 这个会带来5%左右的性能提升

# **使用相关(重要,必须首先进行)**
## 设置项目核心配置
复制helper_load_example.php为helper_load.php并修改相关配置
其中: 
- SY_ENV: 环境类型,支持dev:开发 product:生产
- SY_PROJECT: 项目标识,3位长度,由数字和小写字母组成

## 设置php环境配置
复制helper_php_example.php为helper_php.php并修改相关配置

## 设置swoole启动项目配置
复制config_projects_example.php为config_projects.php并修改相关配置
其中:

- module_path: 模块目录,以sy_开头的目录名
- module_name: 模块名称,和SyConstant\Project::MODULE_NAME_*开头的常量保持相同
- listens.host: swoole服务运行的IP,可保持不变
- listens.port: swoole服务运行的端口
- listens.register_type: swoole服务注册类型, 空字符串:不注册 nginx:通过nginx注册,该注册方式通过lua实现

**注1: 如果想要运行多个swoole服务,listens数组添加多个并保证端口不冲突即可**

# 框架介绍
## 使用介绍
- 操作系统只支持linux,不支持windows,因为pcntl扩展,nohup,inotify只有linux才可用
- nginx建议使用版本大于1.9,因为1.9的nginx增加了stream模块,支持tcp反向代理和负载均衡
- favicon.ico请求不在框架内部做处理,建议配置nginx静态文件访问来实现获取该文件
- 建议单独设置一个文件服务模块用于处理文件上传,图片裁剪等功能
- 多服务器部署,必须确保服务端口对外开放,以避免服务模块跨服务器请求调用因端口未开放出现错误
- 框架内部模块之间请求调用全都不用cookie和session
- task任务投递不要投递到taskId=0的进程,该进程用于定时更新模块配置信息
- 对外部只开放api模块,需要获取其他模块的数据,通过发送rpc请求到其他模块获取数据
- api模块返回数据根据业务需求,既可以用控制器的SyResult对象,也可以直接在响应请求中直接设置数据
- api模块负责接受外部请求,返回响应数据,包括设置响应头,cookie等
- 非api模块返回数据统一用控制器的SyResult对象
- 非api模块不能设置响应头,cookie等信息,如需设置这些信息,将这些信息作为响应数据放到SyResult中,返回给api组装来间接设置响应头,cookie等
- 非api模块发送请求只有POST方式,不支持其他方式
- 图片上传请参考api模块Image控制器的uploadImageAction方法
- 微信,支付宝支付与回调处理请参考sy_order模块下的OrderDao文件
- 所有数据库表必须有且只能有单主键,不允许联合主键
- 拉取项目需要安装git和git-lfs,有部分文件是git-lfs上传

## 目录介绍
- libs_frame: 框架公共类目录
- libs_project: 项目公共类目录
- pidfile: 项目进程pid文件存放目录
- tipfile: 项目进程提示文件存放目录
- static: 静态文件目录
- yaconf: 框架配置文件目录,该目录内的配置文件为样例,使用时需要将配置文件移动到php.ini配置文件中yaconf.directory配置对应的目录下
- 其他目录: 项目模块目录,每一个目录对应一个项目模块

## <a name="2">命令</a>
### 启动服务
    /usr/local/php7/bin/php helper_service_manager.php -s start-all
### 关闭服务
    /usr/local/php7/bin/php helper_service_manager.php -s stop-all
### 重启服务
    /usr/local/php7/bin/php helper_service_manager.php -s restart-all
### 清理僵尸进程
    /usr/local/php7/bin/php helper_service_manager.php -s kz-all
### mysql工具
    /usr/local/php7/bin/php helper_mysql.php -h
### nginx工具
    /usr/local/php7/bin/php helper_nginx.php -h

## 预定义常量
- SY_ROOT //框架根目录
- SY_PROJECT_LIBS_ROOT //项目公共类根目录
- SY_FRAME_LIBS_ROOT //框架公共类根目录
- SY_ENV //框架环境 dev:测试环境 product:生产环境
- SY_PROJECT //框架项目名称
- SY_LOG_PATH //框架日志目录
- SY_SERVER_IP //服务器IP
- SY_VERSION //框架版本号
- SY_MODULE //框架模块名称
- SY_SERVER_TYPE //框架服务端类型 api: api入口 rpc:api模块 frontgate: 前端入口
- SY_REQUEST_MAX_HANDLING //服务同时处理的最大请求数量
- SY_DATABASE //框架数据库重连标识 true: 检测重连 false:不检测重连

## 服务管理
### 获取框架概览信息
    请求地址: http://api.xxx.com/0000

### 获取php信息
    请求地址: http://api.xxx.com/0001

## 性能压测
系统配置: <br/>
![](static/images/demo_system.png)<br/>
nginx配置: <br/>
![](static/images/demo_nginx.png)<br/>
压测结果: <br/>
![](static/images/demo_httpload.png)<br/>

## etcd
### 启动服务
    // ip:当前服务器内网或外网ip port:服务监听端口,默认为2379
    nohup etcd --listen-client-urls http://ip:port --advertise-client-urls http://ip:port >/dev/null &

## Mongodb文档
    https://docs.mongodb.com/php-library/

## XDebug代码分析
- 默认关闭了自动堆栈追踪和自动性能分析
- 开启堆栈追踪,如果是GET请求,必须在url上附带XDEBUG_TRACE参数,如果是POST请求,必须在请求体上附带XDEBUG_TRACE参数
- 开启性能分析,如果是GET请求,必须在url上附带XDEBUG_PROFILE参数,如果是POST请求,必须在请求体上附带XDEBUG_PROFILE参数
### 参考链接
    http://blog.csdn.net/why_2012_gogo/article/details/51170609

### 可视化工具
- KCacheGrind(Linux)
- QCacheGrind(Windows)

## XHPROF性能分析
### 使用样例
参考demo_xhprof.php文件

## 代码解耦
善用观察者模式来实现业务代码解耦,具体可参考邮件发送模块

## 接口签名
请求地址带上签名参数,统一只在api模块做签名校验,签名参数如下:
- _sign: 签名值,由数字,字母组成的48位字符串

## 定时任务
- 详情参见分支task

## 数据库连接池
- https://github.com/swoole/php-cp //连接池扩展
- https://github.com/swoole/swoole-src/blob/master/examples/mysql_proxy_server.php //swoole版

## 图片处理
- https://github.com/kosinix/grafika //参考地址

## 切面支持
说明:
- 切面类必须继承\SyAspect\BaseAspect
- 只支持在控制器的action方法注释上添加切面注释
- 支持的切面注释为SyAspect(环绕切面),SyAspectBefore(前置切面),SyAspectAfter(后置切面)
### 环绕切面
    /**
     * 登录
     * @SyAspect-\SyAspect\Demo
     */
    public function loginAction()
### 前置切面
    /**
     * 登录
     * @SyAspectBefore-\SyAspect\Demo
     */
    public function loginAction()
### 后置切面
    /**
     * 登录
     * @SyAspectAfter-\SyAspect\Demo
     */
    public function loginAction()

## 消息处理
### 添加消息数据
    $handlerType = \SyConstant\Project::MESSAGE_HANDLER_TYPE_SMS_DAYU;
    $queueType = \SyConstant\Project::MESSAGE_QUEUE_TYPE_REDIS;
    //具体的数据格式请参考对应消息生产者的checkMsgData方法,对应的命名空间为\SyMessageHandler\Producers
    $data = [
        'receivers' => [
            '12233334444'
        ],
        'template_id' => 'test11233',
        'template_sign' => '签名测试',
        'template_params' => [
            'code' => '123456'
        ],
    ];
    $addRes = \DesignPatterns\Singletons\MessageHandlerSingleton::getInstance()->addMsgData($handlerType, $data, $queueType);
    //将addRes的数据添加到数据库中,其中msg_id为消息ID,可作为消息处理记录的主键,方便后续查看消息处理的记录以及修改消息处理结果
### 处理消息数据(消息队列类型必须与添加的时候一致)
    $queueType = \SyConstant\Project::MESSAGE_QUEUE_TYPE_REDIS;
    $msgData = \DesignPatterns\Singletons\MessageHandlerSingleton::getInstance()->getMsgData($queueType);
    if (!empty($msgData)) {
        try{
            $handlerRes = \DesignPatterns\Singletons\MessageHandlerSingleton::getInstance()->invokeMsg($msgData);
        } catch (Exception $e) {
            \SyLog\Log::error($e->getMessage(), $e->getCode(), $e->getTraceAsString());
            $handlerRes = [
                'code' => 9999,
                'msg' => $e->getMessage(),
            ];
        }
        //通过msgData的msg_id和handlerRes,修改消息处理记录的处理结果
    }

## 布隆过滤器
### 初始化
修改libs_project/SyTrait/BloomTrait的initFilters方法,可参考现有代码自行初始化好所有的过滤器

### 添加数据到布隆过滤器
    $cacheKey = 'test1234';
    \DesignPatterns\Factories\CacheSimpleFactory::getRedisInstance()->set($cacheKey, 123);
    \DesignPatterns\Singletons\BloomSingleton::getInstance()->addKey('a01', $cacheKey);

### 使用布隆过滤器
    $cacheKey = 'test1234';
    $existTag = \DesignPatterns\Singletons\BloomSingleton::getInstance()->existKey('a01', $cacheKey);
    if ($existTag) {
        $cacheVal = \DesignPatterns\Factories\CacheSimpleFactory::getRedisInstance()->get($cacheKey);
    } else {
        echo '非法键名';
    }
