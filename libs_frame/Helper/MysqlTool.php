<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/7/21 0021
 * Time: 9:13
 */

namespace Helper;

use DesignPatterns\Singletons\MysqlSingleton;
use SyTool\Tool;
use SyTrait\SimpleTrait;

class MysqlTool
{
    use SimpleTrait;

    public static function generator()
    {
        $option = Tool::getClientOption(1, true);
        switch ($option) {
            case 'entities':
                self::createDbEntities([
                    'db' => trim(Tool::getClientOption('-db', false, '')),
                    'path' => self::handlePath(),
                    'namespace' => self::handleNamespace(),
                    'prefix' => trim(Tool::getClientOption('-prefix', false, '')),
                    'suffix' => trim(Tool::getClientOption('-suffix', false, '')),
                ]);

                break;
            case 'entity':
                self::createDbEntity([
                    'db' => trim(Tool::getClientOption('-db', false, '')),
                    'table' => trim(Tool::getClientOption('-table', false, '')),
                    'path' => self::handlePath(),
                    'namespace' => self::handleNamespace(),
                    'prefix' => trim(Tool::getClientOption('-prefix', false, '')),
                    'suffix' => trim(Tool::getClientOption('-suffix', false, '')),
                ]);

                break;
            default:
                self::help();

                break;
        }
    }

    private static function handlePath()
    {
        $needStr1 = Tool::getClientOption('-path', false, '');
        $needStr2 = preg_replace([
            '/\s+/',
            '/\/+/',
        ], [
            '',
            '/',
        ], $needStr1);
        $needStr3 = trim($needStr2);
        $length = \strlen($needStr3);
        if (0 == $length) {
            $path = '';
        } elseif ('/' == substr($needStr3, ($length - 1), 1)) {
            $path = $needStr3;
        } else {
            $path = $needStr3 . '/';
        }

        return $path;
    }

    private static function handleNamespace()
    {
        $namespace = Tool::getClientOption('-namespace', false, '');
        if ((\strlen($namespace) > 0) && (!ctype_alnum($namespace))) {
            exit('命名空间不合法' . PHP_EOL);
        }

        return $namespace;
    }

    /**
     * 转换表名或数据库名
     *
     * @param string $name 表名或数据库名
     */
    private static function transferName(string $name): string
    {
        $str1 = strtolower($name);
        $str2 = preg_replace([
            '/[^0-9a-z]+/',
            '/\s+/',
        ], [
            ' ',
            ' ',
        ], $str1);
        $str3 = ucwords(trim($str2));

        return str_replace(' ', '', $str3);
    }

    private static function help()
    {
        echo '显示帮助: /usr/local/php7/bin/php helper_mysql.php -h' . PHP_EOL;
        echo '生成数据库下所有的实体类: /usr/local/php7/bin/php helper_mysql.php entities -db xxx -path /xxx -namespace xxx -prefix xxx -suffix xxx' . PHP_EOL;
        echo '    -db:必填 数据库标识' . PHP_EOL;
        echo '    -path:必填 存放实体类文件的目录,从根目录/开始' . PHP_EOL;
        echo '    -namespace:选填 命名空间' . PHP_EOL;
        echo '    -prefix:选填 实体类文件前缀' . PHP_EOL;
        echo '    -suffix:选填 实体类文件后缀' . PHP_EOL;
        echo '生成数据库下指定的实体类: /usr/local/php7/bin/php helper_mysql.php entity -db xxx -table xxx -path /xxx -namespace xxx -prefix xxx -suffix xxx' . PHP_EOL;
        echo '    -db:必填 数据库标识' . PHP_EOL;
        echo '    -table:必填 表名' . PHP_EOL;
        echo '    -path:必填 存放实体类文件的目录,从根目录/开始' . PHP_EOL;
        echo '    -namespace:选填 命名空间' . PHP_EOL;
        echo '    -prefix:选填 实体类文件前缀' . PHP_EOL;
        echo '    -suffix:选填 实体类文件后缀' . PHP_EOL;
    }

    /**
     * 创建数据库下所有的实体类
     *
     * @param array $configs 配置数组
     */
    private static function createDbEntities(array $configs)
    {
        if (!$configs['db']) {
            exit('数据库标识不能为空' . PHP_EOL);
        }

        $tables = MysqlSingleton::getInstance()->getDbTables($configs['db']);
        foreach ($tables as $eTable) {
            self::createDbEntity([
                'db' => $configs['db'],
                'table' => $eTable,
                'path' => $configs['path'],
                'namespace' => $configs['namespace'],
                'prefix' => $configs['prefix'],
                'suffix' => $configs['suffix'],
            ]);

            echo 'create entity ' . $eTable . ' success' . PHP_EOL;
        }
        echo 'create all entities success' . PHP_EOL;
    }

    /**
     * 创建数据库下指定的实体类
     *
     * @param array $configs 配置数组
     */
    private static function createDbEntity(array $configs)
    {
        if (!$configs['db']) {
            exit('数据库标识不能为空' . PHP_EOL);
        }
        if (!$configs['table']) {
            exit('数据库表名不能为空' . PHP_EOL);
        }

        $fields = MysqlSingleton::getInstance()->getTableFields($configs['db'], $configs['table']);

        $fileName = $configs['prefix'] . self::transferName($configs['table']) . $configs['suffix'];
        $primaryKey = 'id';
        $filedStr = '';
        foreach ($fields as $eField) {
            if (false !== strpos($eField['Type'], 'int')) {
                $varType = 'int';
                if (null === $eField['Default']) {
                    if ('PRI' == $eField['Key']) {
                        $primaryKey = $eField['Field'];
                        $default = 'null';
                    } else {
                        $default = 'NO' == $eField['Null'] ? '0' : 'null';
                    }
                } else {
                    $default = (int)$eField['Default'];
                }
            } elseif (false !== strpos($eField['Type'], 'float')) {
                $varType = 'float';
                if (null === $eField['Default']) {
                    if ('PRI' == $eField['Key']) {
                        $primaryKey = $eField['Field'];
                        $default = 'null';
                    } else {
                        $default = 'NO' == $eField['Null'] ? '0.00' : 'null';
                    }
                } else {
                    $default = (float)$eField['Default'];
                }
            } elseif (false !== strpos($eField['Type'], 'decimal')) {
                $varType = 'float';
                if (null === $eField['Default']) {
                    if ('PRI' == $eField['Key']) {
                        $primaryKey = $eField['Field'];
                        $default = 'null';
                    } else {
                        $default = 'NO' == $eField['Null'] ? '0.00' : 'null';
                    }
                } else {
                    $default = (float)$eField['Default'];
                }
            } elseif (false !== strpos($eField['Type'], 'double')) {
                $varType = 'float';
                if (null === $eField['Default']) {
                    if ('PRI' == $eField['Key']) {
                        $primaryKey = $eField['Field'];
                        $default = 'null';
                    } else {
                        $default = 'NO' == $eField['Null'] ? '0.00' : 'null';
                    }
                } else {
                    $default = (float)$eField['Default'];
                }
            } else {
                $varType = 'string';
                if (null === $eField['Default']) {
                    if ('PRI' == $eField['Key']) {
                        $primaryKey = $eField['Field'];
                        $default = 'null';
                    } else {
                        $default = 'NO' == $eField['Null'] ? "''" : 'null';
                    }
                } else {
                    $default = "'" . $eField['Default'] . "'";
                }
            }

            $tempComment = trim($eField['Comment']);
            if (\strlen($tempComment) > 0) {
                $commentStr = ' ' . $tempComment;
            } else {
                $commentStr = '';
            }
            $filedStr .= '    /**' . PHP_EOL;
            $filedStr .= '     *' . $commentStr . PHP_EOL;
            $filedStr .= '     * @var ' . $varType . PHP_EOL;
            $filedStr .= '     */' . PHP_EOL;
            $filedStr .= '    public $' . $eField['Field'] . ' = ' . $default . ';' . PHP_EOL;
        }
        if (\strlen($configs['namespace']) > 0) {
            $content = '<?php' . PHP_EOL . 'namespace Entities\\' . $configs['namespace'] . ';' . PHP_EOL . PHP_EOL;
        } else {
            $dbName = MysqlSingleton::getInstance()->getDbName($configs['db']);
            $content = '<?php' . PHP_EOL . 'namespace Entities\\' . self::transferName($dbName) . ';' . PHP_EOL . PHP_EOL;
        }
        $content .= 'use DB\\Entities\\MysqlEntity;' . PHP_EOL . PHP_EOL;
        $content .= 'class ' . $fileName . ' extends MysqlEntity' . PHP_EOL;
        $content .= '{' . PHP_EOL;
        $content .= $filedStr . PHP_EOL;
        $content .= '    public function __construct(string $dbTag = \'\')' . PHP_EOL;
        $content .= '    {' . PHP_EOL;
        $content .= '        $trueTag = isset($dbTag[0]) ? $dbTag : \'' . $configs['db'] . '\';' . PHP_EOL;
        $content .= '        parent::__construct($trueTag, \'' . $configs['table'] . '\', \'' . $primaryKey . '\');' . PHP_EOL;
        $content .= '    }' . PHP_EOL;
        $content .= '}' . PHP_EOL;

        file_put_contents($configs['path'] . $fileName . '.php', $content);
    }
}
