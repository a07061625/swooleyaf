<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 17-11-12
 * Time: 下午11:51
 */
namespace DesignPatterns\Adapters;

use Yaf\View_Interface;

class SmartyAdapter implements View_Interface {
    /**
     * Smarty object
     * @var \Smarty
     */
    private $_smarty = null;

    /**
     * Constructor
     * @param string $templatePath
     * @param array $extraParams
     * @throws \Exception
     * @return void
     */
    public function __construct($templatePath = null,array $extraParams = []) {
        $this->_smarty = new \Smarty();

        if ($templatePath !== null) {
            $this->setScriptPath($templatePath);
        }

        foreach ($extraParams as $key => $value) {
            $this->_smarty->$key = $value;
        }
    }

    /**
     * Return the template engine object
     * @return \Smarty
     */
    public function getEngine() {
        return $this->_smarty;
    }

    /**
     * Set the path to the templates
     * @param string $path The directory to set as the path.
     * @throws \Exception
     * @return void
     */
    public function setScriptPath($path) {
        if (is_dir($path) && is_readable($path)) {
            $this->_smarty->template_dir = $path;
            return;
        }

        throw new \Exception('Invalid path provided');
    }

    /**
     * Retrieve the current template directory
     * @return string
     */
    public function getScriptPath() {
        return $this->_smarty->template_dir;
    }

    /**
     * Alias for setScriptPath
     * @param string $path
     * @param string $prefix Unused
     * @return void
     */
    public function setBasePath($path, $prefix = 'Zend_View') {
        $this->setScriptPath($path);
    }

    /**
     * Alias for setScriptPath
     * @param string $path
     * @param string $prefix Unused
     * @return void
     */
    public function addBasePath($path, $prefix = 'Zend_View') {
        $this->setScriptPath($path);
    }

    /**
     * Assign a variable to the template
     * @param string $key The variable name.
     * @param mixed $val The variable value.
     * @return void
     */
    public function __set($key, $val) {
        $this->_smarty->assign($key, $val);
    }

    /**
     * Allows testing with empty() and isset() to work
     * @param string $key
     * @return boolean
     */
    public function __isset($key) {
        return $this->_smarty->getTemplateVars($key) !== null;
    }

    /**
     * Allows unset() on object properties to work
     * @param string $key
     * @return void
     */
    public function __unset($key) {
        $this->_smarty->clearAssign($key);
    }

    /**
     * Assign variables to the template
     * Allows setting a specific key to the specified value, OR passing
     * an array of key => value pairs to set en masse.
     * @see __set()
     * @param string|array $spec The assignment strategy to use (key or
     * array of key => value pairs)
     * @param mixed $value (Optional) If assigning a named variable,
     * use this as the value.
     * @return void
     */
    public function assign($spec, $value = null) {
        if (is_array($spec)) {
            $this->_smarty->assign($spec);
            return;
        }

        $this->_smarty->assign($spec, $value);
    }

    /**
     * Clear all assigned variables
     * Clears all variables assigned to Zend_View either via
     * {@link assign()} or property overloading
     * ({@link __get()}/{@link __set()}).
     * @return void
     */
    public function clearVars() {
        $this->_smarty->clearAllAssign();
    }

    public function cleanCache(string $name = '') {
        if ($name === '') {
            $this->_smarty->clearCache($name);
            $this->_smarty->clearCompiledTemplate($name);
        } else {
            $this->_smarty->clearAllCache();
            $this->_smarty->clearCompiledTemplate();
        }
    }

    /**
     * Processes a template and returns the output.
     * @param string $name The template to process.
     * @return string The output.
     */
    public function render($name,$tpl_vars = []) {
        if (!empty($tpl_vars)) {
            $this->assign($tpl_vars);
        }

        return $this->_smarty->fetch($name);
    }

    public function display($name,$tpl_vars = []) {
        if (!empty($tpl_vars)) {
            $this->assign($tpl_vars);
        }

        echo $this->_smarty->fetch($name);
    }

    public function registerFunction(string $type, $function, $params) {
        if (in_array($type, ['function', 'modifier'])) {
            $this->_smarty->registerPlugin($type, $function, $params);
            return true;
        } else {
            return false;
        }
    }
}