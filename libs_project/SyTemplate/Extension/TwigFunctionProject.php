<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/4/30 0030
 * Time: 19:06
 */
namespace SyTemplate\Extension;

use SyTool\Tool;
use Twig\TwigFunction;

/**
 * Class TwigFunctionProject
 *
 * @package SyTemplate\Extension
 */
class TwigFunctionProject
{
    /**
     * @var \SyTemplate\Extension\TwigFunctionProject
     */
    private static $instance = null;

    private $funcMap = [];

    private function __construct()
    {
        $this->funcMap['syFunca01'] = new TwigFunction('syDate', function ($time) {
            echo date('Y-m-d H:i:s', $time);
        });
    }

    private function __clone()
    {
    }

    /**
     * @return \SyTemplate\Extension\TwigFunctionProject
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param string $tag
     *
     * @return array|\Twig\TwigFunction|null
     */
    public function getFunction(string $tag = '')
    {
        if (strlen($tag) > 0) {
            return Tool::getArrayVal($this->funcMap, $tag, null);
        }

        return $this->funcMap;
    }
}
