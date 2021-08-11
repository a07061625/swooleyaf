<?php

namespace AlibabaCloud\Ess;

/**
 * @method string getLifecycleActionToken()
 * @method string getHeartbeatTimeout()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getLifecycleHookId()
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class RecordLifecycleActionHeartbeat extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLifecycleActionToken($value)
    {
        $this->data['LifecycleActionToken'] = $value;
        $this->options['query']['lifecycleActionToken'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withHeartbeatTimeout($value)
    {
        $this->data['HeartbeatTimeout'] = $value;
        $this->options['query']['heartbeatTimeout'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLifecycleHookId($value)
    {
        $this->data['LifecycleHookId'] = $value;
        $this->options['query']['lifecycleHookId'] = $value;

        return $this;
    }
}
