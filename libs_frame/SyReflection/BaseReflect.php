<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/3/23 0023
 * Time: 15:44
 */

namespace SyReflection;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyConstant\SyInner;
use SyException\Validator\ValidatorException;
use SyFrame\BaseController;
use SyLog\Log;
use SyTool\Tool;
use SyTrait\SimpleTrait;
use Validator\ValidatorResult;

class BaseReflect
{
    use SimpleTrait;

    /**
     * 获取控制器过滤器
     * 过滤器注解格式如下：
     *   name   -    xxx
     *   注解名 分隔符 注解值(json格式)
     *
     * @param string $className  类全名
     * @param string $methodName 方法名称
     *
     * @throws \SyException\Validator\ValidatorException
     */
    public static function getControllerFilters(string $className, string $methodName): array
    {
        $annotations = [];
        //控制器签名标识
        $controllerSign = 0;

        try {
            $class = new \ReflectionClass($className);
            $instance = $class->newInstanceWithoutConstructor();
            if ($instance instanceof BaseController) {
                $controllerSign = $instance->signStatus ? 1 : 0;
                $doc = $class->getMethod($methodName)->getDocComment();
                $docs = preg_filter('/\s+/', '', explode(PHP_EOL, $doc));
                foreach ($docs as $eDoc) {
                    preg_match('/\@([a-zA-Z0-9]+)\-(\{\S+\})/', $eDoc, $saveDoc);
                    $filterName = $saveDoc[1] ?? '';
                    if (SyInner::ANNOTATION_NAME_FILTER != $filterName) {
                        continue;
                    }

                    $filterInfo = self::parseFilterDoc($saveDoc[2]);
                    $annotations[$filterInfo['field']] = $filterInfo;
                }
            }
        } catch (ValidatorException $e) {
            throw $e;
        } catch (\Throwable $e) {
            Log::error($e->getMessage());

            throw new ValidatorException('获取过滤器异常', ErrorCode::REFLECT_ANNOTATION_DATA_ERROR);
        }

        $managerRules = [];
        if (SY_SERVER_TYPE == SyInner::SERVER_TYPE_API_GATE) {
            if (isset($annotations[SyInner::ANNOTATION_TAG_SY_MANAGER])) {
                $existRules = $annotations[SyInner::ANNOTATION_TAG_SY_MANAGER]['rules'];
            } else {
                $existRules = [];
            }

            //请求频率
            $requestRate = $existRules[ProjectBase::VALIDATOR_TAG_REQUEST_RATE] ?? 0;
            if (\is_int($requestRate) && ($requestRate > 0)) {
                $managerRules[ProjectBase::VALIDATOR_TAG_REQUEST_RATE] = $requestRate;
            }

            //接口签名
            $requestSign = $existRules[ProjectBase::VALIDATOR_TAG_SIGN] ?? $controllerSign;
            if ($requestSign) {
                $managerRules[ProjectBase::VALIDATOR_TAG_SIGN] = 1;
            }

            //jwt验证
            $jwtAuth = $existRules[ProjectBase::VALIDATOR_TAG_JWT] ?? 0;
            if ($jwtAuth) {
                $managerRules[ProjectBase::VALIDATOR_TAG_JWT] = 1;
            }

            //令牌验证
            $managerRules[ProjectBase::VALIDATOR_TAG_FRAME_TOKEN] = 1;
            //接口限制
            $apiLimit = $existRules[ProjectBase::VALIDATOR_TAG_API_LIMIT] ?? 1;
            if ($apiLimit) {
                $managerRules[ProjectBase::VALIDATOR_TAG_API_LIMIT] = 1;
            }
        }
        if (\count($managerRules) > 0) {
            $annotations[SyInner::ANNOTATION_TAG_SY_MANAGER] = [
                'field' => SyInner::ANNOTATION_TAG_SY_MANAGER,
                'explain' => '接口过滤器管理',
                'type' => ProjectBase::VALIDATOR_DATA_TYPE_STRING,
                'rules' => $managerRules,
            ];
        } else {
            unset($annotations[SyInner::ANNOTATION_TAG_SY_MANAGER]);
        }

        $filters = [];
        foreach ($annotations as $eAnnotation) {
            $result = new ValidatorResult();
            $result->setField($eAnnotation['field']);
            $result->setExplain($eAnnotation['explain']);
            $result->setType($eAnnotation['type']);
            $result->setRules($eAnnotation['rules']);
            $filters[$eAnnotation['field']] = $result;
        }

        return $filters;
    }

    /**
     * 获取控制器切面
     * 切面注解格式如下：
     *   name   -    xxx
     *   注解名 分隔符 切面类全名,以\开头
     *
     * @param string $className  类全名
     * @param string $methodName 方法名称
     *
     * @throws \SyException\Validator\ValidatorException
     */
    public static function getControllerAspects(string $className, string $methodName): array
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
                    if (!isset($saveDoc[1])) {
                        continue;
                    }
                    if (SyInner::ANNOTATION_NAME_ASPECT == $saveDoc[1]) {
                        $annotations['before'][] = $saveDoc[2];
                        $annotations['after'][] = $saveDoc[2];
                    } elseif (SyInner::ANNOTATION_NAME_ASPECT_BEFORE == $saveDoc[1]) {
                        $annotations['before'][] = $saveDoc[2];
                    } elseif (SyInner::ANNOTATION_NAME_ASPECT_AFTER == $saveDoc[1]) {
                        $annotations['after'][] = $saveDoc[2];
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getCode(), $e->getTraceAsString());

            throw new ValidatorException('获取切面异常', ErrorCode::REFLECT_RESOURCE_NOT_EXIST);
        }

        return $annotations;
    }

    /**
     * 解析过滤器注解文档
     *
     * @param string $filterDoc 过滤器注解
     *
     * @throws \SyException\Validator\ValidatorException
     */
    private static function parseFilterDoc(string $filterDoc): array
    {
        $filterData = Tool::jsonDecode($filterDoc);
        if (\is_bool($filterData)) {
            throw new ValidatorException('数据校验格式不正确', ErrorCode::REFLECT_ANNOTATION_DATA_ERROR);
        }

        $filterDataField = \is_string($filterData['field']) ? $filterData['field'] : '';
        if (0 == \strlen($filterDataField)) {
            throw new ValidatorException('字段名称不合法', ErrorCode::REFLECT_ANNOTATION_DATA_ERROR);
        }

        $filterDataExplain = \is_string($filterData['explain']) ? $filterData['explain'] : '';
        if (0 == \strlen($filterDataExplain)) {
            throw new ValidatorException('字段解释不合法', ErrorCode::REFLECT_ANNOTATION_DATA_ERROR);
        }

        $filterDataType = \is_string($filterData['type']) ? $filterData['type'] : '';
        if (!isset(ProjectBase::$totalValidatorDataTypes[$filterDataType])) {
            throw new ValidatorException('校验器类型不合法', ErrorCode::REFLECT_ANNOTATION_DATA_ERROR);
        }

        $filterDataRules = \is_array($filterData['rules']) ? $filterData['rules'] : [];
        if (SyInner::ANNOTATION_TAG_SY_MANAGER != $filterDataField) {
            unset($filterDataRules[ProjectBase::VALIDATOR_TAG_JWT], $filterDataRules[ProjectBase::VALIDATOR_TAG_SIGN], $filterDataRules[ProjectBase::VALIDATOR_TAG_FRAME_TOKEN], $filterDataRules[ProjectBase::VALIDATOR_TAG_REQUEST_RATE], $filterDataRules[ProjectBase::VALIDATOR_TAG_API_LIMIT]);
        }
        if (0 == \count($filterDataRules)) {
            throw new ValidatorException('校验规则不合法', ErrorCode::REFLECT_ANNOTATION_DATA_ERROR);
        }

        return [
            'field' => $filterDataField,
            'explain' => $filterDataExplain,
            'type' => $filterDataType,
            'rules' => $filterDataRules,
        ];
    }
}
