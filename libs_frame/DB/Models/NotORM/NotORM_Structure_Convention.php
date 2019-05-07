<?php
/**
 * Structure described by some rules
 */
namespace DB\Models\NotORM;

class NotORM_Structure_Convention implements NotORM_Structure
{
    protected $primary;
    protected $foreign;
    protected $table;
    protected $dbName;
    protected $prefix;

    /**
     * Create conventional structure
     * @param string %s stands for table name
     * @param string %1$s stands for key used after ->, %2$s for table name
     * @param string %1$s stands for key used after ->, %2$s for table name
     * @param string prefix for all tables
     * @param mixed $primary
     * @param mixed $foreign
     * @param mixed $table
     * @param mixed $prefix
     */
    public function __construct($primary = 'id', $foreign = '%s_id', $table = '%s', $prefix = '')
    {
        $needArr = explode('.', $table);
        $this->primary = $primary;
        $this->foreign = $foreign;
        $this->dbName = $needArr[0];
        $this->table = $needArr[1];
        $this->prefix = $prefix;
    }

    public function getPrimary($table)
    {
        return sprintf($this->primary, $this->getColumnFromTable($table));
    }

    public function getReferencingColumn($name, $table)
    {
        return $this->getReferencedColumn(substr($table, strlen($this->prefix)), $this->prefix . $name);
    }

    public function getReferencingTable($name, $table)
    {
        return '`' . $this->dbName . '`.`' . $this->prefix . $name . '`';
    }

    public function getReferencedColumn($name, $table)
    {
        return sprintf($this->foreign, $this->getColumnFromTable($name), substr($table, strlen($this->prefix)));
    }

    public function getReferencedTable($name, $table)
    {
        return $this->prefix . sprintf($this->table, $name, $table);
    }

    public function getSequence($table)
    {
    }

    protected function getColumnFromTable($name)
    {
        if ($this->table != '%s' && preg_match('(^' . str_replace('%s', '(.*)', preg_quote($this->table)) . '$)', $name, $match)) {
            return $match[1];
        }
        return $name;
    }
}
