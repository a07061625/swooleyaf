<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/3/23 0023
 * Time: 15:44
 */
namespace Reflection;

use SyConstant\ErrorCode;
use SyConstant\SyInner;
use SyException\Reflection\ReflectException;
use Log\Log;
use SyFrame\BaseController;
use Tool\Tool;
use SyTrait\SimpleTrait;
use Validator\ValidatorResult;

class BaseReflect
{
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
     * @throws \SyException\Reflection\ReflectException
     */
    public static function getControllerFilterAnnotations(string $className, string $methodName, string &$controllerType) : array
    {
        $annotations = [];

        try {
            $class = new \ReflectionClass($className);
            $instance = $class->newInstanceWithoutConstructor();
            if ($instance instanceof BaseController) {
                $doc = $class->getMethod($methodName)->getDocComment();
                $docs = preg_filter('/\s+/', '', explode(PHP_EOL, $doc));
                foreach ($docs as $eDoc) {
                    preg_match('/\@([a-zA-Z0-9]+)\-(\{\S+\})/', $eDoc, $saveDoc);
                    if (isset($saveDoc[1]) && ($saveDoc[1] == SyInner::ANNOTATION_NAME_FILTER)) {
                        $annotations[] = $saveDoc[2];
                    }
                }

                if (SY_SERVER_TYPE == SyInner::SERVER_TYPE_API_GATE) {
                    $controllerType = $instance->signStatus ? 'a1' : 'a2';
                } elseif (SY_SERVER_TYPE == SyInner::SERVER_TYPE_API_MODULE) {
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
     * 获取控制器切面注解
     * 切面注解格式如下：
     *   name   -    xxx
     *   注解名 分隔符 切面类全名,以\开头
     * @param string $className 类全名
     * @param string $methodName 方法名称
     * @return array
     * @throws \SyException\Reflection\ReflectException
     */
    public static function getControllerAspectAnnotations(string $className, string $methodName) : array
    {
        $annotations = [
            'before' => [],
            'after' => [],
        ];

        try {
            $class = new \ReflectionClass($className);
            $instance = $class->newInstanceWithoutConstructor();
            if ($instance instanceof BaseController) {
                $doc = $class->getMethod($methodName)->getDocComment();
                $docs = preg_filter('/\s+/', '', explode(PHP_EOL, $doc));
                foreach ($docs as $eDoc) {
                    preg_match('/\@([a-zA-Z0-9]+)\-(\S+)/', $eDoc, $saveDoc);
                    if (isset($saveDoc[1])) {
                        if ($saveDoc[1] == SyInner::ANNOTATION_NAME_ASPECT) {
                            $annotations['before'][] = $saveDoc[2];
                            $annotations['after'][] = $saveDoc[2];
                        } elseif ($saveDoc[1] == SyInner::ANNOTATION_NAME_ASPECT_BEFORE) {
                            $annotations['before'][] = $saveDoc[2];
                        } elseif ($saveDoc[1] == SyInner::ANNOTATION_NAME_ASPECT_AFTER) {
                            $annotations['after'][] = $saveDoc[2];
                        }
                    }
                }
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
     * @throws \SyException\Reflection\ReflectException
     */
    public static function getValidatorAnnotations(string $className, string $methodName) : array
    {
        $controllerType = '';
        $annotations = self::getControllerFilterAnnotations($className, $methodName, $controllerType);
        if (strlen($controllerType) == 0) {
            return [];
        }

        $resArr = [];
        $ignoreJwt = false;
        foreach ($annotations as $eAnnotation) {
            $data = Tool::jsonDecode($eAnnotation);
            if (!is_array($data)) {
                throw new ReflectException('数据校验格式不正确', ErrorCode::REFLECT_ANNOTATION_DATA_ERROR);
            } elseif (!is_string($data['field'])) {
                throw new ReflectException('字段名称必须为字符串', ErrorCode::REFLECT_ANNOTATION_DATA_ERROR);
            } elseif (!is_string($data['explain'])) {
                throw new ReflectException('字段解释必须为字符串', ErrorCode::REFLECT_ANNOTATION_DATA_ERROR);
            } elseif (!is_string($data['type'])) {
                throw new ReflectException('校验器类型必须为字符串', ErrorCode::REFLECT_ANNOTATION_DATA_ERROR);
            } elseif (!is_array($data['rules'])) {
                throw new ReflectException('校验规则必须为数组', ErrorCode::REFLECT_ANNOTATION_DATA_ERROR);
            }

            if (!isset(SyInner::$annotationSignTags[$data['field']])) {
                $result = new ValidatorResult();
                $result->setExplain($data['explain']);
                $result->setField($data['field']);
                $result->setType($data['type']);
                $result->setRules($data['rules']);
                $resArr[$data['field']] = $result;
            } elseif (($data['field'] == SyInner::ANNOTATION_TAG_IGNORE_SIGN) && ($controllerType == 'a1')) {
                $controllerType = 'a2';
            } elseif ($data['field'] == SyInner::ANNOTATION_TAG_IGNORE_JWT) {
                $ignoreJwt = true;
            }
        }

        if (SY_SERVER_TYPE == SyInner::SERVER_TYPE_FRONT_GATE) {
            $jwtStatus = 0;
        } elseif (SY_SERVER_TYPE == SyInner::SERVER_TYPE_API_GATE) {
            $jwtStatus = $ignoreJwt ? 2 : 1;
        } else {
            $jwtStatus = 2;
        }
        if ($jwtStatus == 1) {
            $jwtResult = new ValidatorResult();
            $jwtResult->setExplain('JWT会话');
            $jwtResult->setField(SyInner::ANNOTATION_TAG_SESSION_JWT);
            $jwtResult->setType('string');
            $jwtResult->setRules([
                'jwt' => $jwtStatus,
            ]);
            $resArr[SyInner::ANNOTATION_TAG_SESSION_JWT] = $jwtResult;
        }
        if ($controllerType == 'b1') {
            unset($resArr[SyInner::ANNOTATION_TAG_SY_TOKEN]);
        } else {
            $tokenResult = new ValidatorResult();
            $tokenResult->setExplain('令牌');
            $tokenResult->setField(SyInner::ANNOTATION_TAG_SY_TOKEN);
            $tokenResult->setType('string');
            $tokenResult->setRules([
                'sytoken' => 1,
            ]);
            $resArr[SyInner::ANNOTATION_TAG_SY_TOKEN] = $tokenResult;

            if ($controllerType == 'a1') {
                $signResult = new ValidatorResult();
                $signResult->setExplain('签名值');
                $signResult->setField(SyInner::ANNOTATION_TAG_SIGN);
                $signResult->setType('string');
                $signResult->setRules([
                    'sign' => 3600,
                    'required' => 1,
                ]);
                $resArr[SyInner::ANNOTATION_TAG_SIGN] = $signResult;
            }
        }

        return $resArr;
    }
}
