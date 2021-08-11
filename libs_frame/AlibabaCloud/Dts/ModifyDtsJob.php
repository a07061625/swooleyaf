<?php

namespace AlibabaCloud\Dts;

/**
 * @method string getDbList()
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDtsInstanceId()
 * @method $this withDtsInstanceId($value)
 * @method string getSynchronizationDirection()
 * @method $this withSynchronizationDirection($value)
 */
class ModifyDtsJob extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDbList($value)
    {
        $this->data['DbList'] = $value;
        $this->options['form_params']['DbList'] = $value;

        return $this;
    }
}
