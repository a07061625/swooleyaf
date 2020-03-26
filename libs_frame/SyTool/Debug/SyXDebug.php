<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/7/31 0031
 * Time: 14:51
 */
namespace SyTool\Debug;

use SyTrait\SimpleTrait;

final class SyXDebug
{
    use SimpleTrait;

    /**
     * 代码覆盖分析状态
     * @var bool true:开启 false:关闭
     */
    private static $coverageStatus = false;

    /**
     * 开启代码覆盖分析
     * @return bool
     */
    public static function startCoverage()
    {
        if ((!self::$coverageStatus) && xdebug_code_coverage_started()) {
            xdebug_start_code_coverage(XDEBUG_CC_DEAD_CODE | XDEBUG_CC_UNUSED);
            self::$coverageStatus = true;
        }

        return self::$coverageStatus;
    }

    /**
     * 关闭代码覆盖分析
     * @return bool
     */
    public static function stopCoverage()
    {
        if (self::$coverageStatus) {
            xdebug_stop_code_coverage();
            self::$coverageStatus = false;
        }

        return self::$coverageStatus;
    }

    /**
     * 获取代码覆盖分析结果
     * <pre>
     * 分析结果为二维数组,结构如下:
     *   一维: 分析的文件名字
     *   二维: 对应的分析行数
     * 在分析文件的每行代码时，都会产生一个结果码,结果码意义如下:
     *    1：代表代码已经执行
     *   -1：代表代码未被执行
     *   -2：代表没有可执行的代码存在
     * </pre>
     * @return array|bool
     */
    public static function getCoverageResult()
    {
        if (self::$coverageStatus) {
            return xdebug_get_code_coverage();
        }

        return false;
    }
}
