<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/5/28 0028
 * Time: 18:07
 */
namespace TemplateExtension\Twig;

class BaseFunction extends \Twig_SimpleFunction {
    public function __construct(string $callableName,callable $callable,array $params=[]){
        parent::__construct($callableName, $callable, $params);
    }
}