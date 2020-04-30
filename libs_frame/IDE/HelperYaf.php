<?php
namespace {
    define('YAF\VERSION', '3.2.1');
    define('YAF\ENVIRON', 'dev');
    define('YAF\ERR\STARTUP_FAILED', 512);
    define('YAF\ERR\ROUTE_FAILED', 513);
    define('YAF\ERR\DISPATCH_FAILED', 514);
    define('YAF\ERR\NOTFOUND\MODULE', 515);
    define('YAF\ERR\NOTFOUND\CONTROLLER', 516);
    define('YAF\ERR\NOTFOUND\ACTION', 517);
    define('YAF\ERR\NOTFOUND\VIEW', 518);
    define('YAF\ERR\CALL_FAILED', 519);
    define('YAF\ERR\AUTOLOAD_FAILED', 520);
    define('YAF\ERR\TYPE_ERROR', 521);
    define('YAF\ERR\ACCESS', 522);
}

namespace Yaf {
    /**
     * Class Application
     * Yaf应用类,代表一个产品/项目,是Yaf运行的主导者,真正执行的主题,它负责接收请求,协调路由,分发,执行,输出.
     * @package Yaf
     */
    final class Application {
        public function __construct($config, $environ = null){}

        /**
         * @return bool
         */
        public function run(){}

        /**
         * 运行回调函数,一般在命令行模式下运行.
         *
         * @param callable $entry 回调函数
         * @param string $_ 零个或者多个回调函数参数
         */
        public function execute(callable $entry, $_="..."){}

        /**
         * 获取当前的Application实例
         * @return \Yaf\Application
         */
        public static function app(){}

        /**
         * 获取当前Application的环境名,它被定义在yaf.environ,默认值为"product".
         * @return String
         */
        public function environ(){}

        /**
         * 调用bootstrap
         * 指示Application去寻找Bootstrap,并按照声明的顺序,执行所有在Bootstrap类中定义的以_init开头的方法.(php.net文档有误)
         * @param null|mixed $bootstrap
         * @return \Yaf\Application
         */
        public function bootstrap($bootstrap = null){}

        /**
         * 获取全局配置实例
         * @return \Yaf\Config_Abstract
         */
        public function getConfig(){}

        /**
         * 获取在配置文件中声明的模块,如果没有声明,它的默认值将是"Index".
         * @return String
         */
        public function getModules(){}

        /**
         * 获取当前请求的分发器Dispatcher的实例
         * @return \Yaf\Dispatcher
         */
        public function getDispatcher(){}

        /**
         * 设置应用的主目录
         * @param String $directory 目录路径.
         * @return \Yaf\Application
         */
        public function setAppDirectory($directory){}

        /**
         * 获取当前应用的主目录
         * @return string
         */
        public function getAppDirectory(){}

        /**
         * 获取最近产生的错误代码.
         * @return int
         */
        public function getLastErrorNo(){}

        /**
         * 获取最近产生的错误信息.
         * @return string
         */
        public function getLastErrorMsg(){}

        /**
         * 清除最近的错误信息,将设置$this->_err_no=0,$this->_err_msg=''.
         * @return \Yaf\Application
         */
        public function clearLastError(){}

        /**
         * @return \Yaf\Application
         */
        public function getInstance(){}
    }

    /**
     * Class Bootstrap_Abstract
     * Bootstrap是用来在Application运行(run)之前做一些初始化工作的机制.
     * 你可以通过继承Bootstrap_Abstract来定义自己的Bootstrap类.
     * 在Bootstrap类中所有以"_init"开头的公有的方法, 都会被按照定义顺序依次在Application::bootstrap()被调用的时刻调用.
     * @package Yaf
     */
    abstract class Bootstrap_Abstract {
    }

    /**
     * Class Dispatcher
     * Dispatcher实现了MVC中的C分发,它由Application负责初始化,然后由Application::run启动,它协调路由来的请求,并分发和执行发现的动作.
     * 并收集动作产生的响应,输出响应给请求者,并在整个过程完成以后返回响应.
     * @package Yaf
     */
    final class Dispatcher {
        private function __construct(){}

        /**
         * 开启自动渲染模板
         * @return \Yaf\Dispatcher
         */
        public function enableView(){}

        /**
         * 关闭自动渲染模板
         * @return \Yaf\Dispatcher
         */
        public function disableView(){}

        /**
         * 初始化视图对象
         * @param string $templates_dir 模板目录
         * @param mixed $options 全局的模板选项（配置相关）
         * @return \Yaf\View_Interface
         */
        public function initView($templates_dir,array $options = null){}

        /**
         * 设置视图对象
         * @param \Yaf\View_Interface $view 视图对象实例
         * @return \Yaf\View_Interface
         */
        public function setView($view){}

        /**
         * 设置请求对象（在命令行或者其他API模式下构造请求很有用）
         * @param \Yaf\Request_Abstract $request 手动实例化的请求对象
         * @return \Yaf\Dispatcher
         */
        public function setRequest($request){}

        /**
         * 返回应用实例
         * @return \Yaf\Application
         */
        public function getApplication(){}

        /**
         * 返回路由器实例
         * @return \Yaf\Router
         */
        public function getRouter(){}

        /**
         * 返回响应对象实例
         * @return \Yaf\Response_Abstract
         */
        public function getResponse(){}

        /**
         * 返回请求对象实例
         * @return \Yaf\Request_Abstract
         */
        public function getRequest(){}

        /**
         * 获取默认的模块
         * @return string
         */
        public function getDefaultModule(){}

        /**
         * 获取默认的控制器
         * @return string
         */
        public function getDefaultController(){}

        /**
         * 获取默认的动作名
         * @return string
         */
        public function getDefaultAction(){}

        /**
         * 设置一个用户定义的错误处理函数（封装了PHP内置的set_error_handler函数）
         * @param callable $callback PHP中可回调的结构
         * @param int $error_types 处理的错误类型（默认：E_ALL | E_STRICT）
         * @return \Yaf\Dispatcher
         */
        public function setErrorHandler($callback, $error_types){}

        /**
         * 设置默认模块
         * @param string $module 模块名
         * @return \Yaf\Dispatcher
         */
        public function setDefaultModule($module){}

        /**
         * 设置默认的控制器
         * @param string $controller 控制器名
         * @return \Yaf\Dispatcher
         */
        public function setDefaultController($controller){}

        /**
         * 设置默认的动作名
         * @param string $action
         * @return \Yaf\Dispatcher
         */
        public function setDefaultAction($action){}

        /**
         * 设置或者返回$this->_return_response属性的值
         * 当传递$flag参数时,设置$this->_return_response=$flag,并返回Dispatcher
         * 当不传递任何参数时,返回$this->_return_response当前值
         * @param boolean $flag
         * @return mixed
         */
        public function returnResponse($flag){}

        /**
         * 设置或者返回$this->_auto_render属性的值
         * 当传递$flag参数时,设置$this->_auto_render=$flag,并返回Dispatcher
         * 当不传递任何参数时,返回$this->_auto_render属性的值
         * @param boolean $flag
         * @return mixed
         */
        public function autoRender($flag){}

        /**
         * 设置或者返回$this->_instantly_flush属性的值
         * 当传递$flag参数时,设置$this->_instantly_flush=$flag,并返回Dispatcher
         * 当不传递任何参数时,返回$this->_instantly_flush属性的值
         * @param boolean $flag
         * @return mixed
         */
        public function flushInstantly($flag){}

        /**
         * 返回当前Dispatcher实例（单例模式）
         * @return \Yaf\Dispatcher
         */
        public static function getInstance(){}

        /**
         * 手动分发请求
         * @param \Yaf\Request_Abstract $request 分发的请求对象
         * @return \Yaf\Response_Abstract
         */
        public function dispatch($request){}

        /**
         * 开启/关闭异常抛出或返回当前状态
         * 当传递$flag参数时,设置抛出异常,并返回Dispatcher
         * 当不传递任何参数时,返回抛出异常状态
         * @param boolean $flag
         * @return mixed
         */
        public function throwException($flag = null){}

        /**
         * 开启/关闭自动异常捕获功能或返回当前状态
         * 当传递$flag参数时,设置自动异常捕获,并返回Dispatcher
         * 当不传递任何参数时,返回当前状态
         * 注意：如果开启了Yaf\Dispatcher::catchException() （可以通过设置application.dispatcher.catchException来开启）,
         * 并且在你定义了异常处理的controller的情况下,Yaf会将所有未捕获的异常交给Error Controller的Error Action来处理.
         * @param boolean $flag
         * @return mixed
         */
        public function catchException($flag = null){}

        /**
         * 注册插件
         * @param \Yaf\Plugin_Abstract $plugin 实例化的插件对象
         * @return \Yaf\Dispatcher
         */
        public function registerPlugin($plugin){}
    }

    /**
     * Class Loader
     * Loader类为Yaf提供了自动加载功能,它根据类名中包含的路径信息实现类的定位和自动加载.
     * @package Yaf
     */
    final class Loader {
        private function __construct(){}

        /**
         * 自动装载类
         * @param string $class_name 类名
         * @return bool
         */
        public function autoload($class_name){}

        /**
         * 获取Loader实例
         * @param string $local_library_path 本地类库目录
         * @param string $global_library_path 全局类库目录
         * @return \Yaf\Loader
         */
        public static function getInstance($local_library_path = null, $global_library_path = null){}

        /**
         * 注册本地类前缀
         * @param mixed $namespace 一个或者多个类前缀
         * @param mixed $path 目录
         * @return bool
         */
        public function registerLocalNamespace($namespace, $path = null){}

        /**
         * 获取当前已经注册的本地类前缀
         * @return string
         */
        public function getLocalNamespace(){}

        /**
         * 清空已注册的本地类前缀
         */
        public function clearLocalNamespace(){}

        /**
         * 判断一个类, 是否是本地类.
         * @param string $class_name 类名
         * @return bool
         */
        public function isLocalName($class_name){}

        public function getNamespacePath($class_name){}

        /**
         * 手动导入文件
         * @param string $file include的全路径文件名
         * @return bool
         */
        public static function import($file){}

        /**
         * 设置本地或者全局类库目录
         * @param string $library_path 目录路径
         * @param bool $is_global 是否为全局类库
         * @return bool
         */
        public function setLibraryPath($library_path, $is_global = null){}

        /**
         * 获取本地或者全局类库目录
         * @param boolean $is_global
         * @return string
         */
        public function getLibraryPath($is_global = null){}

        public function registerNamespace($namespace, $path = null){}

        public function getNamespaces(){}
    }

    /**
     * Class Request_Abstract
     * 代表了一个实际请求,一般的不用自己实例化它,Application在run以后会自动根据当前请求实例它.
     * @package Yaf
     */
    abstract class Request_Abstract {
        /* constants */
        const SCHEME_HTTP = 'http';
        const SCHEME_HTTPS = 'https';

        /**
         * 判断是否为GET请求
         * @return bool
         */
        public function isGet(){}

        /**
         * 判断是否为POST请求
         * @return bool
         */
        public function isPost(){}

        public function isDelete(){}

        public function isPatch(){}

        /**
         * 判断是否为PUT请求
         * @return bool
         */
        public function isPut(){}

        /**
         * 判断是否为HEAD请求
         * @return bool
         */
        public function isHead(){}

        /**
         * 判断是否为Options请求
         * @return bool
         */
        public function isOptions(){}

        /**
         * 判断是否为CLI请求
         * @return bool
         */
        public function isCli(){}

        /**
         * 判断是否为AJAX请求
         * @return bool
         */
        public function isXmlHttpRequest(){}

        /**
         * 获取服务器$_SERVER全局变量中的值
         * @param string $name 变量名
         * @param mixed $default 默认值
         * @return mixed
         */
        public function getServer($name, $default = null){}

        /**
         * 获取环境变量$_ENV全局变量中的值
         * @param string $name 变量名
         * @param string $default 默认值
         * @return mixed
         */
        public function getEnv($name, $default = null){}

        /**
         * 设置请求的参数
         * 当只有一个参数且为Array类型,如果存在对应的键值将覆盖
         * @param string $name 变量名
         * @param mixed $value 变量值
         * @return bool
         */
        public function setParam($name, $value = null){}

        /**
         * 获取请求的参数
         * @param string $name 变量名
         * @param string $default 默认值
         * @return mixed
         */
        public function getParam($name, $default = null){}

        /**
         * 获取请求全部的参数
         * @return array
         */
        public function getParams(){}

        public function clearParams(){}

        /**
         * 获取异常对象
         * 异常捕获模式下,在异常发生的情况时流程进入Error控制器的error动作时,获取当前发生的异常对象.
         * @return \Exception
         */
        public function getException(){}

        /**
         * 获取当前模块名
         * @return string
         */
        public function getModuleName(){}

        /**
         * 获取当前控制器名
         * @return string
         */
        public function getControllerName(){}

        /**
         * 获取当前动作名
         * @return string
         */
        public function getActionName(){}

        /**
         * 设置请求的模块名
         * @param string $module 模块名
         * @param string|null $format_name 格式化名称
         * @return bool
         */
        public function setModuleName($module, $format_name = null){}

        /**
         * 设置请求的控制器名
         * @param string $controller 控制器名
         * @param string|null $format_name 格式化名称
         * @return bool
         */
        public function setControllerName($controller, $format_name = null){}

        /**
         * 设置请求的动作名
         * @param string $action 动作名
         * @param string|null $format_name 格式化名称
         * @return bool
         */
        public function setActionName($action, $format_name = null){}

        /**
         * 获取当前请求的方法
         * @return string
         */
        public function getMethod(){}

        /**
         * 获取当前请求的语言
         * @return string
         */
        public function getLanguage(){}

        /**
         * 设置请求的Base URI
         * @param string $uri
         * @return \Yaf\Request_Abstract
         */
        public function setBaseUri($uri){}

        /**
         * 获取请求的Base URI
         * @return string
         */
        public function getBaseUri(){}

        /**
         * 获取请求的uri
         * @return string
         */
        public function getRequestUri(){}

        /**
         * 设置请求的URI
         * @param string $uri
         * @return \Yaf\Request_Abstract
         */
        public function setRequestUri($uri){}

        /**
         * 判断请求是否完成了分发
         * @return bool
         */
        public function isDispatched(){}

        /**
         * 设置请求已经完成分发
         * @param bool $dispatched
         * @return \Yaf\Request_Abstract
         */
        public function setDispatched($dispatched){}

        /**
         * 判断请求是否完成了路由
         * @return bool
         */
        public function isRouted(){}

        /**
         * 设置请求已经完成了路由
         * @param bool $flag
         * @return \Yaf\Request_Abstract
         */
        public function setRouted($flag){}
    }

    /**
     * Class Response_Abstract
     * 响应对象和请求对象相对应, 是发送给请求端的响应的载体
     * @package Yaf
     */
    abstract class Response_Abstract {
        /* constants */
        const DEFAULT_BODY = 'content';

        public function __construct(){}

        /**
         * 返回响应正文的字符串
         * @return string
         */
        public function __toString(){}

        /**
         * 设置类型为$name的响应正文内容
         * @param string $body 响应正文内容(可覆盖原来的)
         * @param string $name 响应正文类型,默认为content
         * @return bool
         */
        public function setBody($body, $name = null){}

        /**
         * 设置类型为$name的响应正文内容, 如已存在,则追加到原来正文的后面
         * @param string $body 响应正文内容(可追加)
         * @param string $name 响应正文类型,默认为content
         * @return bool
         */
        public function appendBody($body, $name = null){}

        /**
         * 设置类型为$name的响应正文内容, 如已存在,则追加到原来正文的前面
         * @param string $body 响应正文内容(可追加)
         * @param string $name 响应正文类型,默认为content
         * @return bool
         */
        public function prependBody($body, $name = null){}

        /**
         * 清空响应正文
         * @param string $name 响应正文类型,默认为content
         * @deprecated 总是返回false
         * @return bool
         */
        public function clearBody($name = null){}

        /**
         * 获取类型为$name的响应正文内容
         * @param string $name 响应正文类型,默认为content
         * @return string
         */
        public function getBody($name = null){}

        /**
         * 输出所有的响应正文
         * @return bool
         */
        public function response(){}
    }

    /**
     * Class Controller_Abstract
     * Controller_Abstract是Yaf的MVC体系的核心部分.
     * MVC是指Model-View-Controller,是一个用于分离应用逻辑和表现逻辑的设计模式.
     * Controller_Abstract体系具有可扩展性,可以通过继承已有的类,来实现这个抽象类,从而添加应用自己的应用逻辑.
     * 对于Controller来说, 真正的执行体是在Controller中定义的一个一个的动作, 当然这些动作也可以定义在Controller外.
     * @package Yaf
     */
    abstract class Controller_Abstract {
        public function __construct($request, $response, $view,array $args = null){}

        /**
         * 渲染动作对应的模板,并返回结果
         * @param string $tpl 视图名
         * @param array $parameters 传递到视图对象的参数
         * @return string
         */
        protected function render($tpl,array $parameters = null){}

        /**
         * 渲染动作对应的模板,并直接输出结果
         * @param string $tpl 视图名
         * @param array $parameters 传递到视图对象的参数
         * @return string
         */
        protected function display($tpl,array $parameters = null){}

        /**
         * 获取请求对象
         * @return \Yaf\Request_Abstract
         */
        public function getRequest(){}

        /**
         * 获取响应对象
         * @return \Yaf\Response_Abstract
         */
        public function getResponse(){}

        /**
         * 返回视图对象
         * @return \Yaf\View_Interface
         */
        public function getView(){}

        public function getName(){}

        /**
         * 获取当前模块名
         * @return string
         */
        public function getModuleName(){}

        /**
         * 初始化视图对象
         * @deprecated 一直不可用,调用此方法只会返回Controller_Abstract的实例
         * @param array $options 配置数组
         * @return Controller_Abstract
         */
        public function initView(array $options = []){}

        /**
         * 设置模板文件目录
         * @param string $view_directory
         * @return bool
         */
        public function setViewpath($view_directory){}

        /**
         * 获取模板文件目录
         * @return string
         */
        public function getViewpath(){}

        /**
         * 将当前的请求转交给另外的Action(对用户来说是透明的,相当于Web服务器的代理).
         * 调用Yaf\Controller_Abstract::forward()以后,不会直接立即跳转到目的Action执行,
         * 而是会在当前的Action执行完成后,下一轮的DispatchLoop中,交给目的Action.
         * 所以, 如果你希望立即跳转到目的Action, 那么请使用return结束当前的执行流程.
         * @param string $module
         * @param string $controller
         * @param string $action
         * @param array $parameters
         * @return bool
         */
        public function forward($module, $controller = null, $action = null,array $parameters = null){}

        /**
         * 将当前请求重定向到指定的URL(内部实现是通过发送Location报头实现,如：header("Location:http//www.phpboy.net/"))
         * @param string $url
         * @return bool
         */
        public function redirect($url){}

        /**
         * 获取全部调用参数
         * @return array
         */
        public function getInvokeArgs(){}

        /**
         * 获取指定调用参数名的值
         * @param string $name
         * @return mixed
         */
        public function getInvokeArg($name){}
    }

    /**
     * Class Action_Abstract
     * Action_Abstract是MVC中C的动作,一般而言动作都是定义在Controller_Abstract的派生类中的.
     * 但是有的时候,为了使得代码清晰,分离一些大的控制器,则可以采用单独定义Action_Abstract来实现.
     * @package Yaf
     */
    abstract class Action_Abstract extends \Yaf\Controller_Abstract {
        /**
         * 当前请求的控制器实例
         * @var \Yaf\Controller_Abstract
         */
        protected $_controller = null;

        /**
         * 动作入口方法,由Yaf框架自动调用
         * @return mixed
         */
        abstract public function execute();

        /**
         * 获取当前请求的控制器实例
         * @return \Yaf\Controller_Abstract
         */
        public function getController(){}

        public function getControllerName(){}

        public function __construct($request, $response, $view,array $args = null){}

        protected function render($tpl,array $parameters = null){}

        protected function display($tpl,array $parameters = null){}

        public function getRequest(){}

        public function getResponse(){}

        public function getView(){}

        public function getName(){}

        public function getModuleName(){}

        public function initView(array $options = null){}

        public function setViewpath($view_directory){}

        public function getViewpath(){}

        public function forward($module, $controller = null, $action = null,array $parameters = null){}

        public function redirect($url){}

        public function getInvokeArgs(){}

        public function getInvokeArg($name){}
    }

    /**
     * Class Config_Abstract
     * Config_Abstract被设计在应用程序中简化访问和使用配置数据.它为在应用程序代码中访问这样的配置数据提供了一个基于用户接口的嵌入式对象属性.
     * 配置数据可能来自于各种支持等级结构数据存储的媒体.Config_Abstract实现了Countable,ArrayAccess和Iterator接口.
     * 这样,可以基于Config_Abstract对象使用count()函数和PHP语句如foreach,也可以通过数组方式访问Config_Abstract的元素.
     * @package Yaf
     */
    abstract class Config_Abstract implements \Iterator, \ArrayAccess, \Countable {
        /**
         * 获取配置节点的值
         * 当不传递$name参数时,返回配置对象本身
         * @param string $name
         * @return \Yaf\Config_Abstract
         */
        public function get($name = null){}

        public function count(){}

        /**
         * 将配置转换为数组
         * @return array
         */
        public function toArray(){}

        public function offsetUnset($name){}

        public function rewind(){}

        public function current(){}

        public function key(){}

        public function next(){}

        public function valid(){}

        public function __isset($name){}

        public function __get($name = null){}

        public function offsetGet($name = null){}

        public function offsetExists($name){}

        abstract public function offsetSet($offset, $value);

        /**
         * 设置配置节点的值
         * @param string $name
         * @param mixed $value
         * @return bool
         */
        abstract public function set($name, $value);

        /**
         * 返回配置只读的状态
         * @return bool
         */
        abstract public function readonly();
    }

    /**
     * Interface View_Interface
     * View_Interface是为了提供可扩展的,可自定的视图引擎而设立的视图引擎接口,它定义了用在Yaf上的视图引擎需要实现的方法和功能.
     * @package Yaf
     */
    interface View_Interface {
        /**
         * 传递变量到模板
         * 当只有一个参数时,参数必须是Array类型,可以展开多个模板变量
         * @param string|array $spec 变量
         * @param string $value 变量值
         * @return bool
         */
        public function assign($spec, $value = null);

        /**
         * 渲染模板并直接输出
         * @param string $name 模板文件名
         * @param array $vars 模板变量
         * @return bool
         */
        public function display($name, $vars = []);

        /**
         * 渲染模板并返回结果
         * @param string $name 模板文件名
         * @param array $vars 模板变量
         * @return string
         */
        public function render($name, $vars = []);

        /**
         * 设置模板文件目录
         * @param string $path 模板文件目录路径
         * @return bool
         */
        public function setScriptPath($path);

        /**
         * 获取模板目录文件
         * @return string
         */
        public function getScriptPath();
    }

    /**
     * Class Router
     * Router是标准的框架路由.
     * 路由是一个拿到URI端点(URL中的URI的一部分)然后分解参数得到哪一个module,controller,和action需要接受请求.
     * @package Yaf
     */
    final class Router {
        public function __construct(){}

        /**
         * 往Router中添加新的路由
         * @param string $name
         * @param \Yaf\Route_Interface $route
         * @return \Yaf\Router
         */
        public function addRoute($name, Route_Interface $route){}

        /**
         * 向Router中添加配置文件或者配置数组定义的路由
         * @param array|\Yaf\Config_Abstract $config
         * @return \Yaf\Router
         */
        public function addConfig($config){}

        /**
         * 路由请求
         * @param \Yaf\Request_Abstract $request
         * @return bool
         */
        public function route($request){}

        /**
         * 获取路由名对应的路由协议实例
         * @param string $name 路由名
         * @return \Yaf\Route_Interface
         */
        public function getRoute($name){}

        /**
         * 获取已注册的所有路由协议
         * @return array
         */
        public function getRoutes(){}

        /**
         * 获取当前路由成功的路由协议实例
         * @return \Yaf\Route_Interface
         */
        public function getCurrentRoute(){}
    }

    /**
     * Interface Route_Interface
     * Route_Interface是Yaf路由协议的标准接口, 它的存在使得用户可以自定义路由协议
     * @package Yaf
     */
    interface Route_Interface {
        /**
         * 路由请求
         * @param \Yaf\Request_Abstract $request
         * @return bool
         */
        public function route($request);

        /**
         * 组合uri,路由解析的逆操作
         * @param array $info
         * @param mixed $query
         * @return string
         */
        public function assemble(array $info, array $query = null);
    }

    /**
     * Class Route_Static
     * 默认路由协议
     * @package Yaf
     */
    final class Route_Static implements \Yaf\Route_Interface {
        /**
         * 匹配请求
         * @param string $uri
         * @return bool
         */
        public function match($uri){}

        /**
         * 路由请求
         * @param \Yaf\Request_Abstract $request
         * @return bool
         */
        public function route($request){}

        /**
         * 组合uri,路由解析的逆操作
         * @param array $info
         * @param mixed $query
         * @return string
         */
        public function assemble(array $info,array $query = null){}
    }

    /**
     * Class Plugin_Abstract
     * Plugin_Abstract是Yaf的插件基类,所有应用在Yaf的插件都需要继承实现这个类,这个类定义了7个方法,依次在7个时机的时候被调用.
     * @package Yaf
     */
    abstract class Plugin_Abstract {
        /**
         * 在路由之前触发
         * @param \Yaf\Request_Abstract $request 当前请求对象
         * @param \Yaf\Response_Abstract $response 当前响应对象
         * @return mixed
         */
        public function routerStartup(Request_Abstract $request,Response_Abstract $response){}

        /**
         * 路由结束之后触发
         * @param \Yaf\Request_Abstract $request 当前请求对象
         * @param \Yaf\Response_Abstract $response 当前响应对象
         * @return mixed
         */
        public function routerShutdown(Request_Abstract $request,Response_Abstract $response){}

        /**
         * 分发循环开始之前被触发
         * @param \Yaf\Request_Abstract $request 当前请求对象
         * @param \Yaf\Response_Abstract $response 当前响应对象
         * @return mixed
         */
        public function dispatchLoopStartup(Request_Abstract $request,Response_Abstract $response){}

        /**
         * 分发循环结束之后被触发
         * @param \Yaf\Request_Abstract $request 当前请求对象
         * @param \Yaf\Response_Abstract $response 当前响应对象
         * @return mixed
         */
        public function dispatchLoopShutdown(Request_Abstract $request,Response_Abstract $response){}

        /**
         * 分发之前触发
         * @param \Yaf\Request_Abstract $request 当前请求对象
         * @param \Yaf\Response_Abstract $response 当前响应对象
         * @return mixed
         */
        public function preDispatch(Request_Abstract $request,Response_Abstract $response){}

        /**
         * 分发结束之后触发
         * @param \Yaf\Request_Abstract $request 当前请求对象
         * @param \Yaf\Response_Abstract $response 当前响应对象
         * @return mixed
         */
        public function postDispatch(Request_Abstract $request,Response_Abstract $response){}

        /**
         * 响应之前触发
         * @param \Yaf\Request_Abstract $request 当前请求对象
         * @param \Yaf\Response_Abstract $response 当前响应对象
         * @return mixed
         */
        public function preResponse(Request_Abstract $request,Response_Abstract $response){}
    }

    /**
     * Class Registry
     * 对象注册表(或称对象仓库)是一个用于在整个应用空间(application space)内存储对象和值的容器.
     * 通过把对象存储在其中,我们可以在整个项目的任何地方使用同一个对象,这种机制相当于一种全局存储.
     * 我们可以通过Registry类的静态方法来使用对象注册表.
     * 另外,由于该类是一个数组对象,你可以使用数组形式来访问其中的类方法.
     * @package Yaf
     */
    final class Registry {
        private function __construct(){}

        /**
         * 获取注册变量值
         * @param string $name 变量名
         * @return mixed
         */
        public static function get($name){}

        /**
         * 检测变量是否存在
         * @param string $name 变量名
         * @return bool
         */
        public static function has($name){}

        /**
         * 注册变量
         * @param string $name 变量名
         * @param mixed $value 变量值
         * @return bool
         */
        public static function set($name, $value){}

        /**
         * 删除变量
         * @param string $name
         * @return bool
         */
        public static function del($name){}
    }

    /**
     * Class Session
     * 会话管理类
     * @package Yaf
     */
    final class Session implements \Iterator, \ArrayAccess, \Countable {
        private function __construct(){}

        /**
         * 获取Session实例(单例模式)
         * @return \Yaf\Session
         */
        public static function getInstance(){}

        /**
         * 开启会话
         * @return \Yaf\Session
         */
        public function start(){}

        /**
         * 获取session变量
         * @param string $name 变量名
         * @return mixed
         */
        public function get($name){}

        /**
         * 是否存在session变量
         * @param string $name
         * @return bool
         */
        public function has($name){}

        /**
         * 设置session变量
         * @param string $name 变量名
         * @param mixed $value 变量值
         * @return bool
         */
        public function set($name, $value){}

        /**
         * 撤消session变量
         * @param string $name 变量名
         * @return bool
         */
        public function del($name){}

        /**
         * 返回session变量的数量
         * @return int
         */
        public function count(){}

        /**
         * 清空session
         */
        public function clear(){}

        /**
         * 获取session变量
         * @param string $name 变量名
         * @return \Yaf\Session
         */
        public function offsetGet($name){}

        /**
         * 设置session变量
         * @param string $name 变量名
         * @param mixed $value 变量值
         * @return bool
         */
        public function offsetSet($name, $value){}

        /**
         * 测试某个session变量是否存在
         * @param mixed $name 变量名
         * @return bool
         */
        public function offsetExists($name){}

        /**
         * 撤消某个session变量
         * @param string $name 变量名
         * @return bool
         */
        public function offsetUnset($name){}

        public function __get($name){}

        public function __isset($name){}

        public function __set($name, $value){}

        public function __unset($name){}

        /**
         * 返回当前变量
         */
        public function current(){}

        /**
         * 向前移动到下一个元素
         */
        public function next(){}

        /**
         * 返回当前配置节点的key
         * @return mixed
         */
        public function key(){}

        /**
         * 判断是否可以继续遍历
         * @return bool
         */
        public function valid(){}

        /**
         * 重置遍历位置
         */
        public function rewind(){}
    }

    /**
     * Class Exception
     * Yaf异常基类
     * @package Yaf
     */
    class Exception extends \Exception implements \Throwable {
        /* properties */
        protected $file = null;
        protected $line = null;
        /**
         * 异常信息
         * @var string
         */
        protected $message = null;
        /*
         * 异常状态码
         * @var int
         */
        protected $code = 0;
        /**
         * 上一个异常对象
         * @var \Yaf\Exception
         */
        protected $previous = null;

        final private function __clone(){}

        public function __construct($message = null, $code = null, $previous = null){}

        public function __wakeup(){}

        public function __toString(){}
    }
}

namespace Yaf\Request {

    /**
     * Class Http
     * 代表了一个实际的Http请求,一般的不用自己实例化它,Application在run以后会自动根据当前请求实例它.
     * @package Yaf\Request
     */
    final class Http extends \Yaf\Request_Abstract {
        /**
         * 获取$_GET中名为$name的参数值
         * @param string $name 变量名
         * @param string $default 默认值
         * @return mixed
         */
        public function getQuery($name = null, $default = null){}

        /**
         * 获取$_REQUEST中名为$name的参数值
         * @param string $name 变量名
         * @return mixed
         */
        public function getRequest($name = null){}

        /**
         * 获取$_POST中名为$name的参数值
         * @param string $name 变量名
         * @param string $default 默认值
         * @return mixed
         */
        public function getPost($name = null, $default = null){}

        /**
         * 获取$_COOKIE中名为$name的参数值
         * @param string $name 变量名
         * @return mixed
         */
        public function getCookie($name = null){}

        public function getRaw(){}

        /**
         * 获取$_FILES中名为$name的参数值
         * @param string $name 变量名
         * @return mixed
         */
        public function getFiles($name = null){}

        /**
         * 获取全局变量中的值(扫描顺序为$_POST,$_GET,$_COOKIE,$_SERVER)
         * @param string $name 变量名
         * @param mixed $default 默认值
         * @return mixed
         */
        public function get($name, $default = null){}

        public function isXmlHttpRequest(){}

        /**
         * 构造方法
         * @param string $request_uri Request URI(可选)
         * @param string $base_uri Base URI(可选)
         */
        public function __construct($request_uri = null, $base_uri = null){}

        public function isGet(){}

        public function isPost(){}

        public function isDelete(){}

        public function isPatch(){}

        public function isPut(){}

        public function isHead(){}

        public function isOptions(){}

        public function isCli(){}

        public function getServer($name, $default = null){}

        public function getEnv($name, $default = null){}

        public function setParam($name, $value = null){}

        public function getParam($name, $default = null){}

        public function getParams(){}

        public function clearParams(){}

        /**
         * @return \Yaf\Exception
         */
        public function getException(){}

        public function getModuleName(){}

        public function getControllerName(){}

        public function getActionName(){}

        public function setModuleName($module, $format_name = null){}

        public function setControllerName($controller, $format_name = null){}

        public function setActionName($action, $format_name = null){}

        public function getMethod(){}

        public function getLanguage(){}

        public function setBaseUri($uri){}

        public function getBaseUri(){}

        public function getRequestUri(){}

        public function setRequestUri($uri){}

        public function isDispatched(){}

        public function setDispatched($dispatched){}

        public function isRouted(){}

        public function setRouted($flag){}
    }

    /**
     * Class Simple
     * 代表了一个实际的请求,一般的不用自己实例化它,Application在run以后会自动根据当前请求实例它.
     * @package Yaf\Request
     */
    final class Simple extends \Yaf\Request_Abstract {
        /* constants */
        const SCHEME_HTTP = 'http';
        const SCHEME_HTTPS = 'https';

        /**
         * 构造方法
         * @param mixed|string $method 方法名
         * @param mixed|string $module 模块名
         * @param mixed|string $controller 控制器名
         * @param mixed|string $action 动作名
         * @param mixed|array $parameters 请求的参数
         */
        public function __construct($method = null, $module = null, $controller = null, $action = null, $parameters = null){}

        /**
         * 获取$_GET中名为$name的参数值
         * @param string $name 变量名
         * @return mixed
         */
        public function getQuery($name = null){}

        /**
         * 获取$_REQUEST中名为$name的参数值
         * @param string $name 变量名
         * @return mixed
         */
        public function getRequest($name = null){}

        /**
         * 获取$_POST中名为$name的参数值
         * @param string $name 变量名
         * @return mixed
         */
        public function getPost($name = null){}

        /**
         * 获取$_COOKIE中名为$name的参数值
         * @param string $name 变量名
         * @return mixed
         */
        public function getCookie($name = null){}

        /**
         * 获取$_FILES中名为$name的参数值
         * @param string $name 变量名
         * @return mixed
         */
        public function getFiles($name = null){}

        /**
         * 获取全局变量中的值(扫描顺序为$_POST,$_GET,$_COOKIE,$_SERVER)
         * @param string $name 变量名
         * @param mixed $default 默认值
         * @return mixed
         */
        public function get($name, $default = null){}

        public function isXmlHttpRequest(){}

        public function isGet(){}

        public function isPost(){}

        public function isDelete(){}

        public function isPatch(){}

        public function isPut(){}

        public function isHead(){}

        public function isOptions(){}

        public function isCli(){}

        public function getServer($name, $default = null){}

        public function getEnv($name, $default = null){}

        public function setParam($name, $value = null){}

        public function getParam($name, $default = null){}

        public function getParams(){}

        public function clearParams(){}

        public function getException(){}

        public function getModuleName(){}

        public function getControllerName(){}

        public function getActionName(){}

        public function setModuleName($module, $format_name = null){}

        public function setControllerName($controller, $format_name = null){}

        public function setActionName($action, $format_name = null){}

        public function getMethod(){}

        public function getLanguage(){}

        public function setBaseUri($uri){}

        public function getBaseUri(){}

        public function getRequestUri(){}

        public function setRequestUri($uri){}

        public function isDispatched(){}

        public function setDispatched($dispatched){}

        public function isRouted(){}

        public function setRouted($flag){}
    }
}

namespace Yaf\Response {
    /**
     * Class Http
     * Http是在Yaf作为Web应用的时候默认响应载体
     * @package Yaf\Response
     */
    final class Http extends \Yaf\Response_Abstract {
        /* constants */
        const DEFAULT_BODY = 'content';

        public function setHeader($name, $value, $rep = null, $response_code = null){}

        public function setAllHeaders($headers){}

        public function getHeader($name = null){}

        public function clearHeaders(){}

        public function setRedirect($url){}

        public function response(){}

        public function __construct(){}

        public function __toString(){}

        public function setBody($body, $name = null){}

        public function appendBody($body, $name = null){}

        public function prependBody($body, $name = null){}

        public function clearBody($name = null){}

        public function getBody($name = null){}
    }

    /**
     * Class Cli
     * Cli是在Yaf作为命令行应用的时候默认响应载体
     * @package Yaf\Response
     */
    class Cli extends \Yaf\Response_Abstract {
        /* constants */
        const DEFAULT_BODY = 'content';

        public function __construct(){}

        public function __toString(){}

        public function setBody($body, $name = null){}

        public function appendBody($body, $name = null){}

        public function prependBody($body, $name = null){}

        public function clearBody($name = null){}

        public function getBody($name = null){}

        public function response(){}
    }
}

namespace Yaf\Config {
    /**
     * Class Ini
     * Ini存储在Ini文件的配置数据提供了适配器
     * @package Yaf\Config
     */
    final class Ini extends \Yaf\Config_Abstract implements \Countable, \ArrayAccess, \Iterator {
        /**
         * 构造方法,初始化Ini对象
         * @param string $config_file ini文件全路径
         * @param string $section 初始化时的配置节点名称
         */
        public function __construct($config_file, $section = null){}

        /**
         * (Yaf >= 2.2.9)
         * 获取配置节点的值
         * 当不传递$name参数时,返回配置对象本身
         * @param string $name
         * @return \Yaf\Config\Ini
         */
        public function get($name = null){}

        /**
         * (Yaf >= 2.2.9)
         * 设置配置节点值(无效)
         * @deprecated 约定ini文件的配置不可写
         * @param string $name 变量名
         * @param mixed $value
         * @return false
         */
        public function set($name, $value){}

        /**
         * 检测配置是否只读
         * @return bool
         */
        public function readonly(){}

        /**
         * 获取配置节点的值
         * 当不传递$name参数时,返回配置对象本身
         * @param string $name
         * @return \Yaf\Config\Ini
         */
        public function offsetGet($name = null){}

        /**
         * 设置配置节点值(无效)
         * @deprecated 约定ini文件的配置不可写
         * @param string $name 变量名
         * @param mixed $value
         * @return false
         */
        public function offsetSet($name, $value){}

        public function __set($name, $value){}

        /**
         * 返回配置节点的数量
         * @return int
         */
        public function count(){}

        /**
         * 将配置转化为数组
         * @return array
         */
        public function toArray(){}

        /**
         * 撤消某个配置节点(无效)
         * @deprecated 约定ini文件的配置不可写
         * @param string $name 变量名
         * @return false
         */
        public function offsetUnset($name){}

        public function rewind(){}

        public function current(){}

        public function key(){}

        public function next(){}

        public function valid(){}

        public function __isset($name){}

        public function __get($name = null){}

        /**
         * 测某个配置节点是否存在
         * @param mixed $name 节点名称
         * @return bool
         */
        public function offsetExists($name){}
    }

    /**
     * Class Simple
     * Simple为存储在PHP的数组中的配置数据提供了适配器
     * @package Yaf\Config
     */
    final class Simple extends \Yaf\Config_Abstract implements \Countable, \ArrayAccess, \Iterator {
        /**
         * 构造方法,初始化Simple对象
         * @param string $config 储存配置的数组
         * @param string $readonly 是否只读
         */
        public function __construct($config, $readonly = null){}

        public function set($name, $value){}

        public function readonly(){}

        public function offsetUnset($name){}

        public function __set($name, $value){}

        public function offsetSet($name, $value){}

        public function get($name = null){}

        public function count(){}

        public function toArray(){}

        public function rewind(){}

        /**
         * 返回当前节点
         * @return \Yaf\Config\Simple
         */
        public function current(){}

        public function key(){}

        public function next(){}

        public function valid(){}

        public function __isset($name){}

        public function __get($name = null){}

        public function offsetGet($name = null){}

        public function offsetExists($name){}
    }
}

namespace Yaf\View {

    /**
     * Class Simple
     * (Yaf >= 2.2.9)
     * View_Simple是Yaf自带的视图引擎,对于视图模板,就是普通的PHP脚本.
     * @package Yaf\View
     */
    final class Simple implements \Yaf\View_Interface {
        /**
         * 构造方法
         * @param string $template_dir 模板文件目录
         * @param array $options 此属性在php-5.4以下版本中适用,用以设置模板渲染的方式
         */
        final public function __construct($template_dir,array $options = null){}

        /**
         * 获取某个模板变量的值
         * 当不传递参数是,返回全部的模板变量数组
         * @param string $name 模板变量名
         * @return mixed
         */
        public function get($name = null){}

        public function assign($name, $value = null){}

        public function render($tpl, $tpl_vars = null){}

        public function eval($tpl_str, $vars = null){}

        public function display($tpl, $tpl_vars = null){}

        /**
         * 以引用的方式传递变量到模板
         * 当只有一个参数时,参数必须是Array类型,可以展开多个模板变量
         * @param string $name 变量名
         * @param string $value 变量值
         * @return bool
         */
        public function assignRef($name, &$value){}

        /**
         * 清空某个模板变量的值
         * 当不传递参数是,清空全部的模板变量
         * @param string $name 模板变量名
         * @return mixed
         */
        public function clear($name = null){}

        public function setScriptPath($template_dir){}

        public function getScriptPath($request = null){}

        public function __get($name = null){}

        public function __set($name, $value = null){}
    }
}

namespace Yaf\Route {

    /**
     * Class Simple
     * 简单路由协议
     * @package Yaf\Route
     */
    final class Simple implements \Yaf\Route_Interface {
        public function __construct($module_name, $controller_name, $action_name){}

        public function route($request){}

        public function assemble(array $info,array $query = null){}
    }

    /**
     * Class Supervar
     * 全局变量路由协议
     * @package Yaf\Route
     */
    final class Supervar implements \Yaf\Route_Interface {
        public function __construct($supervar_name){}

        public function route($request){}

        public function assemble(array $info,array $query = null){}
    }

    /**
     * Class Rewrite
     * 重写路由协议
     * @package Yaf\Route
     */
    final class Rewrite implements \Yaf\Route_Interface {
        public function __construct($match,array $route,array $verify = null){}

        public function match($uri){}

        public function route($request){}

        public function assemble(array $info,array $query = null){}
    }

    /**
     * Class Regex
     * 正则路由协议
     * @package Yaf\Route
     */
    final class Regex implements \Yaf\Route_Interface {
        public function __construct($match,array $route,array $map = null,array $verify = null, $reverse = null){}

        public function match($uri){}

        public function route($request){}

        public function assemble(array $info,array $query = null){}
    }

    /**
     * Class Map
     * Map议是一种简单的路由协议, 它将REQUEST_URI中以'/'分割的节, 组合在一起, 形成一个分层的控制器或者动作的路由结果.
     * @package Yaf\Route
     */
    final class Map implements \Yaf\Route_Interface {
        /**
         * (Yaf >= 2.2.9)
         * 构造方法
         * @param bool $controller_prefer 表示路由结果是作为动作的路由结果,还是控制器的路由结果,默认的是动作路由结果.
         * @param mixed $delimiter 表示一个分隔符,如果设置了这个分隔符,那么在REQUEST_URI中,分隔符之前的作为路由信息载体,而之后的作为请求参数.
         */
        public function __construct($controller_prefer = null, $delimiter = null){}

        public function route($request){}

        public function assemble(array $info,array $query = null){}
    }
}

namespace Yaf\Exception {
    /**
     * Class StartupError
     * Yaf App实例启动异常
     * @package Yaf\Exception
     */
    class StartupError extends \Yaf\Exception implements \Throwable {
        /* properties */
        protected $file = null;
        protected $line = null;
        protected $message = null;
        protected $code = 0;
        protected $previous = null;

        final private function __clone(){}

        public function __construct($message = null, $code = null, $previous = null){}

        public function __wakeup(){}

        public function __toString(){}
    }

    /**
     * Class RouterFailed
     * 路由异常
     * @package Yaf\Exception
     */
    class RouterFailed extends \Yaf\Exception implements \Throwable {
        /* properties */
        protected $file = null;
        protected $line = null;
        protected $message = null;
        protected $code = 0;
        protected $previous = null;

        final private function __clone(){}

        public function __construct($message = null, $code = null, $previous = null){}

        public function __wakeup(){}

        public function __toString(){}
    }

    /**
     * Class DispatchFailed
     * 分发异常
     * @package Yaf\Exception
     */
    class DispatchFailed extends \Yaf\Exception implements \Throwable {
        /* properties */
        protected $file = null;
        protected $line = null;
        protected $message = null;
        protected $code = 0;
        protected $previous = null;

        final private function __clone(){}

        public function __construct($message = null, $code = null, $previous = null){}

        public function __wakeup(){}

        public function __toString(){}
    }

    /**
     * Class LoadFailed
     * 装载异常
     * @package Yaf\Exception
     */
    class LoadFailed extends \Yaf\Exception implements \Throwable {
        /* properties */
        protected $file = null;
        protected $line = null;
        protected $message = null;
        protected $code = 0;
        protected $previous = null;

        final private function __clone(){}

        public function __construct($message = null, $code = null, $previous = null){}

        public function __wakeup(){}

        public function __toString(){}
    }

    /**
     * Class TypeError
     * 关键类型异常
     * @package Yaf\Exception
     */
    class TypeError extends \Yaf\Exception implements \Throwable {
        /* properties */
        protected $file = null;
        protected $line = null;
        protected $message = null;
        protected $code = 0;
        protected $previous = null;

        final private function __clone(){}

        public function __construct($message = null, $code = null, $previous = null){}

        public function __wakeup(){}

        public function __toString(){}
    }
}

namespace Yaf\Exception\LoadFailed {
    /**
     * Class Module
     * 模块加载异常
     * @package Yaf\Exception\LoadFailed
     */
    class Module extends \Yaf\Exception\LoadFailed implements \Throwable {
        /* properties */
        protected $file = null;
        protected $line = null;
        protected $message = null;
        protected $code = 0;
        protected $previous = null;

        final private function __clone(){}

        public function __construct($message = null, $code = null, $previous = null){}

        public function __wakeup(){}

        public function __toString(){}
    }

    /**
     * Class Controller
     * 控制器加载异常
     * @package Yaf\Exception\LoadFailed
     */
    class Controller extends \Yaf\Exception\LoadFailed implements \Throwable {
        /* properties */
        protected $file = null;
        protected $line = null;
        protected $message = null;
        protected $code = 0;
        protected $previous = null;

        final private function __clone(){}

        public function __construct($message = null, $code = null, $previous = null){}

        public function __wakeup(){}

        public function __toString(){}
    }

    /**
     * Class Action
     * 动作类加载异常
     * @package Yaf\Exception\LoadFailed
     */
    class Action extends \Yaf\Exception\LoadFailed implements \Throwable {
        /* properties */
        protected $file = null;
        protected $line = null;
        protected $message = null;
        protected $code = 0;
        protected $previous = null;

        final private function __clone(){}

        public function __construct($message = null, $code = null, $previous = null){}

        public function __wakeup(){}

        public function __toString(){}
    }

    /**
     * Class View
     * 视图加载异常
     * @package Yaf\Exception\LoadFailed
     */
    class View extends \Yaf\Exception\LoadFailed implements \Throwable {
        /* properties */
        protected $file = null;
        protected $line = null;
        protected $message = null;
        protected $code = 0;
        protected $previous = null;

        final private function __clone(){}

        public function __construct($message = null, $code = null, $previous = null){}

        public function __wakeup(){}

        public function __toString(){}
    }
}

