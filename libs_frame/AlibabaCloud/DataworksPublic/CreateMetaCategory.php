<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getName()
 * @method string getComment()
 * @method string getParentId()
 */
class CreateMetaCategory extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withName($value)
    {
        $this->data['Name'] = $value;
        $this->options['form_params']['Name'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withComment($value)
    {
        $this->data['Comment'] = $value;
        $this->options['form_params']['Comment'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withParentId($value)
    {
        $this->data['ParentId'] = $value;
        $this->options['form_params']['ParentId'] = $value;

        return $this;
    }
}
