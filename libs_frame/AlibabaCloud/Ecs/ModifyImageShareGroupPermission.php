<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getImageId()
 * @method $this withImageId($value)
 * @method string getAddGroup1()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getRemoveGroup1()
 */
class ModifyImageShareGroupPermission extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAddGroup1($value)
    {
        $this->data['AddGroup1'] = $value;
        $this->options['query']['AddGroup.1'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRemoveGroup1($value)
    {
        $this->data['RemoveGroup1'] = $value;
        $this->options['query']['RemoveGroup.1'] = $value;

        return $this;
    }
}
