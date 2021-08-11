<?php

namespace AlibabaCloud\Idrsservice;

/**
 * @method string getDescription()
 * @method string getLabel()
 * @method string getName()
 * @method string getId()
 * @method $this withId($value)
 */
class UpdateDepartment extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDescription($value)
    {
        $this->data['Description'] = $value;
        $this->options['form_params']['Description'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLabel($value)
    {
        $this->data['Label'] = $value;
        $this->options['form_params']['Label'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withName($value)
    {
        $this->data['Name'] = $value;
        $this->options['form_params']['Name'] = $value;

        return $this;
    }
}
