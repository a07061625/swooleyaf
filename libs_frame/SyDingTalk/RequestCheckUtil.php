<?php

namespace SyDingTalk;

use function mb_strlen;

/**
 * API入参静态检查类
 * 可以对API的参数类型、长度、最大值等进行校验
 */
class RequestCheckUtil
{
    /**
     * 校验字段 fieldName 的值$value非空
     *
     **@throws \Exception
     *
     * @param mixed $value
     * @param mixed $fieldName
     */
    public static function checkNotNull($value, $fieldName)
    {
        if (self::checkEmpty($value)) {
            throw new \Exception('client-check-error:Missing Required Arguments: ' . $fieldName, 40);
        }
    }

    /**
     * 检验字段fieldName的值value 的长度
     *
     **@throws \Exception
     *
     * @param mixed $value
     * @param mixed $maxLength
     * @param mixed $fieldName
     */
    public static function checkMaxLength($value, $maxLength, $fieldName)
    {
        if (!self::checkEmpty($value) && mb_strlen($value, 'UTF-8') > $maxLength) {
            throw new \Exception(
                'client-check-error:Invalid Arguments:the length of ' . $fieldName
                        . ' can not be larger than ' . $maxLength,
                41
            );
        }
    }

    /**
     * 检验字段fieldName的值value的最大列表长度
     *
     **@throws \Exception
     *
     * @param mixed $value
     * @param mixed $maxSize
     * @param mixed $fieldName
     */
    public static function checkMaxListSize($value, $maxSize, $fieldName)
    {
        if (self::checkEmpty($value)) {
            return;
        }

        $list = preg_split('/,/', $value);
        if (\count($list) > $maxSize) {
            throw new \Exception(
                'client-check-error:Invalid Arguments:the listsize(the string split by ",") of ' . $fieldName
                        . ' must be less than ' . $maxSize,
                41
            );
        }
    }

    /**
     * 检验字段fieldName的值value 的最大值
     *
     **@throws \Exception
     *
     * @param mixed $value
     * @param mixed $maxValue
     * @param mixed $fieldName
     */
    public static function checkMaxValue($value, $maxValue, $fieldName)
    {
        if (self::checkEmpty($value)) {
            return;
        }

        self::checkNumeric($value, $fieldName);

        if ($value > $maxValue) {
            throw new \Exception(
                'client-check-error:Invalid Arguments:the value of ' . $fieldName
                        . ' can not be larger than ' . $maxValue,
                41
            );
        }
    }

    /**
     * 检验字段fieldName的值value 的最小值
     *
     **@throws \Exception
     *
     * @param mixed $value
     * @param mixed $minValue
     * @param mixed $fieldName
     */
    public static function checkMinValue($value, $minValue, $fieldName)
    {
        if (self::checkEmpty($value)) {
            return;
        }

        self::checkNumeric($value, $fieldName);

        if ($value < $minValue) {
            throw new \Exception(
                'client-check-error:Invalid Arguments:the value of ' . $fieldName
                        . ' can not be less than ' . $minValue,
                41
            );
        }
    }

    /**
     * 校验$value是否非空
     *
     * @param mixed $value
     */
    public static function checkEmpty($value)
    {
        if (!isset($value)) {
            return true;
        }
        if (\is_array($value) && 0 == \count($value)) {
            return true;
        }
        if (\is_string($value) && '' === trim($value)) {
            return true;
        }

        return false;
    }

    /**
     * 检验字段fieldName的值value是否是number
     *
     **@throws \Exception
     *
     * @param mixed $value
     * @param mixed $fieldName
     */
    protected static function checkNumeric($value, $fieldName)
    {
        if (!is_numeric($value)) {
            throw new \Exception(
                'client-check-error:Invalid Arguments:the value of ' . $fieldName
                        . ' is not number : ' . $value,
                41
            );
        }
    }
}
