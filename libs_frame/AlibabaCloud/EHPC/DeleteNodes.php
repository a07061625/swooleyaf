<?php

namespace AlibabaCloud\EHPC;

/**
 * @method array getInstance()
 * @method string getClusterId()
 * @method $this withClusterId($value)
 * @method string getReleaseInstance()
 * @method $this withReleaseInstance($value)
 */
class DeleteNodes extends Rpc
{
    /**
     * @return $this
     */
    public function withInstance(array $instance)
    {
        $this->data['Instance'] = $instance;
        foreach ($instance as $depth1 => $depth1Value) {
            if (isset($depth1Value['Id'])) {
                $this->options['query']['Instance.' . ($depth1 + 1) . '.Id'] = $depth1Value['Id'];
            }
        }

        return $this;
    }
}
