<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getPageSize()
 * @method string getCurrentPage()
 */
class DescribeNamespaces extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/paas/namespaces';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageSize($value)
    {
        $this->data['PageSize'] = $value;
        $this->options['query']['PageSize'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCurrentPage($value)
    {
        $this->data['CurrentPage'] = $value;
        $this->options['query']['CurrentPage'] = $value;

        return $this;
    }
}
