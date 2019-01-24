<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/3/5 0005
 * Time: 12:10
 */
namespace DB\Entities;

use Constant\ErrorCode;
use Exception\Validator\ValidatorException;
use Tool\Tool;

abstract class BaseEntity {
    const DB_TYPE_MYSQL = 'mysql';
    const DB_TYPE_MONGO = 'mongo';

    protected $_dbType = '';
    protected $_dbName = '';
    protected $_container = null;

    private static $_properties = [];
    private $_propVerifyMap = [
        'int' => 'checkPropertyValInt',
        'float' => 'checkPropertyValFloat',
        'array' => 'checkPropertyValArray',
        'double' => 'checkPropertyValDouble',
        'string' => 'checkPropertyValString',
    ];

    public function __construct(){
    }

    /**
     * 获取orm容器
     * @return mixed
     */
    abstract public function getContainer();

    /**
     * 获取实体属性名列表
     * @return array
     */
    public function getEntityProperties() : array {
        $className = get_class($this);
        if(!isset(self::$_properties[$className])){
            self::$_properties[$className] = [];
            $class = new \ReflectionClass($className);
            $vars = get_class_vars($className);
            foreach ($vars as $eKey => $var) {
                $key = trim($eKey);
                if((strlen($key) > 0) && (substr($key, 0, 1) != '_')){
                    $docs = $class->getProperty($key)->getDocComment();
                    self::$_properties[$className][$key] = $this->getPropertyType($docs);
                }
            }

            if($this->_dbType == self::DB_TYPE_MONGO){
                self::$_properties[$className]['_id'] = 'string';
            }
        }

        return self::$_properties[$className];
    }

    /**
     * 初始化实体类
     * @param array $data
     * @return bool
     */
    public function initEntity(array $data) : bool {
        if(!empty($data)){
            $properties = $this->getEntityProperties();
            foreach ($data as $key => $val) {
                if(isset($properties[$key])){
                    $this->$key = $val;
                }
            }

            return true;
        }

        return false;
    }

    /**
     * 获取数组格式实体对象数据
     * @param bool $getNull 是否获取值为null的属性 true:获取 false:不获取
     * @return array
     */
    public function getEntityDataArray(bool $getNull=false) : array {
        $dataArr = [];

        $properties = $this->getEntityProperties();
        foreach ($properties as $propKey => $propVal) {
            if(is_null($this->$propKey) && !$getNull){
                continue;
            }

            $dataArr[$propKey] = $this->$propKey;
        }

        return $dataArr;
    }

    /**
     * 获取实体类属性的类型,即以var注解标明的类型
     * @param string $propertyDoc 实体属性注解说明
     * @return string
     */
    private function getPropertyType(string $propertyDoc) : string {
        $propertyType = '';
        $docs = explode(PHP_EOL, $propertyDoc);
        foreach ($docs as $eDoc) {
            $pos = strpos($eDoc, '@var');
            if($pos !== false){
                $needStr = substr($eDoc, $pos);
                $propertyType = trim(str_replace('@var ', '', $needStr));
                break;
            }
        }

        if((strlen($propertyType) == 0) || (strpos($propertyType, '|') !== false)){
            $propertyType = 'mixed';
        }

        return $propertyType;
    }

    private function checkPropertyValInt(string $propertyName) : string {
        $data = $this->$propertyName;
        if(is_null($data)){
            return '';
        } else if(is_numeric($data)){
            $this->$propertyName = (int)$data;
            return '';
        } else {
            return '必须是整数';
        }
    }

    private function checkPropertyValFloat(string $propertyName) : string {
        $data = $this->$propertyName;
        if(is_null($data)){
            return '';
        } else if(is_numeric($data)){
            $this->$propertyName = (float)$data;
            return '';
        } else {
            return '必须是数字';
        }
    }

    private function checkPropertyValArray(string $propertyName) : string {
        $data = $this->$propertyName;
        if(is_null($data)){
            return '';
        } else if(is_array($data)){
            return '';
        } else {
            return '必须是数组';
        }
    }

    private function checkPropertyValDouble(string $propertyName) : string {
        $data = $this->$propertyName;
        if(is_null($data)){
            return '';
        } else if(is_numeric($data)){
            $this->$propertyName = (double)$data;
            return '';
        } else {
            return '必须是数字';
        }
    }

    private function checkPropertyValString(string $propertyName) : string {
        $data = $this->$propertyName;
        if(is_null($data)){
            return '';
        } else if(is_string($data)){
            return '';
        } else {
            return '必须是字符串';
        }
    }

    /**
     * 校验实体类属性值是否合法
     * @return bool true:合法
     * @throws \Exception\Validator\ValidatorException
     */
    public function verifyEntityProperties() {
        $properties = $this->getEntityProperties();
        foreach ($properties as $propKey => $propVal) {
            $checkFuncName = Tool::getArrayVal($this->_propVerifyMap, $propVal, null);
            if(!is_null($checkFuncName)){
                $checkRes = $this->$checkFuncName($propKey);
                if(strlen($checkRes) > 0){
                    throw new ValidatorException('实体属性' . $propKey . $checkRes, ErrorCode::VALIDATOR_TYPE_ERROR);
                }
            }
        }

        return true;
    }
}