<?php

namespace AlibabaCloud\MPServerless;

/**
 * @method string getCellId()
 * @method string getSpaceId()
 */
class DescribeTaobaoSpace extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCellId($value)
    {
        $this->data['CellId'] = $value;
        $this->options['form_params']['CellId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSpaceId($value)
    {
        $this->data['SpaceId'] = $value;
        $this->options['form_params']['SpaceId'] = $value;

        return $this;
    }
}
