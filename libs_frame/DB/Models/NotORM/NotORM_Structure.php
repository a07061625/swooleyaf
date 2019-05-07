<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 17-4-3
 * Time: 下午3:10
 */
namespace DB\Models\NotORM;

interface NotORM_Structure
{
    /**
     * Get primary key of a table in $db->$table()
     * @param string
     * @param mixed $table
     * @return string
     */
    public function getPrimary($table);

    /**
     * Get column holding foreign key in $table[$id]->$name()
     * @param string
     * @param string
     * @param mixed $name
     * @param mixed $table
     * @return string
     */
    public function getReferencingColumn($name, $table);

    /**
     * Get target table in $table[$id]->$name()
     * @param string
     * @param string
     * @param mixed $name
     * @param mixed $table
     * @return string
     */
    public function getReferencingTable($name, $table);

    /**
     * Get column holding foreign key in $table[$id]->$name
     * @param string
     * @param string
     * @param mixed $name
     * @param mixed $table
     * @return string
     */
    public function getReferencedColumn($name, $table);

    /**
     * Get table holding foreign key in $table[$id]->$name
     * @param string
     * @param string
     * @param mixed $name
     * @param mixed $table
     * @return string
     */
    public function getReferencedTable($name, $table);

    /**
     * Get sequence name, used by insert
     * @param string
     * @param mixed $table
     * @return string
     */
    public function getSequence($table);
}
