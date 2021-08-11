<?php

namespace AlibabaCloud\Cms;

/**
 * @method array getId()
 */
class DisableHostAvailability extends Rpc
{
    /**
     * @return $this
     */
    public function withId(array $id)
    {
        $this->data['Id'] = $id;
        foreach ($id as $i => $iValue) {
            $this->options['query']['Id.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
