<?php

namespace AlibabaCloud\Workorder;

/**
 * @method string getSeverity()
 * @method string getDescription()
 * @method string getCategoryId()
 */
class CreateTicket extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSeverity($value)
    {
        $this->data['Severity'] = $value;
        $this->options['form_params']['Severity'] = $value;

        return $this;
    }

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
    public function withCategoryId($value)
    {
        $this->data['CategoryId'] = $value;
        $this->options['form_params']['CategoryId'] = $value;

        return $this;
    }
}
