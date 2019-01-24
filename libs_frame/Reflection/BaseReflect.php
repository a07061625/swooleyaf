<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/3/23 0023
 * Time: 15:44
 */
namespace Reflection;

use Constant\ErrorCode;
use Exception\Reflection\ReflectException;
use Log\Log;
use SyFrame\BaseController;
use Tool\Tool;
use Traits\SimpleTrait;
use Validator\Validator;
use Validator\ValidatorResult;

class BaseReflect {
    use SimpleTrait;

    /**
     * 获取方法自定义注解
     * 自定义注解格式如下：
     *   @name   -    xxx
     *   注解名 分隔符 注解值
     * @param string $className 类全名
     * @param string $methodName 方法名称
     * @return array
     * @throws \Exception\Reflection\ReflectException
     */
    public static function getMethodDefinedAnnotations(string $className,string $methodName) : array {
        $annotations = [];

        try{
            $class = new \ReflectionClass($className);
            $doc = $class->getMethod($methodName)->getDocComment();
            $docs = preg_filter('/\s+/', '', explode(PHP_EOL, $doc));
            foreach ($docs as $eDoc) {
                preg_match('/(\@[a-zA-Z0-9]+)\-(\{\S+\})/', $eDoc, $saveDoc);
                if (!empty($saveDoc)) {
                    if(empty($annotations[$saveDoc[1]])){
                        $annotations[$saveDoc[1]] = [];
                    }

                    $annotations[$saveDoc[1]][] = $saveDoc[2];
                }
            }

            $instance = $class->newInstanceWithoutConstructor();
            if(($instance instanceof BaseController) && $instance->signStatus){
                if(!isset($annotations[Validator::ANNOTATION_NAME])){
                    $annotations[Validator::ANNOTATION_NAME] = [];
                }

                $annotations[Validator::ANNOTATION_NAME][] = '{"field":"' . Validator::ANNOTATION_TAG_SIGN . '","explain":"签名值","type":"string","rules":{"sign":3600,"required":1}}';
            }
        } catch (ReflectException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new ReflectException(ErrorCode::getMsg(ErrorCode::REFLECT_RESOURCE_NOT_EXIST), ErrorCode::REFLECT_RESOURCE_NOT_EXIST);
        }

        return $annotations;
    }

    /**
     * @param string $className 类全名
     * @param string $methodName 方法名称
     * @return array
     * @throws \Exception\Reflection\ReflectException
     */
    public static function getValidatorAnnotations(string $className,string $methodName) : array {
        $resArr = [];
        $annotations = self::getMethodDefinedAnnotations($className, $methodName);
        if (isset($annotations[Validator::ANNOTATION_NAME]) && !empty($annotations[Validator::ANNOTATION_NAME])) {
            $ignoreSign = false;
            foreach ($annotations[Validator::ANNOTATION_NAME] as $eAnnotation) {
                $data = Tool::jsonDecode($eAnnotation);
                if(!is_array($data)){
                    throw new ReflectException('数据校验格式不正确', ErrorCode::REFLECT_ANNOTATION_DATA_ERROR);
                } else if(!is_string($data['field'])){
                    throw new ReflectException('字段名称必须为字符串', ErrorCode::REFLECT_ANNOTATION_DATA_ERROR);
                } else if(!is_string($data['explain'])){
                    throw new ReflectException('字段解释必须为字符串', ErrorCode::REFLECT_ANNOTATION_DATA_ERROR);
                } else if(!is_string($data['type'])){
                    throw new ReflectException('校验器类型必须为字符串', ErrorCode::REFLECT_ANNOTATION_DATA_ERROR);
                } else if(!is_array($data['rules'])){
                    throw new ReflectException('校验规则必须为数组', ErrorCode::REFLECT_ANNOTATION_DATA_ERROR);
                }

                if($data['field'] != Validator::ANNOTATION_TAG_IGNORE_SIGN){
                    $result = new ValidatorResult();
                    $result->setExplain($data['explain']);
                    $result->setField($data['field']);
                    $result->setType($data['type']);
                    $result->setRules($data['rules']);
                    $resArr[$data['field']] = $result;
                } else {
                    $ignoreSign = true;
                }
            }
            if($ignoreSign){
                unset($resArr[Validator::ANNOTATION_TAG_SIGN]);
            }
        }

        return $resArr;
    }
}