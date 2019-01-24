<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 17-3-29
 * Time: 上午11:45
 */
namespace DesignPatterns\Adapters;

use Constant\ErrorCode;
use Exception\Twig\TwigException;
use Tool\Tool;
use Yaf\View_Interface;

class TwigAdapter implements View_Interface {
    /**
     * assigned vars
     * @var array
     */
    protected $_assigned = [];

    /**
     * twig environment
     * @var \Twig_Environment
     */
    protected $_twig;

    /**
     * @var \Twig_Loader_Filesystem
     */
    protected $_loader;

    /**
     * TwigAdapter constructor.
     * @param string $templatePath 模版根目录，以/结尾
     * @param array $envOptions 环境配置数组
     * @throws TwigException
     */
    public function __construct(string $templatePath,array $envOptions = []) {
        if(preg_match('/^\S+\/$/', $templatePath) == 0){
            throw new TwigException('模板根目录不合法', ErrorCode::TWIG_PARAM_ERROR);
        }

        $this->_loader = new \Twig_Loader_Filesystem($templatePath);
        $this->_twig = new \Twig_Environment($this->_loader, $envOptions);

        $debug = Tool::getArrayVal($envOptions, 'debug');
        if ($debug) { //开启debug
            $this->_twig->addExtension(new \Twig_Extension_Debug());
        }
    }

    private function __clone() {
    }

    public function addFunction($name,\Twig_SimpleFunction $function) {
        $this->_twig->addFunction($name, $function);
    }

    public function addExtension(\Twig_ExtensionInterface $extension) {
        $this->_twig->addExtension($extension);
    }

    public function addGlobal($name, $value) {
        $this->_twig->addGlobal($name, $value);
    }

    /**
     * Set the template loader
     *
     * @param \Twig_LoaderInterface $loader
     * @return void
     */
    public function setLoader(\Twig_LoaderInterface $loader) {
        $this->_twig->setLoader($loader);
    }

    /**
     * Get the template loader
     *
     * @return \Twig_LoaderInterface
     */
    public function getLoader() {
        return $this->_loader;
    }

    /**
     * Get the twig environment
     *
     * @return \Twig_Environment
     */
    public function getEngine() {
        return $this->_twig;
    }

    /**
     * Set the path to the templates
     *
     * @param string $path The directory to set as the path.
     * @return void
     */
    public function setScriptPath($path) {
        $this->_loader->addPath($path);
    }

    /**
     * add the path to the templates
     *
     * @param string $path The directory to set as the path.
     * @return void
     */
    public function addScriptPath($path) {
        $this->_loader->addPath($path);
    }

    /**
     * Retrieve the current template directory
     *
     * @return array
     */
    public function getScriptPath() {
        return $this->_loader->getPaths();
    }

    /**
     * No basepath support on twig, therefore alias for "setScriptPath()"
     *
     * @see setScriptPath()
     * @param string $path
     * @return void
     */
    public function setBasePath($path) {
        $this->setScriptPath($path);
    }

    /**
     * No basepath support on twig, therefore alias for "setScriptPath()"
     *
     * @see setScriptPath()
     * @param string $path
     * @return void
     */
    public function addBasePath($path) {
        $this->setScriptPath($path);
    }

    /**
     * Assign a variable to the template
     *
     * @param string $key The variable name.
     * @param mixed $val The variable value.
     * @return void
     */
    public function __set($key, $val) {
        $this->assign($key, $val);
    }

    /**
     * Allows testing with empty() and isset() to work
     *
     * @param string $key
     * @return boolean
     */
    public function __isset($key) {
        return isset($this->_assigned[$key]);
    }

    /**
     * Allows unset() on object properties to work
     *
     * @param string $key
     * @return void
     */
    public function __unset($key) {
        unset($this->_assigned[$key]);
    }

    /**
     * Assign variables to the template
     *
     * Allows setting a specific key to the specified value, OR passing
     * an array of key => value pairs to set en masse.
     *
     * @see  __set()
     * @param string|array $spec The assignment strategy to use (key or
     * array of key => value pairs)
     * @param mixed $value (Optional) If assigning a named variable,
     * use this as the value.
     * @return void
     */
    public function assign($spec, $value=null) {
        if (is_array($spec)) {
            $this->_assigned = array_merge($this->_assigned, $spec);
        } else if (is_string($spec)) {
            $this->_assigned[$spec] = $value;
        }
    }

    /**
     * Clear all assigned variables
     *
     * Clears all variables assigned to Zend_View either via
     * {@link  assign()} or property overloading
     * ({@link  __get()}/{@link  __set()}).
     *
     * @return void
     */
    public function clearVars() {
        $this->_assigned = [];
    }

    /**
     * Processes a template and returns the output.
     *
     * @param string $name The template to process.
     * @return string The output.
     */
    public function render($name, $vars=[]) {
        $template = $this->_twig->load($name);
        if (empty($vars)) {
            $totalVars = $this->_assigned;
        } else {
            $totalVars = array_merge($this->_assigned, $vars);
        }

        return $template->render($totalVars);
    }

    public function display($name, $vars=[]) {
        $template = $this->_twig->load($name);
        if (empty($vars)) {
            $totalVars = $this->_assigned;
        } else {
            $totalVars = array_merge($this->_assigned, $vars);
        }

        echo $template->render($totalVars);
    }
}