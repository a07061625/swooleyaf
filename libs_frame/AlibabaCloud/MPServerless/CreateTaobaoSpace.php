<?php

namespace AlibabaCloud\MPServerless;

/**
 * @method string getSpaceName()
 * @method string getCellId()
 * @method string getSpaceDesc()
 */
class CreateTaobaoSpace extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSpaceName($value)
    {
        $this->data['SpaceName'] = $value;
        $this->options['form_params']['SpaceName'] = $value;

        return $this;
    }

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
    public function withSpaceDesc($value)
    {
        $this->data['SpaceDesc'] = $value;
        $this->options['form_params']['SpaceDesc'] = $value;

        return $this;
    }
}
