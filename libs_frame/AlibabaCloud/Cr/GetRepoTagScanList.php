<?php

namespace AlibabaCloud\Cr;

/**
 * @method string getSeverity()
 * @method string getRepoNamespace()
 * @method $this withRepoNamespace($value)
 * @method string getRepoName()
 * @method $this withRepoName($value)
 * @method string getPageSize()
 * @method string getTag()
 * @method $this withTag($value)
 * @method string getPage()
 */
class GetRepoTagScanList extends Roa
{
    /** @var string */
    public $pathPattern = '/repos/[RepoNamespace]/[RepoName]/tags/[Tag]/scanResult';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSeverity($value)
    {
        $this->data['Severity'] = $value;
        $this->options['query']['Severity'] = $value;

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
        $this->options['query']['PageSize'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPage($value)
    {
        $this->data['Page'] = $value;
        $this->options['query']['Page'] = $value;

        return $this;
    }
}
