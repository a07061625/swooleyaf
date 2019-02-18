<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/3/23 0023
 * Time: 15:44
 */
namespace Reflection;

use Constant\ErrorCode;
use Constant\Server;
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
     * 获取控制器过滤器注解
     * 过滤器注解格式如下：
     *   name   -    xxx
     *   注解名 分隔符 注解值
     * @param string $className 类全名
     * @param string $methodName 方法名称
     * @param string $controllerType
     * @return array
     * @throws \Exception\Reflection\ReflectException
     */
    public static function getControllerFilterAnnotations(string $className,string $methodName,string &$controllerType) : array {
        $annotations = [];

        try{
            $class = new \ReflectionClass($className);
            $instance = $class->newInstanceWithoutConstructor();
            if ($instance instanceof BaseController) {
                $doc = $class->getMethod($methodName)->getDocComment();
                $docs = preg_filter('/\s+/', '', explode(PHP_EOL, $doc));
                foreach ($docs as $eDoc) {
                    preg_match('/(\@[a-zA-Z0-9]+)\-(\{\S+\})/', $eDoc, $saveDoc);
                    if (isset($saveDoc[1]) && ($saveDoc[1] == Validator::ANNOTATION_NAME)) {
                        $annotations[] = $saveDoc[2];
                    }
                }

                if (SY_SERVER_TYPE == Server::SERVER_TYPE_API_GATE) {
                    $controllerType = $instance->signStatus ? 'a1' : 'a2';
                } else if (SY_SERVER_TYPE == Server::SERVER_TYPE_API_MODULE) {
                    $controllerType = 'b1';
                } else {
                    $controllerType = 'c1';
                }
            } else {
                $controllerType = '';
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
        $controllerType = '';
        $annotations = self::getControllerFilterAnnotations($className, $methodName, $controllerType);
        if (strlen($controllerType) > 0) {
            if (!empty($annotations)) {
                foreach ($annotations as $eAnnotation) {
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

                    if ($data['field'] != Validator::ANNOTATION_TAG_IGNORE_SIGN) {
                        if ($data['field'] != Validator::ANNOTATION_TAG_SIGN) {
                            $result = new ValidatorResult();
                            $result->setExplain($data['explain']);
                            $result->setField($data['field']);
                            $result->setType($data['type']);
                            $result->setRules($data['rules']);
                            $resArr[$data['field']] = $result;
                        }
                    } else if ($controllerType == 'a1') {
                        $controllerType = 'a2';
                    }
                }
            }

            if ($controllerType == 'b1') {
                unset($resArr[Validator::ANNOTATION_TAG_SY_TOKEN]);
            } else {
                $tokenResult = new ValidatorResult();
                $tokenResult->setExplain('令牌');
                $tokenResult->setField(Validator::ANNOTATION_TAG_SY_TOKEN);
                $tokenResult->setType('string');
                $tokenResult->setRules([
                    'sytoken' => 1,
                ]);
                $resArr[Validator::ANNOTATION_TAG_SY_TOKEN] = $tokenResult;

                if ($controllerType == 'a1') {
                    $signResult = new ValidatorResult();
                    $signResult->setExplain('签名值');
                    $signResult->setField(Validator::ANNOTATION_TAG_SIGN);
                    $signResult->setType('string');
                    $signResult->setRules([
                        'sign' => 3600,
                        'required' => 1,
                    ]);
                    $resArr[Validator::ANNOTATION_TAG_SIGN] = $signResult;
                }
            }
        }

        return $resArr;
    }
}