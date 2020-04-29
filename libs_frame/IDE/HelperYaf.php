<?php
namespace {
    define('YAF\VERSION', '3.2.1');
    define('YAF\ENVIRON', 'dev');
    define('YAF\ERR\STARTUP_FAILED', 512);
    define('YAF\ERR\ROUTE_FAILED', 513);
    define('YAF\ERR\DISPATCH_FAILED', 514);
    define('YAF\ERR\AUTOLOAD_FAILED', 520);
    define('YAF\ERR\NOTFOUND\MODULE', 515);
    define('YAF\ERR\NOTFOUND\CONTROLLER', 516);
    define('YAF\ERR\NOTFOUND\ACTION', 517);
    define('YAF\ERR\NOTFOUND\VIEW', 518);
    define('YAF\ERR\CALL_FAILED', 519);
    define('YAF\ERR\TYPE_ERROR', 521);
    define('YAF\ERR\ACCESS', 522);
}

namespace Yaf {
    final class Application {
        public function __construct($config, $environ = null){}

        public function run(){}

        public function execute($entry, $_="..."){}

        public static function app(){}

        public function environ(){}

        public function bootstrap($bootstrap = null){}

        public function getConfig(){}

        public function getModules(){}

        public function getDispatcher(){}

        public function setAppDirectory($directory){}

        public function getAppDirectory(){}

        public function getLastErrorNo(){}

        public function getLastErrorMsg(){}

        public function clearLastError(){}

        public function getInstance(){}
    }

    abstract class Bootstrap_Abstract {
    }

    final class Dispatcher {
        private function __construct(){}

        public function enableView(){}

        public function disableView(){}

        public function initView($templates_dir,array $options = null){}

        public function setView($view){}

        public function setRequest($request){}

        public function getApplication(){}

        public function getRouter(){}

        public function getResponse(){}

        public function getRequest(){}

        public function getDefaultModule(){}

        public function getDefaultController(){}

        public function getDefaultAction(){}

        public function setErrorHandler($callback, $error_types){}

        public function setDefaultModule($module){}

        public function setDefaultController($controller){}

        public function setDefaultAction($action){}

        public function returnResponse($flag){}

        public function autoRender($flag){}

        public function flushInstantly($flag){}

        public static function getInstance(){}

        public function dispatch($request){}

        public function throwException($flag = null){}

        public function catchException($flag = null){}

        public function registerPlugin($plugin){}
    }

    final class Loader {
        private function __construct(){}

        public function autoload($class_name){}

        public static function getInstance($local_library_path = null, $global_library_path = null){}

        public function registerLocalNamespace($namespace, $path = null){}

        public function getLocalNamespace(){}

        public function clearLocalNamespace(){}

        public function isLocalName($class_name){}

        public function getNamespacePath($class_name){}

        public static function import($file){}

        public function setLibraryPath($library_path, $is_global = null){}

        public function getLibraryPath($is_global = null){}

        public function registerNamespace($namespace, $path = null){}

        public function getNamespaces(){}
    }

    abstract class Request_Abstract {
        /* constants */
        const SCHEME_HTTP = 'http';
        const SCHEME_HTTPS = 'https';

        public function isGet(){}

        public function isPost(){}

        public function isDelete(){}

        public function isPatch(){}

        public function isPut(){}

        public function isHead(){}

        public function isOptions(){}

        public function isCli(){}

        public function isXmlHttpRequest(){}

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

    abstract class Response_Abstract {
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

    abstract class Controller_Abstract {
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

    abstract class Action_Abstract extends \Yaf\Controller_Abstract {
        /* properties */
        protected $_controller = null;

        abstract public function execute();
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

    abstract class Config_Abstract implements \Iterator, \ArrayAccess, \Countable {
        public function get($name = null){}

        public function count(){}

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

        abstract public function offsetSet();

        abstract public function set();

        abstract public function readonly();
    }

    interface View_Interface {
        public function assign();
        public function display();
        public function render();
        public function setScriptPath();
        public function getScriptPath();
    }

    final class Router {
        public function __construct(){}

        public function addRoute(){}

        public function addConfig(){}

        public function route(){}

        public function getRoute($name){}

        public function getRoutes(){}

        public function getCurrentRoute(){}
    }

    interface Route_Interface {
        public function route();
        public function assemble();
    }

    final class Route_Static implements \Yaf\Route_Interface {
        public function match($uri){}

        public function route($request){}

        public function assemble(array $info,array $query = null){}
    }

    abstract class Plugin_Abstract {
        public function routerStartup(\Yaf\Request_Abstract $request,\Yaf\Response_Abstract $response){}

        public function routerShutdown(\Yaf\Request_Abstract $request,\Yaf\Response_Abstract $response){}

        public function dispatchLoopStartup(\Yaf\Request_Abstract $request,\Yaf\Response_Abstract $response){}

        public function dispatchLoopShutdown(\Yaf\Request_Abstract $request,\Yaf\Response_Abstract $response){}

        public function preDispatch(\Yaf\Request_Abstract $request,\Yaf\Response_Abstract $response){}

        public function postDispatch(\Yaf\Request_Abstract $request,\Yaf\Response_Abstract $response){}

        public function preResponse(\Yaf\Request_Abstract $request,\Yaf\Response_Abstract $response){}
    }

    final class Registry {
        private function __construct(){}

        public static function get($name){}

        public static function has($name){}

        public static function set($name, $value){}

        public static function del($name){}
    }

    final class Session implements \Iterator, \ArrayAccess, \Countable {
        private function __construct(){}

        public static function getInstance(){}

        public function start(){}

        public function get($name){}

        public function has($name){}

        public function set($name, $value){}

        public function del($name){}

        public function count(){}

        public function clear(){}

        public function offsetGet($name){}

        public function offsetSet($name, $value){}

        public function offsetExists($name){}

        public function offsetUnset($name){}

        public function __get($name){}

        public function __isset($name){}

        public function __set($name, $value){}

        public function __unset($name){}

        abstract public function current();

        abstract public function next();

        abstract public function key();

        abstract public function valid();

        abstract public function rewind();
    }

    class Exception extends \Exception implements \Throwable {
        /* properties */
        protected $file = null;
        protected $line = null;
        protected $message = null;
        protected $code = 0;
        protected $previous = null;

        final private function __clone(){}

        public function __construct($message = null, $code = null, $previous = null){}

        public function __wakeup(){}

        final public function getMessage(){}

        final public function getCode(){}

        final public function getFile(){}

        final public function getLine(){}

        final public function getTrace(){}

        final public function getPrevious(){}

        final public function getTraceAsString(){}

        public function __toString(){}
    }
}

namespace Yaf\Request {
    final class Http extends \Yaf\Request_Abstract {
        public function getQuery(){}

        public function getRequest(){}

        public function getPost(){}

        public function getCookie(){}

        public function getRaw(){}

        public function getFiles(){}

        public function get(){}

        public function isXmlHttpRequest(){}

        public function __construct(){}

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

    final class Simple extends \Yaf\Request_Abstract {
        /* constants */
        const SCHEME_HTTP = 'http';
        const SCHEME_HTTPS = 'https';

        public function __construct(){}

        public function getQuery(){}

        public function getRequest(){}

        public function getPost(){}

        public function getCookie(){}

        public function getFiles(){}

        public function get(){}

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
    final class Ini extends \Yaf\Config_Abstract implements \Countable, \ArrayAccess, \Iterator {
        public function __construct($config_file, $section = null){}

        public function get($name = null){}

        public function set($name, $value){}

        public function readonly(){}

        public function offsetGet($name = null){}

        public function offsetSet($name, $value){}

        public function __set($name, $value){}

        public function count(){}

        public function toArray(){}

        public function offsetUnset($name){}

        public function rewind(){}

        public function current(){}

        public function key(){}

        public function next(){}

        public function valid(){}

        public function __isset($name){}

        public function __get($name = null){}

        public function offsetExists($name){}
    }

    final class Simple extends \Yaf\Config_Abstract implements \Countable, \ArrayAccess, \Iterator {
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
    final class Simple implements \Yaf\View_Interface {
        final public function __construct($template_dir,array $options = null){}

        public function get($name = null){}

        public function assign($name, $value = null){}

        public function render($tpl, $tpl_vars = null){}

        public function eval($tpl_str, $vars = null){}

        public function display($tpl, $tpl_vars = null){}

        public function assignRef($name, &$value){}

        public function clear($name = null){}

        public function setScriptPath($template_dir){}

        public function getScriptPath($request = null){}

        public function __get($name = null){}

        public function __set($name, $value = null){}
    }
}

namespace Yaf\Route {
    final class Simple implements \Yaf\Route_Interface {
        public function __construct($module_name, $controller_name, $action_name){}

        public function route($request){}

        public function assemble(array $info,array $query = null){}
    }

    final class Supervar implements \Yaf\Route_Interface {
        public function __construct($supervar_name){}

        public function route($request){}

        public function assemble(array $info,array $query = null){}
    }

    final class Rewrite implements \Yaf\Route_Interface {
        public function __construct($match,array $route,array $verify = null){}

        public function match($uri){}

        public function route($request){}

        public function assemble(array $info,array $query = null){}
    }

    final class Regex implements \Yaf\Route_Interface {
        public function __construct($match,array $route,array $map = null,array $verify = null, $reverse = null){}

        public function match($uri){}

        public function route($request){}

        public function assemble(array $info,array $query = null){}
    }

    final class Map implements \Yaf\Route_Interface {
        public function __construct($controller_prefer = null, $delimiter = null){}

        public function route($request){}

        public function assemble(array $info,array $query = null){}
    }
}

namespace Yaf\Exception {
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

        final public function getMessage(){}

        final public function getCode(){}

        final public function getFile(){}

        final public function getLine(){}

        final public function getTrace(){}

        final public function getPrevious(){}

        final public function getTraceAsString(){}

        public function __toString(){}
    }

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

        final public function getMessage(){}

        final public function getCode(){}

        final public function getFile(){}

        final public function getLine(){}

        final public function getTrace(){}

        final public function getPrevious(){}

        final public function getTraceAsString(){}

        public function __toString(){}
    }

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

        final public function getMessage(){}

        final public function getCode(){}

        final public function getFile(){}

        final public function getLine(){}

        final public function getTrace(){}

        final public function getPrevious(){}

        final public function getTraceAsString(){}

        public function __toString(){}
    }

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

        final public function getMessage(){}

        final public function getCode(){}

        final public function getFile(){}

        final public function getLine(){}

        final public function getTrace(){}

        final public function getPrevious(){}

        final public function getTraceAsString(){}

        public function __toString(){}
    }

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

        final public function getMessage(){}

        final public function getCode(){}

        final public function getFile(){}

        final public function getLine(){}

        final public function getTrace(){}

        final public function getPrevious(){}

        final public function getTraceAsString(){}

        public function __toString(){}
    }
}

namespace Yaf\Exception\LoadFailed {
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

        final public function getMessage(){}

        final public function getCode(){}

        final public function getFile(){}

        final public function getLine(){}

        final public function getTrace(){}

        final public function getPrevious(){}

        final public function getTraceAsString(){}

        public function __toString(){}
    }

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

        final public function getMessage(){}

        final public function getCode(){}

        final public function getFile(){}

        final public function getLine(){}

        final public function getTrace(){}

        final public function getPrevious(){}

        final public function getTraceAsString(){}

        public function __toString(){}
    }

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

        final public function getMessage(){}

        final public function getCode(){}

        final public function getFile(){}

        final public function getLine(){}

        final public function getTrace(){}

        final public function getPrevious(){}

        final public function getTraceAsString(){}

        public function __toString(){}
    }

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

        final public function getMessage(){}

        final public function getCode(){}

        final public function getFile(){}

        final public function getLine(){}

        final public function getTrace(){}

        final public function getPrevious(){}

        final public function getTraceAsString(){}

        public function __toString(){}
    }
}

