<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getProjectName()
 * @method string getPageSize()
 * @method string getEntityId()
 * @method string getPageNumber()
 */
class ListQualityRules extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectName($value)
    {
        $this->data['ProjectName'] = $value;
        $this->options['form_params']['ProjectName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageSize($value)
    {
        $this->data['PageSize'] = $value;
        $this->options['form_params']['PageSize'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEntityId($value)
    {
        $this->data['EntityId'] = $value;
        $this->options['form_params']['EntityId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageNumber($value)
    {
        $this->data['PageNumber'] = $value;
        $this->options['form_params']['PageNumber'] = $value;

        return $this;
    }
}
