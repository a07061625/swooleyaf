<?php
namespace {
    define('YAF\VERSION', '3.0.4');
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
}
namespace Yaf {
    /**
     * Class Application
     *
     * Yaf应用类，代表一个产品/项目，是Yaf运行的主导者，真正执行的主题，它负责接收请求，协调路由，分发，执行，输出.
     *
     * @package Yaf
     */
    final class Application
    {
        /**
         * 全局配置实例
         *
         * 根据实例化Application时传入的ini配置文件路径或者配置数组及配置节点名称，实例化的Ini或者Simple对象.
         *
         * PHP代码可以这样获取：
         *
         * $config = Application::app()->getConfig();
         *
         * @var Config_Abstract
         */
        protected $config = null;
        /**
         * Dispatcher实例,即分发器.
         *
         * PHP代码可以这样获取：
         * $dispatcher = Application::app()->getDispatcher();
         *
         * @var Dispatcher
         */
        protected $dispatcher = null;
        /**
         * 过特殊的方式实现了单例模式, 此属性保存当前实例.
         *
         * PHP代码可以这样获取：
         * $app = Application::app();
         *
         * @var Application
         */
        protected static $_app = null;
        /**
         * 存在的模块名, 从配置文件中ap.modules读取.
         *
         * PHP代码可以这样获取：
         * $modules = Application::app()->geModules();
         *
         * @var String
         */
        protected $_modules = null;
        /**
         * 指明当前的Application是否已经运行.
         *
         * @var Boolean
         */
        protected $_running = false;
        /**
         * 前的环境名, 也就是Application在读取配置的时候, 获取的配置节名字.
         * 注：此值只能在Yaf扩展级的配置文件.ini里面进行修改，默认为product.
         *
         * PHP代码可以这样获取：
         * $environ = Application::app()->environ();
         *
         * @var String
         */
        protected $_environ = 'dev';
        /**
         * 最近一次发生的错误代码.
         *
         * PHP代码可以这样获取：
         * $err_on = Application::app()->getLastErrorNo();
         *
         * @var Int
         */
        protected $_err_no = '0';
        /**
         * 最近一次产生的错误信息.
         *
         * PHP代码可以这样获取：
         * $err_msg = Application::app()->getLastErrorMsg();
         *
         * @var String
         */
        protected $_err_msg = '';

        /**
         * 构造函数，根据配置初始化Application
         *
         * @param mixed $config 关联数组的配置, 或者一个指向ini格式的配置文件的路径的字符串.
         *                      如果是一个ini配置文件，那配置文件中应该有一个定义了yaf.environ 的配置节.这个在生产环境中是默认的.
         *                      如果你使用了ini配置文件作为你应用配置的容器，你需要打开yaf.cache_config 来提升性能.
         * @param string $section 加载的配置节点，使用该节点的配置初始化应用.
         * @param null|mixed $environ
         * @return Application
         */
        public function __construct($config, $environ = null)
        {
        }
        /**
         * 重置__destruct魔术方法.
         *
         * @return void
         */
        public function __destruct()
        {
        }
        /**
         * 重置__clone魔术方法，防止克隆Application（因为是单例模式）.
         *
         * @return void
         */
        private function __clone()
        {
        }
        /**
         * 重置__sleep魔术方法.
         *
         * @return void
         */
        private function __sleep()
        {
        }
        /**
         * 重置__wakeup魔术方法.
         *
         * @return void
         */
        private function __wakeup()
        {
        }
        /**
         * 运行Yaf Application
         *
         * @return Boolean
         */
        public function run()
        {
        }
        /**
         * 运行回调函数，一般在命令行模式下运行.
         *
         * @param callable $entry 回调函数
         * @param mixed $parameter 零个或者多个回调函数参数
         *
         * @return void
         */
        public function execute(callable $entry, $parameter = '...')
        {
        }
        /**
         * 获取当前的Application实例.
         *
         * @return Application
         */
        public static function app()
        {
        }
        /**
         * 获取当前Application的环境名,它被定义在yaf.environ，默认值为"product".
         *
         * @return String
         */
        public function environ()
        {
        }
        /**
         * 调用bootstrap
         *
         * 指示Application去寻找Bootstrap，并按照声明的顺序，执行所有在Bootstrap类中定义的以_init开头的方法.（php.net文档有误）.
         *
         * @return Application
         * @param null|mixed $bootstrap
         */
        public function bootstrap($bootstrap = null)
        {
        }
        /**
         * 获取全局配置实例,即$this->config
         *
         * @return Config_Abstract
         */
        public function getConfig()
        {
        }
        /**
         * 获取在配置文件中声明的模块，如果没有声明，它的默认值将是"Index".
         *
         * @return String
         */
        public function getModules()
        {
        }
        /**
         * 获取当前请求的分发器Dispatcher的实例
         *
         * @return Dispatcher
         */
        public function getDispatcher()
        {
        }
        /**
         * 设置应用的主目录
         *
         * @param String $directory 目录路径.
         *
         * @return Application
         */
        public function setAppDirectory($directory)
        {
        }
        /**
         * 获取当前应用的主目录
         *
         * @return String
         */
        public function getAppDirectory()
        {
        }
        /**
         * 获取最近产生的错误代码.
         *
         * @return Int
         */
        public function getLastErrorNo()
        {
        }
        /**
         * 获取最近产生的错误信息.
         *
         * @return String
         */
        public function getLastErrorMsg()
        {
        }
        /**
         * 清除最近的错误信息，将设置$this->_err_no=0,$this->_err_msg=''.
         *
         * @return Application
         */
        public function clearLastError()
        {
        }
    }
    /**
     * Class Bootstrap_Abstract
     *
     * Bootstrap是用来在Application运行(run)之前做一些初始化工作的机制.
     * 你可以通过继承Bootstrap_Abstract来定义自己的Bootstrap类.
     * 在Bootstrap类中所有以"_init"开头的公有的方法, 都会被按照定义顺序依次在Application::bootstrap()被调用的时刻调用.
     *
     * @package Yaf
     */
    abstract class Bootstrap_Abstract
    {
    }

    /**
     * Class Dispatcher
     *
     * Dispatcher实现了MVC中的C分发，它由Application负责初始化，然后由Application::run启动，它协调路由来的请求，并分发和执行发现的动作.
     * 并收集动作产生的响应，输出响应给请求者，并在整个过程完成以后返回响应.
     *
     * @package Yaf
     */
    final class Dispatcher
    {
        /**
         * 当前请求对象（包含请求的所有信息）.
         *
         * PHP代码可以这样获取：
         * $request = Dispatcher::getInstance()->getRequest();
         *
         * @var Request_Abstract
         */
        protected $_request;
        /**
         * 视图对象.
         *
         * PHP代码可以这样设置并初始化视图对象：
         * Dispatcher::getInstance()->setView($view);
         * Dispatcher::getInstance()->initView($template_dir, $option);
         *
         * @var View_Interface
         */
        protected $_view;
        /**
         * 路由器对象.
         *
         * PHP代码可以这样获取：
         * $router = Dispatcher::getInstance()->getRouter();
         *
         * @var Router
         */
        protected $_router;
        /**
         * Dispatcher实现了单例模式，此属性保存当前实例.
         *
         * PHP代码可以这样获取：
         * $dispatcher = Dispatcher::getInstance();
         *
         * @var Dispatcher
         */
        protected static $_instance;
        /**
         * 自动渲染功能开关，默认1.
         * 自动渲染是指根据当前请求的控制器Controller和动作Action自动寻找模块文件，加载与渲染模块，之后返回结果或者输出.
         * 如果设置为0，$this->_instantly_flush，$this->_return_response的设置将无效，也即：
         * Dispatcher::getInstance()->flushInstantly($flag);
         * Dispatcher::getInstance()->returnResponse($flag);
         * 设置无效，并且不会渲染模板.
         *
         * PHP代码可以这样设置：
         * Dispatcher::getInstance()->autoRender($flag);
         *
         * @var Boolean
         */
        protected $_auto_render;
        /**
         * 返回包含请求正文的响应对象开关，默认为0.
         * 默认情况下，Yaf的自动渲染查找并渲染模板（render，并非display），渲染结果写入Yaf\Response_Abstract实例的_body属性，
         * 在分发器结束分发之后，输出_body（数组遍历输出）属性的值，并清空_body.
         * 设置此属性为1，分发器结束分发之后，不会输出和清空_body，可以通过Yaf\Application的run()，Yaf\Dispatcher的方法dispatch()，
         * 或者Yaf\Controller_Abstract的getResponse()等方法的调用返回响应对象，
         * 进而调用Yaf\Response_Abstract实例的getBody()方法获取响应正文.此属性依赖$this->_auto_render的设置，
         * 当$this->_auto_render=1时，响应正文包括渲染模板的结果，反之则不包括.
         *
         * PHP代码可以这样设置：
         * Dispatcher::getInstance()->returnResponse($flag);
         *
         * @var Boolean
         */
        protected $_return_response;
        /**
         * 立即输出响应正文开头，默认为0.
         * 默认情况下，Yaf自动渲染调用Yaf\Controller_Abstract的render方法，渲染模板.
         * 当此属性设置为1时，Yaf调用Yaf\Controller_Abstract的display方法，直接渲染并输出，但不设置Yaf\Response_Abstract实例的_body属性.
         *
         * PHP代码可以这样设置：
         * Dispatcher::getInstance()->flushInstantly($flag);
         *
         * @var Boolean
         */
        protected $_instantly_flush;
        /**
         * 默认模块名
         *
         * PHP代码可以这样设置：
         * Dispatcher::getInstance()->setDefaultModule($module);
         *
         * @var String
         */
        protected $_default_module;
        /**
         * 默认控制器
         *
         * PHP代码可以这样设置：
         * Dispatcher::getInstance()->setDefaultController($controller);
         *
         * @var String
         */
        protected $_default_controller;
        /**
         * 默认动作名
         *
         * PHP代码可以这样设置：
         * Dispatcher::getInstance()->setDefaultAction($action);
         *
         * @var String
         */
        protected $_default_action;
        /**
         * 已注册的插件对象
         *
         * PHP代码可以这样注册插件：
         * Dispatcher::getInstance()::registerPlugin(new ModuleInitPlugin());
         *
         * @var array
         */
        protected $_plugins;
        /**
         * 重置__construct魔术方法.
         */
        private function __construct()
        {
        }
        /**
         * 重置__clone魔术方法，防止克隆Dispatcher（因为是单例模式）.
         *
         * @return void
         */
        private function __clone()
        {
        }
        /**
         * 重置__sleep魔术方法.
         *
         * @return void
         */
        private function __sleep()
        {
        }
        /**
         * 重置__wakeup魔术方法.
         *
         * @return void
         */
        private function __wakeup()
        {
        }

        /**
         * 关闭自动渲染模板
         *
         * @return Dispatcher
         */
        public function disableView()
        {
        }
        /**
         * 开启自动渲染模板
         *
         * @return Dispatcher
         */
        public function enableView()
        {
        }
        /**
         * 初始化视图对象
         *
         * @param string $tpl_dir 模板目录
         * @param mixed $options 全局的模板选项（配置相关）
         *
         * @return View_Interface
         */
        public function initView($tpl_dir, $options = null)
        {
        }
        /**
         * 设置视图对象
         *
         * @param View_Interface $view 视图对象实例
         *
         * @return View_Interface
         */
        public function setView(View_Interface $view)
        {
        }
        /**
         * 设置请求对象（在命令行或者其他API模式下构造请求很有用）
         *
         * @param Request_Abstract $request 手动实例化的请求对象
         *
         * @return Dispatcher
         */
        public function setRequest(Request_Abstract $request)
        {
        }
        /**
         * 返回应用实例
         *
         * @return Application
         */
        public function getApplication()
        {
        }
        /**
         * 返回路由器实例
         *
         * @return Router
         */
        public function getRouter()
        {
        }
        /**
         * 返回请求对象实例
         *
         * @return Request_Abstract
         */
        public function getRequest()
        {
        }
        /**
         * 设置一个用户定义的错误处理函数（封装了PHP内置的set_error_handler函数）
         *
         * @param callable $callback PHP中可回调的结构
         * @param $error_type int 处理的错误类型（默认：E_ALL | E_STRICT）
         *
         * @return Dispatcher
         */
        public function setErrorHandler(callable $callback, $error_type = 32767)
        {
        }
        /**
         * 设置默认模块
         *
         * @param string $module 模块名
         *
         * @return Dispatcher
         */
        public function setDefaultModule($module)
        {
        }
        /**
         * 设置默认的控制器
         *
         * @param string $controller 控制器名
         *
         * @return Dispatcher
         */
        public function setDefaultController($controller)
        {
        }
        /**
         * 设置默认的动作名
         *
         * @param string $action
         *
         * @return Dispatcher
         */
        public function setDefaultAction($action)
        {
        }
        /**
         * 设置或者返回$this->_return_response属性的值
         * 当传递$flag参数时，设置$this->_return_response=$flag，并返回Dispatcher
         * 当不传递任何参数时，返回$this->_return_response当前值
         *
         * @param boolean $flag
         *
         * @return mixed
         */
        public function returnResponse($flag)
        {
        }
        /**
         * 设置或者返回$this->_auto_render属性的值
         * 当传递$flag参数时，设置$this->_auto_render=$flag，并返回Dispatcher
         * 当不传递任何参数时，返回$this->_auto_render属性的值
         *
         * @param boolean $flag
         *
         * @return mixed
         */
        public function autoRender($flag)
        {
        }
        /**
         * 设置或者返回$this->_instantly_flush属性的值
         * 当传递$flag参数时，设置$this->_instantly_flush=$flag，并返回Dispatcher
         * 当不传递任何参数时，返回$this->_instantly_flush属性的值
         *
         * @param boolean $flag
         *
         * @return mixed
         */
        public function flushInstantly($flag)
        {
        }
        /**
         * 返回当前Dispatcher实例（单例模式）
         *
         * @return Dispatcher
         */
        public static function getInstance()
        {
        }
        /**
         * 手动分发请求
         *
         * @param Request_Abstract $request 分发的请求对象
         *
         * @return Response_Abstract
         */
        public function dispatch(Request_Abstract $request)
        {
        }
        /**
         * 开启/关闭异常抛出或返回当前状态
         *
         * 当传递$flag参数时，设置抛出异常，并返回Dispatcher
         * 当不传递任何参数时，返回抛出异常状态
         *
         * @param boolean $flag
         *
         * @return mixed
         */
        public function throwException($flag)
        {
        }
        /**
         * 开启/关闭自动异常捕获功能或返回当前状态
         *
         * 当传递$flag参数时，设置自动异常捕获，并返回Dispatcher
         * 当不传递任何参数时，返回当前状态
         *
         * 注意：如果开启了Yaf\Dispatcher::catchException() （可以通过设置application.dispatcher.catchException来开启），
         * 并且在你定义了异常处理的controller的情况下，Yaf会将所有未捕获的异常交给Error Controller的Error Action来处理.
         *
         * @param boolean $flag
         *
         * @return mixed
         */
        public function catchException($flag)
        {
        }
        /**
         * 注册插件
         *
         * @param Plugin_Abstract $plugin 实例化的插件对象
         *
         * @return Dispatcher
         */
        public function registerPlugin(Plugin_Abstract $plugin)
        {
        }
    }

    /**
     * Class Loader
     *
     * Loader类为Yaf提供了自动加载功能，它根据类名中包含的路径信息实现类的定位和自动加载.
     *
     * @package Yaf
     */
    final class Loader
    {
        /**
         * 当前应用本地类库目录
         *
         * PHP可以这样获取：
         * $library = Loader::getInstance()->getLibraryPath();
         *
         * @var String
         */
        protected $_library;
        /**
         * 全局类库目录
         *
         * PHP可以这样获取：
         * $global_library = Loader::getInstance()->getLibraryPath(true);
         *
         * @var String
         */
        protected $_global_library;
        /**
         * 当前Loader实例（单例模式）
         *
         * @var Loader
         */
        protected static $_instance;
        /**
         * 重置__construct魔术方法.
         */
        private function __construct()
        {
        }
        /**
         * 重置__destruct魔术方法.
         *
         * @return void
         */
        public function __destruct()
        {
        }
        /**
         * 重置__clone魔术方法，防止克隆Yaf_Loader（因为是单例模式）.
         *
         * @return void
         */
        private function __clone()
        {
        }
        /**
         * 重置__sleep魔术方法.
         *
         * @return void
         */
        private function __sleep()
        {
        }
        /**
         * 重置__wakeup魔术方法.
         *
         * @return void
         */
        private function __wakeup()
        {
        }
        /**
         * 自动装载类
         *
         * @param $class string 类名
         *
         * @return Boolean
         */
        public function autoload($class)
        {
        }
        /**
         * 获取Loader实例
         *
         * @param string $library 本地类库目录
         * @param string $global 全局类库目录
         *
         * @return Loader
         */
        public static function getInstance($library = null, $global = null)
        {
        }
        /**
         * 注册本地类前缀
         *
         * @param mixed $namespace 一个或者多个类前缀
         *
         * @return Boolean
         */
        public function registerLocalNamespace($namespace)
        {
        }
        /**
         * 获取当前已经注册的本地类前缀
         *
         * @return String
         */
        public function getLocalNamespace()
        {
        }
        /**
         * 清空已注册的本地类前缀
         *
         * @return void
         */
        public function clearLocalNamespace()
        {
        }
        /**
         * 判断一个类, 是否是本地类.
         *
         * @param $class_name string 类名
         *
         * @return Boolean
         */
        public function isLocalName($class_name)
        {
        }
        /**
         * 手动导入文件
         *
         * @param $file string include的全路径文件名
         *
         * @return Boolean
         */
        public static function import($file)
        {
        }
        /**
         * 设置本地或者全局类库目录
         *
         * @param string $library 目录路径
         * @param boolean $global 是否为全局类库
         *
         * @return Boolean
         */
        public function setLibraryPath($library, $global = false)
        {
        }
        /**
         * 获取本地或者全局类库目录
         *
         * @param boolean $global
         *
         * @return String
         */
        public function getLibraryPath($global = false)
        {
        }
    }

    /**
     * Class Request_Abstract
     *
     * 代表了一个实际请求，一般的不用自己实例化它，Application在run以后会自动根据当前请求实例它.
     *
     * @package Yaf
     */
    abstract class Request_Abstract
    {
        const SCHEME_HTTP = 'http';
        const SCHEME_HTTPS = 'https';

        /**
         * 当前请求的模块名
         *
         * PHP也可以这样获取：
         * $this->getModuleName();
         *
         * @var String
         */
        public $module;
        /**
         * 当前请求的控制器名
         *
         * PHP也可以这样获取：
         * $this->getControllerName();
         *
         * @var String
         */
        public $controller;
        /**
         * 当前请求的动作名
         *
         * PHP也可以这样获取：
         * $this->getActionName();
         *
         * @var String
         */
        public $action;
        /**
         * 当前请求的方法 getMethod
         *
         * PHP也可以这样获取：
         * $this->getMethod();
         *
         * @var String
         */
        public $method;
        /**
         * (Yaf >= 2.2.9)
         * 请求传递的参数
         *
         * PHP可以这样获取：
         * $this->getParams();
         *
         * @var array
         */
        protected $params;
        /**
         * http报头中HTTP_ACCEPT_LANGUAGE的值
         *
         * PHP可以这样获取：
         * $this->getLanguage();
         *
         * @var String
         */
        protected $language;
        /**
         * 异常对象
         *
         * 异常捕获模式下，在异常发生的情况时流程进入Error控制器的error动作时，获取当前发生的异常对象.
         * PHP可以这样获取：
         * $this->getException();
         *
         * @var \Exception
         */
        protected $_exception;
        /**
         * 请求的Base URI（http请求 or cli模式下）
         *
         * PHP可以这样获取：
         * $this->getBaseUri();
         *
         * @var String
         */
        protected $_base_uri;
        /**
         * 请求的URI（http请求）
         *
         * PHP可以这样获取：
         * $this->getRequestUri();
         *
         * @var String
         */
        protected $uri;
        /**
         * 请求是否完成了分发，默认为0
         *
         * @var Boolean
         */
        protected $dispatched;
        /**
         * 请求是否完成了路由，默认为0
         *
         * @var Boolean
         */
        protected $routed;

        /**
         * 判断是否为GET请求
         *
         * @return Boolean
         */
        public function isGet()
        {
        }
        /**
         * 判断是否为POST请求
         *
         * @return Boolean
         */
        public function isPost()
        {
        }
        /**
         * 判断是否为PUT请求
         *
         * @return Boolean
         */
        public function isPut()
        {
        }
        /**
         * 判断是否为HEAD请求
         *
         * @return Boolean
         */
        public function isHead()
        {
        }
        /**
         * 判断是否为Options请求
         *
         * @return Boolean
         */
        public function isOptions()
        {
        }
        /**
         * 判断是否为CLI请求
         *
         * @return Boolean
         */
        public function isCli()
        {
        }
        /**
         * 判断是否为AJAX请求
         *
         * @return Boolean
         */
        public function isXmlHttpRequest()
        {
        }
        /**
         * 获取服务器$_SERVER全局变量中的值
         *
         * @param string $name 变量名
         * @param mixed $default 默认值
         *
         * @return mixed
         */
        public function getServer($name, $default = null)
        {
        }
        /**
         * 获取环境变量$_ENV全局变量中的值
         *
         * @param string $name 变量名
         * @param string $default 默认值
         *
         * @return mixed
         */
        public function getEnv($name, $default = null)
        {
        }
        /**
         * 设置请求的参数
         * 当只有一个参数且为Array类型，如果存在对应的键值将覆盖
         *
         * @param string $name 变量名
         * @param mixed $value 变量值
         *
         * @return Boolean
         */
        public function setParam($name, $value)
        {
        }
        /**
         * 获取请求的参数
         *
         * @param string $name 变量名
         * @param string $default 默认值
         *
         * @return mixed
         */
        public function getParam($name, $default = null)
        {
        }
        /**
         * 获取请求全部的参数
         *
         * @return array
         */
        public function getParams()
        {
        }
        /**
         * 获取异常对象
         *
         * 异常捕获模式下，在异常发生的情况时流程进入Error控制器的error动作时，获取当前发生的异常对象.
         *
         * @return \Exception
         */
        public function getException()
        {
        }
        /**
         * 获取当前模块名
         *
         * @return String
         */
        public function getModuleName()
        {
        }
        /**
         * 获取当前控制器名
         *
         * @return String
         */
        public function getControllerName()
        {
        }
        /**
         * 获取当前动作名
         *
         * @return String
         */
        public function getActionName()
        {
        }
        /**
         * 设置请求的模块名
         *
         * @param string $name 模块名
         *
         * @return Boolean
         */
        public function setModuleName($name)
        {
        }
        /**
         * 设置请求的控制器名
         *
         * @param string $name
         *
         * @return Boolean
         */
        public function setControllerName($name)
        {
        }
        /**
         * 设置请求的动作名
         *
         * @param string $name
         *
         * @return Boolean
         */
        public function setActionName($name)
        {
        }
        /**
         * 获取当前请求的方法
         *
         * @return String
         */
        public function getMethod()
        {
        }
        /**
         * 获取当前请求的请求
         *
         * @return String
         */
        public function getLanguage()
        {
        }
        /**
         * 设置请求的Base URI
         *
         * @param string $baseuri
         *
         * @return Request_Abstract
         */
        public function setBaseUri($baseuri)
        {
        }
        /**
         * 获取请求的Base URI
         *
         * @return String
         */
        public function getBaseUri()
        {
        }
        /**
         * 获取请求的uri
         *
         * @return String
         */
        public function getRequestUri()
        {
        }
        /**
         * 设置请求的URI
         *
         * @param string $uri
         *
         * @return Request_Abstract
         */
        public function setRequestUri($uri)
        {
        }
        /**
         * 判断请求是否完成了分发
         *
         * @return Boolean
         */
        public function isDispatched()
        {
        }
        /**
         * 设置请求已经完成分发
         *
         * @return Boolean
         */
        public function setDispatched()
        {
        }
        /**
         * 判断请求是否完成了路由
         *
         * @return Boolean
         */
        public function isRouted()
        {
        }
        /**
         * 设置请求已经完成了路由
         *
         * @return Request_Abstract
         */
        public function setRouted()
        {
        }
    }

    /**
     * Class Response_Abstract
     *
     * 响应对象和请求对象相对应, 是发送给请求端的响应的载体
     *
     * @package Yaf
     */
    abstract class Response_Abstract
    {
        const DEFAULT_BODY = 'content';

        /**
         * 响应报头
         *
         * @var array
         */
        protected $_header;
        /**
         * 响应正文
         *
         * @var array
         */
        protected $_body;
        /**
         * 是否开启已输出响应报头检测
         *
         * @var Int
         */
        protected $_sendheader = 0;
        /**
         * 构造方法
         */
        public function __construct()
        {
        }
        /**
         * 析构方法
         */
        public function __destruct()
        {
        }
        /**
         * 重置__clone魔术方法
         *
         * @return void
         */
        private function __clone()
        {
        }
        /**
         * 返回响应正文的字符串
         *
         * @return String
         */
        public function __toString()
        {
        }
        /**
         * 设置类型为$name的响应正文内容
         *
         * @param string $body 响应正文内容（可覆盖原来的）
         * @param string $name 响应正文类型，默认为content
         *
         * @return Boolean
         */
        public function setBody($body, $name = 'content')
        {
        }
        /**
         * 获取类型为$name的响应正文内容
         *
         * @param string $name 响应正文类型，默认为content
         *
         * @return String
         */
        public function getBody($name = 'content')
        {
        }
        /**
         * 设置类型为$name的响应正文内容, 如已存在，则追加到原来正文的后面
         *
         * @param string $body 响应正文内容（可追加）
         * @param string $name 响应正文类型，默认为content
         *
         * @return Boolean
         */
        public function appendBody($body, $name = 'content')
        {
        }
        /**
         * 设置类型为$name的响应正文内容, 如已存在，则追加到原来正文的前面
         *
         * @param string $body 响应正文内容（可追加）
         * @param string $name 响应正文类型，默认为content
         *
         * @return Boolean
         */
        public function prependBody($body, $name = 'content')
        {
        }
        /**
         * 清空响应正文
         *
         * @deprecated 总是返回false
         *
         * @return Boolean
         */
        public function clearBody()
        {
        }
        /**
         * 将当前请求重定向到指定的URL（内部实现是通过发送Location报头实现，如：header("Location:http//www.phpboy.net/"））
         *
         * @param string $url 重定向的绝对URL
         *
         * @return Boolean
         */
        public function setRedirect($url)
        {
        }
        /**
         * 输出所有的响应正文
         *
         * @return Boolean
         */
        public function response()
        {
        }
    }

    /**
     * Class Config_Abstract
     *
     * Config_Abstract被设计在应用程序中简化访问和使用配置数据.它为在应用程序代码中访问这样的配置数据提供了一个基于用户接口的嵌入式对象属性.
     * 配置数据可能来自于各种支持等级结构数据存储的媒体.Config_Abstract实现了Countable，ArrayAccess和Iterator接口.
     * 这样，可以基于Config_Abstract对象使用count()函数和PHP语句如foreach，也可以通过数组方式访问Config_Abstract的元素.
     *
     * @package Yaf
     */
    abstract class Config_Abstract implements \Iterator, \Countable, \ArrayAccess
    {
        /**
         * 存储已解析的配置
         *
         * PHP代码可以这样获取：
         * $config = Application::app()->getConfig()->toArray();
         *
         * @var array
         */
        protected $_config;
        /**
         * 配置是否只读，默认为1.
         *
         * @var Boolean
         */
        protected $_readonly = '1';
        /**
         * 获取配置节点的值
         * 当不传递$name参数时，返回配置对象本身
         *
         * @param string $name
         * @return Config_Abstract
         */
        abstract public function get($name);
        /**
         * 设置配置节点的值
         *
         * @param string $name
         * @param mixed $value
         * @return boolean
         */
        abstract public function set($name, $value);
        /**
         * 返回配置只读的状态
         *
         * @return boolean
         */
        abstract public function readonly();
        /**
         * 将配置转换为数组
         *
         * @return array
         */
        abstract public function toArray();
    }

    /**
     * Class Controller_Abstract
     *
     * Controller_Abstract是Yaf的MVC体系的核心部分.
     * MVC是指Model-View-Controller，是一个用于分离应用逻辑和表现逻辑的设计模式.
     * Controller_Abstract体系具有可扩展性，可以通过继承已有的类，来实现这个抽象类，从而添加应用自己的应用逻辑.
     * 对于Controller来说, 真正的执行体是在Controller中定义的一个一个的动作, 当然这些动作也可以定义在Controller外.
     *
     * @package Yaf
     */
    abstract class Controller_Abstract
    {
        /**
         * 动作名与动作类文件路径映射数组
         *
         * 如：
         * public $actions = array(
         *      'user' => "actions/article/index/User.php",
         * );
         *
         * 备注：有些时候为了拆分比较大的Controller, 使得代码更加清晰和易于管理, Yaf支持将具体的动作分开定义.
         * 每个动作都需要实现Yaf\Action_Abstract就可以通过定义Yaf\Controller_Abstract::$actions来指明
         * 那些动作对应于具体的那些分离的类.
         *
         * @var array
         */
        public $actions;
        /**
         * 当前请求的模块名
         *
         * PHP代码中也可以这样获取：
         * $module = $this->getModuleName();
         *
         * @var String
         */
        protected $_module;
        /**
         * 当前请求的控制器名
         *
         * @var String
         */
        protected $_name;
        /**
         * 当前请求对象，包括请求的所有相关信息
         *
         * PHP代码中可以这样获取：
         * $request = $this->getRequest();
         *
         * @var Request_Abstract
         */
        protected $_request;
        /**
         * 当前响应对象，保存响应的所有相关信息
         *
         * PHP代码中也可以这样获取：
         * $response = $this->getResponse();
         *
         * @var Response_Abstract
         */
        protected $_response;
        /**
         * 储存调用参数
         *
         * PHP代码中可以这样获取：
         * $args = $this->getInvokeArgs();
         *
         * @var array
         */
        protected $_invoke_args;
        /**
         * 视图对象
         *
         * PHP代码中也可以这样获取：
         * $view = $this->getView();
         *
         * @var View_Interface
         */
        protected $_view;
        /**
         * 屏蔽构造方法
         */
        final private function __construct()
        {
        }
        /**
         * 屏蔽克隆的魔术方法
         */
        final private function __clone()
        {
        }
        /**
         * 获取请求对象
         *
         * @return Request_Abstract
         */
        public function getRequest()
        {
        }
        /**
         * 获取响应对象
         *
         * @return Response_Abstract
         */
        public function getResponse()
        {
        }
        /**
         * 获取当前模块名
         *
         * @return String
         */
        public function getModuleName()
        {
        }
        /**
         * 初始化视图对象
         *
         * @deprecated 一直不可用，调用此方法只会返回Controller_Abstract的实例
         *
         * @return Controller_Abstract
         */
        public function initView()
        {
        }
        /**
         * 返回视图对象
         *
         * @return \Yaf\View_Interface
         */
        public function getView()
        {
        }
        /**
         * 设置模板文件目录
         *
         * @param string $path
         *
         * @return Boolean
         */
        public function setViewPath($path)
        {
        }
        /**
         * 获取模板文件目录
         *
         * @return String
         */
        public function getViewPath()
        {
        }
        /**
         * 将当前的请求转交给另外的Action（对用户来说是透明的，相当于Web服务器的代理）.
         *
         * 调用Yaf\Controller_Abstract::forward()以后，不会直接立即跳转到目的Action执行，
         * 而是会在当前的Action执行完成后，下一轮的DispatchLoop中，交给目的Action.
         * 所以, 如果你希望立即跳转到目的Action, 那么请使用return结束当前的执行流程.
         *
         * @param string $module
         * @param string $controller
         * @param string $action
         * @param string $parameters
         *
         * @return Boolean
         */
        public function forward($module, $controller = null, $action = null, $parameters = null)
        {
        }
        /**
         * 将当前请求重定向到指定的URL（内部实现是通过发送Location报头实现，如：header("Location:http//www.phpboy.net/"））
         *
         * @param string $url
         *
         * @return Boolean
         */
        public function redirect($url)
        {
        }
        /**
         * 获取全部调用参数
         *
         * @return array
         */
        public function getInvokeArgs()
        {
        }
        /**
         * 获取指定调用参数名的值
         *
         * @param string $name
         *
         * @return mixed
         */
        public function getInvokeArg($name)
        {
        }

        /**
         * 渲染动作对应的模板，并返回结果
         *
         * @param string $action_name 动作名
         * @param array $var_array 传递到视图对象的参数
         *
         * @return String
         */
        protected function render($action_name, $var_array = [])
        {
        }
        /**
         * 渲染动作对应的模板，并直接输出结果
         *
         * @param string $action_name 动作名
         * @param array $var_array 传递到视图对象的参数
         *
         * @return String
         */
        protected function display($action_name, $var_array = [])
        {
        }
    }

    /**
     * Class Action_Abstract
     *
     * Action_Abstract是MVC中C的动作，一般而言动作都是定义在Controller_Abstract的派生类中的.
     * 但是有的时候，为了使得代码清晰，分离一些大的控制器，则可以采用单独定义Action_Abstract来实现.
     *
     * @package Yaf
     */
    abstract class Action_Abstract extends \Yaf\Controller_Abstract
    {
        /**
         * 当前请求的控制器实例
         *
         * @var Controller_Abstract
         */
        protected $_controller;
        /**
         * 获取当前请求的控制器实例
         *
         * @return Controller_Abstract
         */
        public function getController()
        {
        }
        /**
         * 动作入口方法，由Yaf框架自动调用
         *
         * @return mixed
         */
        abstract public function execute();
    }

    /**
     * Interface View_Interface
     *
     * View_Interface是为了提供可扩展的，可自定的视图引擎而设立的视图引擎接口，它定义了用在Yaf上的视图引擎需要实现的方法和功能.
     *
     * @package Yaf
     */
    interface View_Interface
    {
        /**
         * 传递变量到模板
         *
         * 当只有一个参数时，参数必须是Array类型，可以展开多个模板变量
         *
         * @param string | array $name 变量
         * @param string $value 变量值
         *
         * @return Boolean
         */
        public function assign($name, $value = null);
        /**
         * 渲染模板并直接输出
         *
         * @param string $tpl 模板文件名
         * @param array $var_array 模板变量
         *
         * @return Boolean
         */
        public function display($tpl, $var_array = []);
        /**
         * 渲染模板并返回结果
         *
         * @param string $tpl 模板文件名
         * @param array $var_array 模板变量
         *
         * @return String
         */
        public function render($tpl, $var_array = []);
        /**
         * 设置模板文件目录
         *
         * @param string $tpl_dir 模板文件目录路径
         *
         * @return Boolean
         */
        public function setScriptPath($tpl_dir);
        /**
         * 获取模板目录文件
         *
         * @return String
         */
        public function getScriptPath();
    }

    /**
     * Class Plugin_Abstract
     *
     * Plugin_Abstract是Yaf的插件基类，所有应用在Yaf的插件都需要继承实现这个类，这个类定义了7个方法，依次在7个时机的时候被调用.
     *
     * @package Yaf
     */
    abstract class Plugin_Abstract
    {
        /**
         * 在路由之前触发
         *
         * @param Request_Abstract $request 当前请求对象
         * @param Response_Abstract $response 当前响应对象
         *
         * @return mixed
         */
        public function routerStartup(Request_Abstract $request, Response_Abstract $response)
        {
        }
        /**
         * 路由结束之后触发
         *
         * @param Request_Abstract $request 当前请求对象
         * @param Response_Abstract $response 当前响应对象
         *
         * @return mixed
         */
        public function routerShutdown(Request_Abstract $request, Response_Abstract $response)
        {
        }
        /**
         * 分发循环开始之前被触发
         *
         * @param Request_Abstract $request 当前请求对象
         * @param Response_Abstract $response 当前响应对象
         *
         * @return mixed
         */
        public function dispatchLoopStartup(Request_Abstract $request, Response_Abstract $response)
        {
        }
        /**
         * 分发之前触发
         *
         * @param Request_Abstract $request 当前请求对象
         * @param Response_Abstract $response 当前响应对象
         *
         * @return mixed
         */
        public function preDispatch(Request_Abstract $request, Response_Abstract $response)
        {
        }
        /**
         * 分发结束之后触发
         *
         * @param Request_Abstract $request 当前请求对象
         * @param Response_Abstract $response 当前响应对象
         *
         * @return mixed
         */
        public function postDispatch(Request_Abstract $request, Response_Abstract $response)
        {
        }
        /**
         * dispatchLoopShutdown
         *
         * @param Request_Abstract $request 当前请求对象
         * @param Response_Abstract $response 当前响应对象
         *
         * @return mixed
         */
        public function dispatchLoopShutdown(Request_Abstract $request, Response_Abstract $response)
        {
        }
        /**
         * 响应之前触发
         *
         * @param Request_Abstract $request 当前请求对象
         * @param Response_Abstract $response 当前响应对象
         *
         * @return mixed
         */
        public function preResponse(Request_Abstract $request, Response_Abstract $response)
        {
        }
    }

    /**
     * Class Registry
     *
     * 对象注册表(或称对象仓库)是一个用于在整个应用空间(application space)内存储对象和值的容器.
     * 通过把对象存储在其中，我们可以在整个项目的任何地方使用同一个对象，这种机制相当于一种全局存储.
     * 我们可以通过Registry类的静态方法来使用对象注册表.
     * 另外，由于该类是一个数组对象，你可以使用数组形式来访问其中的类方法.
     *
     * @package Yaf
     */
    final class Registry
    {
        /**
         * Registry实例（单例模式）
         *
         * @var Registry
         */
        protected static $_instance;
        /**
         * 注册变量栈
         *
         * @var array
         */
        protected $_entries;
        /**
         * 重置__construct魔术方法.
         */
        private function __construct()
        {
        }
        /**
         * 重置__clone魔术方法，防止克隆Dispatcher（因为是单例模式）.
         *
         * @return void
         */
        private function __clone()
        {
        }
        /**
         * 获取注册变量值
         *
         * @param string $name 变量名
         *
         * @return mixed
         */
        public static function get($name)
        {
        }
        /**
         * 检测变量是否存在
         *
         * @param string $name 变量名
         *
         * @return Boolean
         */
        public static function has($name)
        {
        }
        /**
         * 注册变量
         *
         * @param string $name 变量名
         * @param mixed $value 变量值
         *
         * @return Boolean
         */
        public static function set($name, $value)
        {
        }
        /**
         * 删除变量
         *
         * @param string $name
         *
         * @return Boolean
         */
        public static function del($name)
        {
        }
    }

    /**
     * Interface Route_Interface
     *
     * Route_Interface是Yaf路由协议的标准接口, 它的存在使得用户可以自定义路由协议
     *
     * @package Yaf
     */
    interface Route_Interface
    {
        /**
         * 路由请求
         *
         * @param Request_Abstract $request
         *
         * @return Boolean
         */
        public function route($request);
        /**
         * 组合uri，路由解析的逆操作
         *
         * @param array $info
         * @param mixed $query
         * @return String
         */
        public function assemble(array $info, array $query = null);
    }

    /**
     * Class Route_Static
     *
     * 默认路由协议
     *
     * @package Yaf
     */
    class Route_Static implements Route_Interface
    {
        /**
         * 匹配请求
         *
         * @deprecated 始终返回true
         *
         * @return Boolean
         */
        public function match()
        {
        }
        /**
         * 路由请求
         *
         * @param Request_Abstract $request
         *
         * @return Boolean
         */
        public function route($request)
        {
        }
        /**
         * 组合uri，路由解析的逆操作
         *
         * @param array $info
         * @param mixed $query
         * @return String
         */
        public function assemble(array $info, array $query = null)
        {
        }
    }

    /**
     * Class Router
     *
     * Router是标准的框架路由.
     * 路由是一个拿到URI端点（URL中的URI的一部分）然后分解参数得到哪一个module，controller，和action需要接受请求.
     *
     * @package Yaf
     */
    final class Router
    {
        /**
         * 路由器已有的路由协议栈, 默认的栈底总是名为"default"的Route_Static路由协议的实例
         *
         * @var array
         */
        protected $_routes;
        /**
         * 在路由成功后, 路由生效的路由协议实例的索引
         *
         * @var String
         */
        protected $_current;
        /**
         * 构造方法
         */
        public function __construct()
        {
        }
        /**
         * 往Router中添加新的路由
         *
         * @param string $name
         * @param Route_Interface $route
         *
         * @return Router
         */
        public function addRoute($name, Route_Interface $route)
        {
        }
        /**
         * 向Router中添加配置文件或者配置数组定义的路由
         *
         * @param $config array | Config_Abstract
         *
         * @return Router
         */
        public function addConfig($config)
        {
        }
        /**
         * 路由请求
         *
         * @param Request_Abstract $request
         *
         * @return Boolean
         */
        public function route(Request_Abstract $request)
        {
        }
        /**
         * 获取路由名对应的路由协议实例
         *
         * @param string $name 路由名
         *
         * @return Route_Interface
         */
        public function getRoute($name)
        {
        }
        /**
         * 获取已注册的所有路由协议
         *
         * @return array
         */
        public function getRoutes()
        {
        }
        /**
         * 获取当前路由成功的路由协议实例
         *
         * @return Route_Interface
         */
        public function getCurrentRoute()
        {
        }
    }

    /**
     * Class Session
     *
     * 会话管理类
     *
     * @package Yaf
     */
    final class Session implements \Iterator, \ArrayAccess, \Countable
    {
        /**
         * 单例对象
         * @var Session
         */
        protected static $_instance = null;
        /**
         * 数据数组
         * @var array
         */
        protected $_session = null;
        /**
         * 数据数组开始下标
         * @var int
         */
        protected $_started = 0;

        /**
         * 重置__construct魔术方法.
         */
        private function __construct()
        {
        }
        /**
         * (Yaf >= 2.2.9)
         * 重置__destruct魔术方法.
         *
         * @return void
         */
        public function __destruct()
        {
        }
        /**
         * 重置__clone魔术方法（因为是单例模式）.
         *
         * @return void
         */
        private function __clone()
        {
        }
        /**
         * 重置__sleep魔术方法.
         *
         * @return void
         */
        private function __sleep()
        {
        }
        /**
         * 重置__wakeup魔术方法.
         *
         * @return void
         */
        private function __wakeup()
        {
        }
        /**
         * 获取session变量值
         * 当不传递$name参数时，返回全部变量
         *
         * @param string $name
         * @return mixed
         */
        public function __get($name)
        {
        }
        /**
         * 设置session变量
         *
         * @param string $name 变量名
         * @param mixed $value 变量值
         *
         * @return Session
         */
        public function __set($name, $value)
        {
        }
        /**
         * 魔术方法，当isset()检测session变量存在时调用
         *
         * @param string $name 节点名称
         *
         * @return Boolean
         */
        public function __isset($name)
        {
        }
        /**
         * 魔术方法，当unset()检测session变量不存在时调用
         * @param string $name 变量名
         */
        public function __unset(string $name)
        {
        }
        /**
         * 获取Session实例（单例模式）
         *
         * @return Session
         */
        public static function getInstance()
        {
        }
        /**
         * 开启会话
         *
         * @return Session
         */
        public function start()
        {
        }
        /**
         * 获取session变量
         *
         * @param string $name 变量名
         *
         * @return mixed
         */
        public function get($name)
        {
        }
        /**
         * 设置session变量
         *
         * @param string $name 变量名
         * @param mixed $value 变量值
         *
         * @return Session
         */
        public function set($name, $value)
        {
        }
        /**
         * 撤消session变量
         *
         * @param string $name 变量名
         *
         * @return Session
         */
        public function del($name)
        {
        }

        /**
         * 是否存在session变量
         * @param $name
         */
        public function has($name)
        {
        }

        /**
         * 清空session
         */
        public function clear()
        {
        }
        /**
         * 返回session变量的数量
         *
         * @return Int
         */
        public function count()
        {
        }
        /**
         * 重置遍历位置
         *
         * @return void
         */
        public function rewind()
        {
        }
        /**
         * 返回当前变量
         *
         * @return mixed
         */
        public function current()
        {
        }
        /**
         * 向前移动到下一个元素
         *
         * @return void
         */
        public function next()
        {
        }
        /**
         * 判断是否可以继续遍历
         *
         * @return void
         */
        public function valid()
        {
        }
        /**
         * 返回当前配置节点的key
         *
         * @return mixed
         */
        public function key()
        {
        }
        /**
         * 撤消某个session变量
         *
         * @param string $name 变量名
         *
         * @return Session
         */
        public function offsetUnset($name)
        {
        }
        /**
         * 测试某个session变量是否存在
         *
         * @param mixed $name 变量名
         *
         * @return Boolean
         */
        public function offsetExists($name)
        {
        }
        /**
         * 获取session变量
         *
         * @param string $name 变量名
         *
         * @return Session
         */
        public function offsetGet($name)
        {
        }
        /**
         * 设置session变量
         *
         * @param string $name 变量名
         * @param mixed $value 变量值
         *
         * @return Session
         */
        public function offsetSet($name, $value)
        {
        }
    }

    /**
     * Class SyException
     *
     * Yaf异常基类
     *
     * @package Yaf
     */
    class Exception extends \Exception implements \Throwable
    {
        /**
         * 异常信息
         *
         * @var String
         */
        protected $message;
        /*
         * 异常状态码
         *
         * @var Int
         */
        protected $code;
        /**
         * 上一个异常对象
         *
         * @var Exception
         */
        protected $previous;
        protected $file = null;
        protected $line = null;

        public function __construct($message = null, $code = null, $previous = null)
        {
        }
        final private function __clone()
        {
        }
        public function __wakeup()
        {
        }
        public function __toString()
        {
        }
    }
}

namespace Yaf\Request {
    /**
     * Class Http
     *
     * 代表了一个实际的Http请求，一般的不用自己实例化它，Application在run以后会自动根据当前请求实例它.
     *
     * @package Yaf\Request
     */
    class Http extends \Yaf\Request_Abstract
    {
        /**
         * 构造方法
         *
         * @param string $request_uri Request URI（可选）
         * @param string $base_uri Base URI（可选）
         */
        public function __construct($request_uri = null, $base_uri = null)
        {
        }
        /**
         * 重置__clone魔术方法
         *
         * @return void
         */
        private function __clone()
        {
        }
        /**
         * 获取$_GET中名为$name的参数值
         *
         * @param string $name 变量名
         * @param string $default 默认值
         *
         * @return mixed
         */
        public function getQuery($name = null, $default = null)
        {
        }
        /**
         * 获取$_REQUEST中名为$name的参数值
         *
         * @param string $name 变量名
         *
         * @return mixed
         */
        public function getRequest($name = null)
        {
        }
        /**
         * 获取$_POST中名为$name的参数值
         *
         * @param string $name 变量名
         * @param string $default 默认值
         *
         * @return mixed
         */
        public function getPost($name = null, $default = null)
        {
        }
        /**
         * 获取$_COOKIE中名为$name的参数值
         *
         * @param string $name 变量名
         *
         * @return mixed
         */
        public function getCookie($name = null)
        {
        }
        /**
         * 获取$_FILES中名为$name的参数值
         *
         * @param string $name 变量名
         *
         * @return mixed
         */
        public function getFiles($name = null)
        {
        }
        /**
         * 获取全局变量中的值（扫描顺序为$_POST，$_GET，$_COOKIE，$_SERVER）
         *
         * @param string $name 变量名
         * @param mixed $default 默认值
         *
         * @return mixed
         */
        public function get($name, $default = null)
        {
        }

        public function getException()
        {
        }
    }

    /**
     * Class Simple
     *
     * 代表了一个实际的请求，一般的不用自己实例化它，Application在run以后会自动根据当前请求实例它.
     *
     * @package Yaf\Request
     */
    class Simple extends \Yaf\Request_Abstract
    {
        /**
         * 构造方法
         *
         * @param mixed | string $method 方法名
         * @param mixed | string $module 模块名
         * @param mixed | string $controller 控制器名
         * @param mixed | string $action 动作名
         * @param mixed | array $parameters 请求的参数
         */
        public function __construct($method = null, $module = null, $controller = null, $action = null, $parameters = null)
        {
        }
        /**
         * 重置__clone魔术方法
         *
         * @return void
         */
        private function __clone()
        {
        }
        /**
         * 获取$_GET中名为$name的参数值
         *
         * @param string $name 变量名
         *
         * @return mixed
         */
        public function getQuery($name = null)
        {
        }
        /**
         * 获取$_REQUEST中名为$name的参数值
         *
         * @param string $name 变量名
         *
         * @return mixed
         */
        public function getRequest($name = null)
        {
        }
        /**
         * 获取$_POST中名为$name的参数值
         *
         * @param string $name 变量名
         *
         * @return mixed
         */
        public function getPost($name = null)
        {
        }
        /**
         * 获取$_COOKIE中名为$name的参数值
         *
         * @param string $name 变量名
         *
         * @return mixed
         */
        public function getCookie($name = null)
        {
        }
        /**
         * 获取$_FILES中名为$name的参数值
         *
         * @param string $name 变量名
         *
         * @return mixed
         */
        public function getFiles($name = null)
        {
        }
        /**
         * 获取全局变量中的值（扫描顺序为$_POST，$_GET，$_COOKIE，$_SERVER）
         *
         * @param string $name 变量名
         * @param mixed $default 默认值
         *
         * @return mixed
         */
        public function get($name, $default = null)
        {
        }
        public function getException()
        {
        }
    }
}

namespace Yaf\Response {
    /**
     * Class Http
     *
     * Http是在Yaf作为Web应用的时候默认响应载体
     *
     * @package Yaf\Response
     */
    class Http extends \Yaf\Response_Abstract
    {
        /**
         * 响应状态码
         *
         * @var Int
         */
        protected $_response_code = 200;

        public function __construct()
        {
        }
        public function __destruct()
        {
        }
        private function __clone()
        {
        }
        public function __toString()
        {
        }
        public function setHeader($name, $value, $rep = null, $response_code = null)
        {
        }
        public function setAllHeaders($headers)
        {
        }
        public function getHeader($name = null)
        {
        }
        public function clearHeaders()
        {
        }
    }

    /**
     * Class Cli
     *
     * Cli是在Yaf作为命令行应用的时候默认响应载体
     *
     * @package Yaf\Response
     */
    class Cli extends \Yaf\Response_Abstract
    {
        public function __construct()
        {
        }
        public function __destruct()
        {
        }
        private function __clone()
        {
        }
        public function __toString()
        {
        }
    }
}

namespace Yaf\View {
    /**
     * (Yaf >= 2.2.9)
     * Class Simple
     *
     * View_Simple是Yaf自带的视图引擎，对于视图模板，就是普通的PHP脚本.
     *
     * @package Yaf\View
     */
    class Simple implements \Yaf\View_Interface
    {
        /**
         * 储存所有模板变量
         *
         * @var array
         */
        protected $_tpl_vars;
        /**
         * 模板文件目录
         *
         * @var String
         */
        protected $_tpl_dir;
        /**
         * @deprecated 此属性在php-5.4以下版本中适用，用以设置模板渲染的方式，如
         * array(
         *  //开启短标识的解析
         *  'short_tag' => 1,
         * )
         * @var array
         */
        protected $_options;
        /**
         * 构造方法
         *
         * @param string $tpl_dir 模板文件目录
         * @param array $options 此属性在php-5.4以下版本中适用，用以设置模板渲染的方式
         */
        public function __construct($tpl_dir, $options)
        {
        }
        /**
         * 当isset检测某个属性是否存在时自动调用（判断是否传递某个模板变量）
         *
         * @param string $name 模板变量名
         *
         * @return Boolean
         */
        public function __isset($name)
        {
        }
        /**
         * 获取某个模板变量的值
         *
         * 当不传递参数是，返回全部的模板变量数组
         *
         * @param string $name 模板变量名
         *
         * @return mixed
         */
        public function __get($name)
        {
        }
        /**
         * 传递变量到模板
         *
         * 当只有一个参数时，参数必须是Array类型，可以展开多个模板变量
         *
         * @param string $name 变量名
         * @param string $value 变量值
         *
         * @return Boolean
         */
        public function __set($name, $value)
        {
        }
        /**
         * 获取某个模板变量的值
         *
         * 当不传递参数是，返回全部的模板变量数组
         *
         * @param string $name 模板变量名
         *
         * @return mixed
         */
        public function get($name)
        {
        }
        /**
         * 清空某个模板变量的值
         *
         * 当不传递参数是，清空全部的模板变量
         *
         * @param string $name 模板变量名
         *
         * @return mixed
         */
        public function clear($name)
        {
        }
        /**
         * 以引用的方式传递变量到模板
         *
         * 当只有一个参数时，参数必须是Array类型，可以展开多个模板变量
         *
         * @param string $name 变量名
         * @param string $value 变量值
         *
         * @return Boolean
         */
        public function assignRef($name, $value)
        {
        }
        public function eval($tpl_str, $vars = null)
        {
        }
        public function assign($name, $value = null)
        {
        }
        public function display($tpl, $var_array = [])
        {
        }
        public function render($tpl, $var_array = [])
        {
        }
        public function setScriptPath($tpl_dir)
        {
        }
        public function getScriptPath()
        {
        }
    }
}

namespace Yaf\Config {

    use Yaf\Config_Abstract;

    /**
     * Class Ini
     *
     * Ini存储在Ini文件的配置数据提供了适配器
     *
     * @package Yaf\Config
     */
    final class Ini extends \Yaf\Config_Abstract implements \Iterator, \ArrayAccess, \Countable
    {
        /**
         * 构造方法，初始化Ini对象
         *
         * @param string $filename ini文件全路径
         * @param string $section 初始化时的配置节点名称
         */
        public function __construct($filename, $section = null)
        {
        }
        /**
         * 魔术方法，当isset()检测某个配置节点是否存在时调用
         *
         * @param string $name 节点名称
         *
         * @return Boolean
         */
        public function __isset($name)
        {
        }
        /**
         * 获取配置节点的值
         * 当不传递$name参数时，返回配置对象本身
         *
         * @param string $name
         * @return Ini
         */
        public function __get($name)
        {
        }
        /**
         * 设置配置节点值（无效）
         *
         * @deprecated 约定ini文件的配置不可写
         * @param string $name 变量名
         * @param mixed $value
         *
         * @return false
         */
        public function __set($name, $value)
        {
        }
        /**
         * (Yaf >= 2.2.9)
         * 设置配置节点值（无效）
         *
         * @deprecated 约定ini文件的配置不可写
         * @param string $name 变量名
         * @param mixed $value
         *
         * @return false
         */
        public function set($name, $value)
        {
        }
        /**
         * 返回配置节点的数量
         *
         * @return Int
         */
        public function count()
        {
        }
        /**
         * 重置遍历位置（php.net文档有误）
         *
         * @return void
         */
        public function rewind()
        {
        }
        /**
         * 返回当前节点
         *
         * @return Ini
         */
        public function current()
        {
        }
        /**
         * 向前移动到下一个元素
         *
         * @return void
         */
        public function next()
        {
        }
        /**
         * 判断是否可以继续遍历
         *
         * @return void
         */
        public function valid()
        {
        }
        /**
         * 返回当前配置节点的key
         *
         * @return mixed
         */
        public function key()
        {
        }
        /**
         * 撤消某个配置节点（无效）
         *
         * @deprecated 约定ini文件的配置不可写
         * @param string $name 变量名
         *
         * @return false
         */
        public function offsetUnset($name)
        {
        }
        /**
         * 测某个配置节点是否存在
         *
         * @param mixed $name 节点名称
         *
         * @return Boolean
         */
        public function offsetExists($name)
        {
        }
        /**
         * 设置配置节点值（无效）
         *
         * @deprecated 约定ini文件的配置不可写
         * @param string $name 变量名
         * @param mixed $value
         *
         * @return false
         */
        public function offsetSet($name, $value)
        {
        }
        /**
         * 获取配置节点的值
         * 当不传递$name参数时，返回配置对象本身
         *
         * @param string $name
         * @return Ini
         */
        public function offsetGet($name)
        {
        }
        /**
         * (Yaf >= 2.2.9)
         * 获取配置节点的值
         * 当不传递$name参数时，返回配置对象本身
         *
         * @param string $name
         * @return Ini
         */
        public function get($name)
        {
        }
        public function readonly()
        {
        }
        public function toArray()
        {
        }
    }

    /**
     * Class Simple
     *
     * Simple为存储在PHP的数组中的配置数据提供了适配器
     *
     * @package Yaf\Config
     */
    final class Simple extends \Yaf\Config_Abstract implements \Iterator, \ArrayAccess, \Countable
    {
        /**
         * 构造方法，初始化Simple对象
         *
         * @param string $config 储存配置的数组
         * @param string $readonly 是否只读
         */
        public function __construct($config, $readonly = null)
        {
        }
        /**
         * 魔术方法，当isset()检测某个配置节点是否存在时调用
         *
         * @param string $name 节点名称
         *
         * @return Boolean
         */
        public function __isset($name)
        {
        }
        /**
         * 获取配置节点的值
         * 当不传递$name参数时，返回配置对象本身
         *
         * @param string $name
         * @return Simple
         */
        public function __get($name)
        {
        }
        /**
         * 设置配置节点值
         *
         * @param string $name 节点名称
         * @param mixed $value 节点值
         *
         * @return Boolean
         */
        public function __set($name, $value)
        {
        }
        /**
         * 返回配置节点的数量
         *
         * @return Int
         */
        public function count()
        {
        }
        /**
         * 重置遍历位置（php.net文档有误）
         *
         * @return void
         */
        public function rewind()
        {
        }
        /**
         * 返回当前节点
         *
         * @return Simple
         */
        public function current()
        {
        }
        /**
         * 向前移动到下一个元素
         *
         * @return void
         */
        public function next()
        {
        }
        /**
         * 判断是否可以继续遍历
         *
         * @return void
         */
        public function valid()
        {
        }
        /**
         * 返回当前配置节点的key
         *
         * @return mixed
         */
        public function key()
        {
        }
        /**
         * 撤消某个配置节点
         *
         * @param string $name 节点名称
         *
         * @return Boolean
         */
        public function offsetUnset($name)
        {
        }
        /**
         * 测某个配置节点是否存在
         *
         * @param mixed $name 节点名称
         *
         * @return Boolean
         */
        public function offsetExists($name)
        {
        }
        /**
         * 获取配置节点的值
         * 当不传递$name参数时，返回配置对象本身
         *
         * @param string $name
         * @return Simple
         */
        public function offsetGet($name)
        {
        }
        /**
         * 设置配置节点值
         *
         * @param string $name 节点名称
         * @param mixed $value 节点值
         *
         * @return Boolean
         */
        public function offsetSet($name, $value)
        {
        }
        /**
         * 将配置转化为数组
         *
         * @return array|void
         */
        public function toArray()
        {
        }
        /**
         * 检测配置是否只读
         *
         * @return Boolean
         */
        public function readonly()
        {
        }
        public function get($name)
        {
        }
        public function set($name, $value)
        {
        }
    }
}

namespace Yaf\Route {
    /**
     * Class Simple
     *
     * 简单路由协议
     *
     * @package Yaf\Route
     */
    final class Simple implements \Yaf\Route_Interface
    {
        /**
         * 控制器名
         *
         * @var String
         */
        protected $controller = null;
        /**
         * 模块名
         *
         * @var String
         */
        protected $module = null;
        /**
         * 动作名
         *
         * @var String
         */
        protected $action = null;

        public function __construct($module_name, $controller_name, $action_name)
        {
        }
        public function route($request)
        {
        }
        public function assemble(array $info, array $query = null)
        {
        }
    }

    /**
     * Class Supervar
     *
     * 全局变量路由协议
     *
     * @package Yaf\Route
     */
    final class Supervar implements \Yaf\Route_Interface
    {
        /**
         * 全局路由变量名
         *
         * @var String
         */
        protected $_var_name = null;

        /* methods */
        public function __construct($supervar_name)
        {
        }
        public function route($request)
        {
        }
        public function assemble(array $info, array $query = null)
        {
        }
    }

    /**
     * Class Rewrite
     *
     * 重写路由协议
     *
     * @package Yaf\Route
     */
    final class Rewrite implements \Yaf\Route_Interface
    {
        /**
         * 匹配模式（正则表达式）
         *
         * @var String
         */
        protected $_route = null;
        /**
         * 路由信息
         *
         * 如：array('module' => 'index', 'controller' => 'index', 'action' => 'index')
         *
         * @var array
         */
        protected $_default = null;
        /**
         * 哥也不清楚（实在没有查到作用，源码也没看出所以然，问鸟哥！）
         *
         * @var array
         */
        protected $_verify = null;

        public function __construct($match, array $route, array $verify = null)
        {
        }
        public function route($request)
        {
        }
        public function assemble(array $info, array $query = null)
        {
        }
    }

    /**
     * Class Regex
     *
     * 正则路由协议
     *
     * @package Yaf\Route
     */
    final class Regex implements \Yaf\Route_Interface
    {
        /**
         * 匹配模式（正则表达式）
         *
         * @var String
         */
        protected $_route = null;
        /**
         * (Yaf >= 2.2.9)
         * 路由信息
         *
         * 如：array('module' => 'index', 'controller' => 'index', 'action' => 'index')
         *
         * @var array
         */
        protected $_default = null;
        /**
         * 模式分组的映射关系
         *
         * 如：array('1' => 'name', '2' => 'age')
         *
         * @var array
         */
        protected $_maps = null;
        protected $_verify = null;
        protected $_reverse = null;

        public function __construct($match, array $route, array $map = null, array $verify = null, $reverse = null)
        {
        }
        public function route($request)
        {
        }
        public function assemble(array $info, array $query = null)
        {
        }
    }

    /**
     * Class Map
     *
     * Map议是一种简单的路由协议, 它将REQUEST_URI中以'/'分割的节, 组合在一起, 形成一个分层的控制器或者动作的路由结果.
     *
     * @package Yaf\Route
     */
    final class Map implements \Yaf\Route_Interface
    {
        /**
         * 表示路由结果是作为动作的路由结果，还是控制器的路由结果，默认的是动作路由结果.
         *
         * @var Int
         */
        protected $_ctl_router = '';
        /**
         * 分隔符
         *
         * @var String
         */
        protected $_delimiter = null;

        /**
         * (Yaf >= 2.2.9)
         * 构造方法
         *
         * @param $controller_prefer boolean 表示路由结果是作为动作的路由结果，还是控制器的路由结果，默认的是动作路由结果.
         * @param $delim string 表示一个分隔符，如果设置了这个分隔符，那么在REQUEST_URI中，分隔符之前的作为路由信息载体，而之后的作为请求参数.
         * @param null|mixed $delimiter
         */
        public function __construct($controller_prefer = null, $delimiter = null)
        {
        }
        public function route($request)
        {
        }
        public function assemble(array $info, array $query = null)
        {
        }
    }
}

namespace Yaf\Exception {
    /**
     * Class StartupError
     *
     * Yaf App实例启动异常
     *
     * @package Yaf\SyException
     */
    class StartupError extends \Yaf\Exception implements \Throwable
    {
    }

    /**
     * Class RouterFailed
     *
     * 路由异常
     *
     * @package Yaf\SyException
     */
    class RouterFailed extends \Yaf\Exception implements \Throwable
    {
    }

    /**
     * Class DispatchFailed
     *
     * 分发异常
     *
     * @package Yaf\SyException
     */
    class DispatchFailed extends \Yaf\Exception implements \Throwable
    {
    }

    /**
     * Class LoadFailed
     *
     * 装载异常
     *
     * @package Yaf\SyException
     */
    class LoadFailed extends \Yaf\Exception implements \Throwable
    {
    }

    /**
     * Class TypeError
     *
     * 关键类型异常
     *
     * @package Yaf\SyException
     */
    class TypeError extends \Yaf\Exception implements \Throwable
    {
    }
}

namespace Yaf\Exception\LoadFailed {
    /**
     * Class Module
     *
     * 模块加载异常
     *
     * @package Yaf\SyException\LoadFailed
     */
    class Module extends \Yaf\Exception\LoadFailed implements \Throwable
    {
    }

    /**
     * Class Controller
     *
     * 控制器加载异常
     *
     * @package Yaf\SyException\LoadFailed
     */
    class Controller extends \Yaf\Exception\LoadFailed implements \Throwable
    {
    }

    /**
     * Class Action
     *
     * 动作类加载异常
     *
     * @package Yaf\SyException\LoadFailed
     */
    class Action extends \Yaf\Exception\LoadFailed implements \Throwable
    {
    }

    /**
     * Class View
     *
     * 视图加载异常
     *
     * @package Yaf\SyException\LoadFailed
     */
    class View extends \Yaf\Exception\LoadFailed implements \Throwable
    {
    }
}
