<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/5/28 0028
 * Time: 18:14
 */
namespace TemplateExtension\Twig;

use Tool\Tool;

class ProjectFunction {
    /**
     * @var \TemplateExtension\Twig\ProjectFunction
     */
    private static $instance = null;

    private $funcMap = [];

    private function __construct(){
        $this->funcMap['syFunca01'] = new BaseFunction('syDate', function($time) {
            echo date('Y-m-d H:i:s', $time);
        });
    }

    private function __clone(){
    }

    public static function getInstance(){
        if(is_null(self::$instance)){
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param string $tag
     * @return array|\Twig_SimpleFunction|null
     */
    public function getFunction(string $tag='') {
        if(strlen($tag) > 0){
            return Tool::getArrayVal($this->funcMap, $tag, null);
        }

        return $this->funcMap;
    }
}