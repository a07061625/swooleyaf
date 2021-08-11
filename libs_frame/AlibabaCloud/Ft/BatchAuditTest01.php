<?php

namespace AlibabaCloud\Ft;

/**
 * @method string getDemo01()
 * @method $this withDemo01($value)
 * @method string getTest010101()
 * @method string getName()
 * @method $this withName($value)
 * @method string getBatchAuditTest01()
 * @method $this withBatchAuditTest01($value)
 */
class BatchAuditTest01 extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTest010101($value)
    {
        $this->data['Test010101'] = $value;
        $this->options['form_params']['Test010101'] = $value;

        return $this;
    }
}
