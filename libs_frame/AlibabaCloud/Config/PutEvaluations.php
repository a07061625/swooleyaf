<?php

namespace AlibabaCloud\Config;

/**
 * @method string getEvaluations()
 * @method string getResultToken()
 */
class PutEvaluations extends Rpc
{
    /** @var string */
    public $method = 'POST';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEvaluations($value)
    {
        $this->data['Evaluations'] = $value;
        $this->options['form_params']['Evaluations'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withResultToken($value)
    {
        $this->data['ResultToken'] = $value;
        $this->options['form_params']['ResultToken'] = $value;

        return $this;
    }
}
