<?php

namespace AlibabaCloud\Cr;

/**
 * @method string getAuthorize()
 * @method string getStatus()
 */
class GetNamespaceList extends Roa
{
    /** @var string */
    public $pathPattern = '/namespace';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAuthorize($value)
    {
        $this->data['Authorize'] = $value;
        $this->options['query']['Authorize'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStatus($value)
    {
        $this->data['Status'] = $value;
        $this->options['query']['Status'] = $value;

        return $this;
    }
}
