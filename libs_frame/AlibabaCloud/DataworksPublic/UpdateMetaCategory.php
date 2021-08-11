<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getName()
 * @method string getComment()
 * @method string getCategoryId()
 */
class UpdateMetaCategory extends Rpc
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
    public function withCategoryId($value)
    {
        $this->data['CategoryId'] = $value;
        $this->options['form_params']['CategoryId'] = $value;

        return $this;
    }
}
