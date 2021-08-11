<?php

namespace AlibabaCloud\EHPC;

/**
 * @method string getImageId()
 * @method $this withImageId($value)
 * @method array getInstance()
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getClusterId()
 * @method $this withClusterId($value)
 * @method string getJobQueue()
 * @method $this withJobQueue($value)
 * @method string getImageOwnerAlias()
 * @method $this withImageOwnerAlias($value)
 */
class AddExistedNodes extends Rpc
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
