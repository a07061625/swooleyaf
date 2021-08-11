<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getBeginDate()
 * @method string getEndDate()
 * @method string getProjectId()
 */
class ListInstanceAmount extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBeginDate($value)
    {
        $this->data['BeginDate'] = $value;
        $this->options['form_params']['BeginDate'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEndDate($value)
    {
        $this->data['EndDate'] = $value;
        $this->options['form_params']['EndDate'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectId($value)
    {
        $this->data['ProjectId'] = $value;
        $this->options['form_params']['ProjectId'] = $value;

        return $this;
    }
}
