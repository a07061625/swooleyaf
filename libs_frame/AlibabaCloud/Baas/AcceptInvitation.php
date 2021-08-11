<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getCode()
 * @method string getIsAccepted()
 */
class AcceptInvitation extends Rpc
{
    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCode($value)
    {
        $this->data['Code'] = $value;
        $this->options['form_params']['Code'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIsAccepted($value)
    {
        $this->data['IsAccepted'] = $value;
        $this->options['form_params']['IsAccepted'] = $value;

        return $this;
    }
}
