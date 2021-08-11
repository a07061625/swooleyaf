<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getChangeOrderId()
 */
class AbortChangeOrder extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/sam/changeorder/AbortChangeOrder';

    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withChangeOrderId($value)
    {
        $this->data['ChangeOrderId'] = $value;
        $this->options['query']['ChangeOrderId'] = $value;

        return $this;
    }
}
