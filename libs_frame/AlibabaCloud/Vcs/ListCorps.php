<?php

namespace AlibabaCloud\Vcs;

/**
 * @method string getPageNumber()
 * @method string getPageSize()
 * @method string getCorpName()
 */
class ListCorps extends Rpc
{
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
    public function withCorpName($value)
    {
        $this->data['CorpName'] = $value;
        $this->options['form_params']['CorpName'] = $value;

        return $this;
    }
}
