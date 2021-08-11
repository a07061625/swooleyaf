<?php

namespace AlibabaCloud\Cds;

/**
 * @method string getStart()
 * @method string getNumberPerPage()
 */
class GetJobs extends Roa
{
    /** @var string */
    public $pathPattern = '/v1/jobs';

    /** @var string */
    public $method = 'GET';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStart($value)
    {
        $this->data['Start'] = $value;
        $this->options['query']['Start'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNumberPerPage($value)
    {
        $this->data['NumberPerPage'] = $value;
        $this->options['query']['NumberPerPage'] = $value;

        return $this;
    }
}
