<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-5-22
 * Time: 下午11:47
 */
namespace IDE;

use SyTool\Tool;
use SyTrait\SimpleTrait;

class ExtensionGenerator
{
    use SimpleTrait;

    private static $contents = [];
    private static $paramLiteralTypes = [
        'int',
        'bool',
        'array',
        'float',
        'string',
        'callable',
    ];

    public static function createHelper()
    {
        $option = Tool::getClientOption(1, true);
        switch ($option) {
            case 'helper':
                $extensionName = trim(Tool::getClientOption('-name', false, ''));
                if (strlen($extensionName) == 0) {
                    exit('extension name must be input');
                }

                $reflectionObj = new \ReflectionExtension($extensionName);
                self::init();
                self::getExtConstants($reflectionObj);
                self::getExtClasses($reflectionObj);
                self::getExtFunctions($reflectionObj);

                $fileContent = '<?php' . PHP_EOL;
                if (!empty(self::$contents['constants'])) {
                    $fileContent .= 'namespace {' . PHP_EOL;
                    foreach (self::$contents['constants'] as $eConstant) {
                        $fileContent .= $eConstant;
                    }
                    $fileContent .= '}' . PHP_EOL . PHP_EOL;
                }

                foreach (self::$contents['classes'] as $namespaceName => $classes) {
                    $fileContent .= 'namespace ' . $namespaceName . ' {' . PHP_EOL;
                    $fileContent .= implode(PHP_EOL, $classes);
                    $fileContent .= '}' . PHP_EOL . PHP_EOL;
                }

                if (!empty(self::$contents['functions'])) {
                    $fileContent .= 'namespace {' . PHP_EOL;
                    $fileContent .= implode(PHP_EOL, self::$contents['functions']);
                    $fileContent .= '}' . PHP_EOL;
                }

                $needName = preg_replace('/[^0-9a-zA-Z]+/', '', $extensionName);
                $fileName = __DIR__ . '/Helper' . ucwords($needName) . '.php';
                file_put_contents($fileName, $fileContent);
                break;
            default:
                self::help();
        }
    }

    private static function init()
    {
        self::$contents = [
            'constants' => [],
            'classes' => [],
            'functions' => [],
        ];
    }

    /**
     * @param \ReflectionExtension $reflectionObj
     */
    private static function getExtConstants($reflectionObj)
    {
        $constants = $reflectionObj->getConstants();
        foreach ($constants as $key => $val) {
            $constantStr = "    define('" . $key . "', ";
            if (is_bool($val)) {
                $constantStr .= $val ? 'true' : 'false';
            } elseif (is_null($val)) {
                $constantStr .= 'null';
            } elseif (is_string($val)) {
                $constantStr .= "'" . $val . "'";
            } else {
                $constantStr .= $val;
            }
            $constantStr .= ');' . PHP_EOL;
            self::$contents['constants'][] = $constantStr;
        }
    }

    /**
     * @param \ReflectionExtension $reflectionObj
     */
    private static function getExtClasses($reflectionObj)
    {
        $classes = $reflectionObj->getClasses();
        foreach ($classes as $eClassName => $eClass) {
            $backslash = strrpos($eClassName, '\\');
            if ($backslash !== false) {
                $namespaceName = substr($eClassName, 0, $backslash);
                $className = substr($eClassName, ($backslash + 1));
            } else {
                $namespaceName = '';
                $className = $eClassName;
            }
            if (!isset(self::$contents['classes'][$namespaceName])) {
                self::$contents['classes'][$namespaceName] = [];
            }
            $indent = '    ';
            $classContent = $indent;
            if ($eClass->isInterface()) {
                $classContent .= 'interface ';
            } else {
                if ($eClass->isFinal()) {
                    $classContent .= 'final ';
                } elseif ($eClass->isAbstract()) {
                    $classContent .= 'abstract ';
                }
                $classContent .= 'class ';
            }
            $classContent .= $className;
            
            $parent = $eClass->getParentClass();
            if ($parent) {
                $classContent .= ' extends \\' . $parent->getName();
            }

            $interfaces = $eClass->getInterfaceNames();
            if (count($interfaces) > 0) {
                $needStr1 = ', \\' . implode(', \\', $interfaces);
                if (in_array('Iterator', $interfaces, true) && in_array('Traversable', $interfaces, true)) {
                    $needStr2 = str_replace(', \\Traversable', '', $needStr1);
                    $classContent .= ' implements ' . substr($needStr2, 2);
                } else {
                    $classContent .= ' implements ' . substr($needStr1, 2);
                }
            }
            $classContent .= ' {' . PHP_EOL;
            $indent .= '    ';

            $constants = $eClass->getConstants();
            if (count($constants) > 0) {
                $classContent .= $indent . '/* constants */' . PHP_EOL;
                foreach ($constants as $key => $val) {
                    $classContent .= $indent . 'const ' . $key . ' = ';
                    if (is_bool($val)) {
                        $classContent .= $val ? 'true' : 'false';
                    } elseif (is_null($val)) {
                        $classContent .= 'null';
                    } elseif (is_string($val)) {
                        $classContent .= "'" . $val . "'";
                    } else {
                        $classContent .= $val;
                    }
                    $classContent .= ';' . PHP_EOL;
                }
                $classContent .= PHP_EOL;
            }

            $properties = $eClass->getProperties();
            if (count($properties) > 0) {
                $classContent .= $indent . '/* properties */' . PHP_EOL;
                $propValues = $eClass->getDefaultProperties();
                foreach ($properties as $eProp) {
                    $classContent .= $indent;
                    if ($eProp->isPublic()) {
                        $classContent .= 'public ';
                    } elseif ($eProp->isProtected()) {
                        $classContent .= 'protected ';
                    } else {
                        $classContent .= 'private ';
                    }
                    if ($eProp->isStatic()) {
                        $classContent .= 'static ';
                    }

                    $ePropName = $eProp->getName();
                    $classContent .= '$' . $ePropName . ' = ';
                    if (!isset($propValues[$ePropName])) {
                        $classContent .= 'null';
                    } elseif (is_bool($propValues[$ePropName])) {
                        $classContent .= $propValues[$ePropName] ? 'true' : 'false';
                    } elseif (is_null($propValues[$ePropName])) {
                        $classContent .= 'null';
                    } elseif (is_string($propValues[$ePropName])) {
                        $classContent .= "'" . $propValues[$ePropName] . "'";
                    } elseif (is_array($propValues[$ePropName])) {
                        $classContent .= '[]';
                    } else {
                        $classContent .= $propValues[$ePropName];
                    }
                    $classContent .= ';' . PHP_EOL;
                }
                $classContent .= PHP_EOL;
            }

            $methods = $eClass->getMethods();
            if (count($methods) > 0) {
                $methodIndex = 0;
                foreach ($methods as $method) {
                    if ($methodIndex > 0) {
                        $classContent .= PHP_EOL;
                    }
                    $methodComments = preg_replace('/\n\s+/', PHP_EOL . $indent . ' ', $method->getDocComment());
                    if (strlen($methodComments) > 0) {
                        $classContent .= $indent . $methodComments . PHP_EOL;
                    }
                    $modifierNames = \Reflection::getModifierNames($method->getModifiers());
                    $intersectArr = array_intersect(['public', 'private', 'protected',], $modifierNames);
                    if (empty($intersectArr)) {
                        $modifierNames[] = 'public';
                    }
                    sort($modifierNames);
                    $modifierNameStr = implode(' ', $modifierNames);
                    if ($eClass->isInterface()) {
                        $classContent .= $indent . str_replace('abstract ', '', $modifierNameStr);
                    } else {
                        $classContent .= $indent . $modifierNameStr;
                    }
                    $classContent .= ' function ' . $method->getName() . '(';
                    if ($method->isAbstract()) {
                        $classContent .= ');' . PHP_EOL;
                        continue;
                    }

                    $parameters = $method->getParameters();
                    $number = count($parameters);
                    $index = 0;
                    foreach ($parameters as $parameter) {
                        if ($parameter->isArray()) {
                            $classContent .= 'array ';
                        } else {
                            $parameterClass = $parameter->getClass();
                            if (is_null($parameterClass)) {
                                if ($index > 0) {
                                    $classContent .= ' ';
                                }
                            } else {
                                $parameterClassName = $parameterClass->getName();
                                if (in_array($parameterClassName, self::$paramLiteralTypes, true)) {
                                    $classContent .= $parameterClassName . ' ';
                                } else {
                                    $classContent .= '\\' . $parameterClassName . ' ';
                                }
                            }
                        }

                        if ($parameter->isPassedByReference()) {
                            $classContent .= '&';
                        }

                        $parameterName = $parameter->getName();
                        if ($parameterName == '...') {
                            $classContent .= '$_="..."';
                        } else {
                            $classContent .= '$' . $parameterName;
                        }

                        if ($parameter->isOptional()) {
                            $classContent .= ' = ';
                            if ($parameter->isDefaultValueAvailable()) {
                                $defaultValue = $parameter->getDefaultValue();
                                if (is_bool($defaultValue)) {
                                    $classContent .= $defaultValue ? 'true' : 'false';
                                } elseif (is_null($defaultValue)) {
                                    $classContent .= 'null';
                                } elseif (is_string($defaultValue)) {
                                    $classContent .= "'" . $defaultValue . "'";
                                } elseif (is_array($defaultValue)) {
                                    $classContent .= '[]';
                                } else {
                                    $classContent .= $defaultValue;
                                }
                            } else {
                                $classContent .= 'null';
                            }
                        }

                        $index++;
                        if ($index < $number) {
                            $classContent .= ',';
                        }
                    }
                    $classContent .= '){}' . PHP_EOL;
                    $methodIndex++;
                }
            }

            $classContent .= '    }' . PHP_EOL;
            self::$contents['classes'][$namespaceName][] = $classContent;
        }
    }

    /**
     * @param \ReflectionExtension $reflectionObj
     */
    private static function getExtFunctions($reflectionObj)
    {
        $functions = $reflectionObj->getFunctions();
        foreach ($functions as $funcName => $eFunc) {
            $paramComment = '';
            $funcParams = [];
            $params = $eFunc->getParameters();
            foreach ($params as $eParam) {
                $paramComment .= '     * @param $' . $eParam->name;
                if ($eParam->isOptional()) {
                    $paramComment .= ' [optional]' . PHP_EOL;
                    $funcParams[] = '$' . $eParam->name . '=null';
                } else {
                    $paramComment .= ' [required]' . PHP_EOL;
                    $funcParams[] = '$' . $eParam->name;
                }
            }
            if ($eFunc->hasReturnType()) {
                $paramComment .= '     * @return ';
                $returnType = $eFunc->getReturnType();
                if (is_null($returnType)) {
                    $paramComment .= 'null';
                } else {
                    $paramComment .= $returnType;
                }
                $paramComment .= PHP_EOL;
            }
            if (strlen($paramComment) > 0) {
                $comment = '    /**' . PHP_EOL . $paramComment . '     */' . PHP_EOL;
            } else {
                $comment = '';
            }
            $comment .= sprintf('    function %s(%s){}', $funcName, join(', ', $funcParams));
            $comment .= PHP_EOL;
            self::$contents['functions'][] = $comment;
        }
    }

    private static function help()
    {
        echo '显示帮助: /usr/local/php7/bin/php helper_extension.php -h' . PHP_EOL;
        echo '生成扩展帮助文档: /usr/local/php7/bin/php helper_extension.php helper -name xxx' . PHP_EOL;
        echo '    -name:必填 扩展名' . PHP_EOL;
    }
}
