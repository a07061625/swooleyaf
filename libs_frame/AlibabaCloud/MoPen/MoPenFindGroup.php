<?php

namespace AlibabaCloud\MoPen;

/**
 * @method string getCreator()
 */
class MoPenFindGroup extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCreator($value)
    {
        $this->data['Creator'] = $value;
        $this->options['form_params']['Creator'] = $value;

        return $this;
    }
}
