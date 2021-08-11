<?php

namespace AlibabaCloud\NAS;

/**
 * @method string getVolume()
 * @method $this withVolume($value)
 * @method string getPath()
 * @method $this withPath($value)
 * @method string getHour()
 * @method $this withHour($value)
 * @method string getName()
 * @method $this withName($value)
 * @method string getWeekday()
 * @method $this withWeekday($value)
 * @method string getType()
 * @method $this withType($value)
 * @method string getRecursive()
 * @method $this withRecursive($value)
 * @method string getEnabled()
 * @method $this withEnabled($value)
 * @method string getPolicy()
 * @method $this withPolicy($value)
 */
class ModifyTieringJob extends Rpc
{
    /** @var string */
    public $method = 'PUT';
}
