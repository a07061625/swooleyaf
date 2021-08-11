<?php

namespace AlibabaCloud\Ft;

/**
 * @method string getNames()
 */
class TestFlowStrategy01 extends Rpc
{
    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNames($value)
    {
        $this->data['Names'] = $value;
        $this->options['form_params']['Names'] = $value;

        return $this;
    }
}
