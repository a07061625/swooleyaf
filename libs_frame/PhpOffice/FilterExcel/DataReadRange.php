<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/5/4 0004
 * Time: 17:09
 */
namespace PhpOffice\FilterExcel;

/**
 * Class DataReadRange
 * 限制读取数据的范围,在Reader调用load加载文件之前先调用setReadFilter
 * 参考链接: https://blog.csdn.net/YQXLLWY/article/details/89578114
 * @package PhpOffice\FilterExcel
 */
class DataReadRange implements \PHPExcel_Reader_IReadFilter
{
    protected $workerSheetName;
    protected $columns;
    protected $endRow;

    public function __construct($workerSheetName,array $columns,int $endRow = 0)
    {
        $this->workerSheetName = $workerSheetName;
        $this->endRow = $endRow;
        $this->columns = [];
        foreach ($columns as $column) {
            if(ctype_alpha($column)){
                $this->columns[strtoupper($column)] = 1;
            }
        }
    }

    /**
     * @param string $column 当前列数
     * @param int $row 当前行数
     * @param string $worksheetName 表名
     * @return bool
     */
    public function readCell($column, $row, $worksheetName = '')
    {
        if (is_array($this->workerSheetName)) {// 设置了多个表空间
            if (!in_array($worksheetName, $this->workerSheetName)) {
                return false;
            }
        } else if ($worksheetName != $this->workerSheetName) {// 只设置了一个表空间
            return false;
        }
        // 设置了截止行,且当前行超过了指定行
        if (($this->endRow != 0) && ($row > $this->endRow)) {
            return false;
        }
        if (!isset($this->columns[$column])) {
            return false;
        }

        return true;
    }
}
