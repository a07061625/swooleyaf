<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getStatusValue()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getStatusKey()
 */
class ModifyUserBusinessBehavior extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStatusValue($value)
    {
        $this->data['StatusValue'] = $value;
        $this->options['query']['statusValue'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStatusKey($value)
    {
        $this->data['StatusKey'] = $value;
        $this->options['query']['statusKey'] = $value;

        return $this;
    }
}
