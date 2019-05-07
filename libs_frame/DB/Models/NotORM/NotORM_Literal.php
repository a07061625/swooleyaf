<?php
/**
 * SQL literal value
 */
namespace DB\Models\NotORM;

class NotORM_Literal
{
    /** @var array */
    public $parameters = [];
    protected $value = '';

    /**
     * Create literal value
     * @param string
     * @param mixed parameter
     * @param mixed ...
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
        $this->parameters = func_get_args();
        array_shift($this->parameters);
    }

    /**
     * Get literal value
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }
}
