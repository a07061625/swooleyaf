<?php
/**
 * 扩展文件生成器基类
 * User: 姜伟
 * Date: 2017/6/29 0029
 * Time: 8:51
 */
namespace IDE;

use Tool\Tool;

abstract class BaseModuleGenerator {
    /**
     * 扩展名称
     * @var string
     */
    private $moduleName = '';
    /**
     * 扩展内容数组
     * @var array
     */
    private $moduleContents = [];
    /**
     * PHP语言定义的参数类型
     * @var array
     */
    private $definedParamClasses = [];

    public function __construct($moduleName){
        $this->moduleName = $moduleName;
        $this->moduleContents = [
            'constants' => [],
            'classes' => [],
        ];
        $this->definedParamClasses = [
            'int',
            'bool',
            'array',
            'float',
            'string',
        ];
    }

    private function __clone() {
    }

    private function getHelperName() : string {
        $str1 = preg_replace('/[^0-9a-zA-Z]+/', ' ', $this->moduleName);
        $str2 = preg_replace('/\s+/', '', ucwords($str1));

        return __DIR__ . '/Helper' . $str2 . '.php';
    }

    private function generatorFile() {
        $fileContent = '<?php' . PHP_EOL;
        if(!empty($this->moduleContents['constants'])){
            $fileContent .= 'namespace {' . PHP_EOL;
            foreach ($this->moduleContents['constants'] as $constantKey => $constantVal) {
                $fileContent .= "    define('" . $constantKey . "', ";
                if(is_bool($constantVal)){
                    $fileContent .= $constantVal ? 'true' : 'false';
                } else if(is_null($constantVal)){
                    $fileContent .= 'null';
                } else if(is_string($constantVal)){
                    $fileContent .= "'" . $constantVal . "'";
                } else {
                    $fileContent .= $constantVal;
                }
                $fileContent .= ');' . PHP_EOL;
            }
            $fileContent .= '}' . PHP_EOL . PHP_EOL;
        }
        if(!empty($this->moduleContents['classes'])){
            foreach ($this->moduleContents['classes'] as $namespaceName => $classes) {
                $fileContent .= 'namespace ' . $namespaceName . ' {' . PHP_EOL;
                $fileContent .= implode(PHP_EOL, $classes);
                $fileContent .= '}' . PHP_EOL . PHP_EOL;
            }
        }

        file_put_contents($this->getHelperName(), $fileContent);
    }

    public function createHelper() {
        //获取扩展定义的常量
        $totalConstants = get_defined_constants(true);
        $this->moduleContents['constants'] = Tool::getArrayVal($totalConstants, $this->moduleName, []);
        //获取扩展定义的类
        $classes = $this->getModuleClasses();
        foreach ($classes as $eClassName) {
            $class = new \ReflectionClass($eClassName);
            $backslash = strrpos($eClassName, '\\');
            if($backslash !== false){
                $namespaceName = substr($eClassName, 0, $backslash);
                $className = substr($eClassName, $backslash + 1);
            } else {
                $namespaceName = '';
                $className = $eClassName;
            }

            if(!isset($this->moduleContents['classes'][$namespaceName])){
                $this->moduleContents['classes'][$namespaceName] = [];
            }

            $indent = '    ';
            $classContent =  $indent;
            if($class->isInterface()){
                $classContent .= 'interface ';
            } else {
                if($class->isFinal()){
                    $classContent .= 'final ';
                } else if($class->isAbstract()){
                    $classContent .= 'abstract ';
                }
                $classContent .= 'class ';
            }
            $classContent .= $className;
            $parent = $class->getParentClass();
            if ($parent) {
                $classContent .= ' extends \\' . $parent->getName();
            }
            $interfaces = $class->getInterfaceNames();
            if (count($interfaces) > 0) {
                $needStr1 = ', \\' . implode(', \\', $interfaces);
                if(in_array('Iterator', $interfaces) && in_array('Traversable', $interfaces)){
                    $needStr2 = str_replace(', \\Traversable', '', $needStr1);
                    $classContent .= ' implements ' . substr($needStr2, 2);
                } else {
                    $classContent .= ' implements ' . substr($needStr1, 2);
                }
            }
            $classContent .= ' {' . PHP_EOL;
            $indent .= '    ';

            $constants = $class->getConstants();
            if(count($constants) > 0){
                $classContent .= $indent . '/* constants */' . PHP_EOL;
                foreach ($constants as $key => $val) {
                    $classContent .= $indent . 'const ' . $key . ' = ';
                    if(is_bool($val)){
                        $classContent .= $val ? 'true' : 'false';
                    } else if(is_null($val)){
                        $classContent .= 'null';
                    } else if(is_string($val)){
                        $classContent .= "'" . $val . "'";
                    } else {
                        $classContent .= $val;
                    }
                    $classContent .= ';' . PHP_EOL;
                }
                $classContent .= PHP_EOL;
            }

            $properties = $class->getProperties();
            if(count($properties) > 0){
                $classContent .= $indent . '/* properties */' . PHP_EOL;
                $propValues = $class->getDefaultProperties();
                foreach ($properties as $eProp) {
                    $classContent .= $indent;
                    if($eProp->isPublic()){
                        $classContent .= 'public ';
                    } else if($eProp->isProtected()){
                        $classContent .= 'protected ';
                    } else {
                        $classContent .= 'private ';
                    }
                    if($eProp->isStatic()){
                        $classContent .= 'static ';
                    }

                    $ePropName = $eProp->getName();
                    $classContent .= '$' . $ePropName . ' = ';
                    if(!isset($propValues[$ePropName])){
                        $classContent .= 'null';
                    } else if(is_bool($propValues[$ePropName])){
                        $classContent .= $propValues[$ePropName] ? 'true' : 'false';
                    } else if(is_null($propValues[$ePropName])){
                        $classContent .= 'null';
                    } else if(is_string($propValues[$ePropName])){
                        $classContent .= "'" . $propValues[$ePropName] . "'";
                    } else if(is_array($propValues[$ePropName])){
                        $classContent .= '[]';
                    } else {
                        $classContent .= $propValues[$ePropName];
                    }
                    $classContent .= ';' . PHP_EOL;
                }
                $classContent .= PHP_EOL;
            }

            $methods = $class->getMethods();
            if(count($methods) > 0){
                $methodIndex = 0;
                foreach ($methods as $method) {
                    if($methodIndex > 0){
                        $classContent .= PHP_EOL;
                    }
                    $methodComments = preg_replace('/\n\s+/', PHP_EOL . $indent . ' ', $method->getDocComment());
                    if(strlen($methodComments) > 0){
                        $classContent .= $indent . $methodComments . PHP_EOL;
                    }
                    $modifierNames = \Reflection::getModifierNames($method->getModifiers());
                    if((!in_array('public', $modifierNames))
                       && (!in_array('private', $modifierNames))
                       && (!in_array('protected', $modifierNames))){
                        $modifierNames[] = 'public';
                    }
                    sort($modifierNames);
                    $classContent .= $indent . implode(' ', $modifierNames);
                    $classContent .= ' function ' . $method->getName() . '(';
                    if($method->isAbstract()){
                        $classContent .= ');' . PHP_EOL . PHP_EOL;
                        continue;
                    }

                    $parameters = $method->getParameters();
                    $number = count($parameters);
                    $index  = 0;
                    foreach ($parameters as $parameter) {
                        if($parameter->isArray()){
                            $classContent .= 'array ';
                        } else {
                            $parameterClass = $parameter->getClass();
                            if(is_null($parameterClass)){
                                if($index > 0){
                                    $classContent .= ' ';
                                }
                            } else {
                                $parameterClassName = $parameterClass->getName();
                                if(in_array($parameterClassName, $this->definedParamClasses, true)){
                                    $classContent .= $parameterClassName . ' ';
                                } else {
                                    $classContent .= '\\' . $parameterClassName . ' ';
                                }
                            }
                        }

                        if($parameter->isPassedByReference()){
                            $classContent .= '&';
                        }

                        $parameterName = $parameter->getName();
                        if($parameterName == '...'){
                            $classContent .= '$_="..."';
                        } else {
                            $classContent .= '$' . $parameterName;
                        }

                        if($parameter->isOptional()){
                            $classContent .= ' = ';
                            if($parameter->isDefaultValueAvailable()){
                                $defaultValue = $parameter->getDefaultValue();
                                if(is_bool($defaultValue)){
                                    $classContent .= $defaultValue ? 'true' : 'false';
                                } else if(is_null($defaultValue)){
                                    $classContent .= 'null';
                                } else if(is_string($defaultValue)){
                                    $classContent .= "'" . $defaultValue . "'";
                                } else if(is_array($defaultValue)){
                                    $classContent .= '[]';
                                } else {
                                    $classContent .= $defaultValue;
                                }
                            } else {
                                $classContent .= 'null';
                            }
                        }

                        $index++;
                        if($index < $number){
                            $classContent .= ',';
                        }
                    }
                    $classContent .= '){}' . PHP_EOL;
                    $methodIndex++;
                }
            }

            $classContent .= '    }' . PHP_EOL;
            $this->moduleContents['classes'][$namespaceName][] = $classContent;
        }

        $this->generatorFile();
    }

    abstract protected function getModuleClasses() : array;
}