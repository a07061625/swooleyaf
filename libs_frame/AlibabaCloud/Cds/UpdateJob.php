<?php

namespace AlibabaCloud\Cds;

/**
 * @method string getJsonContent()
 * @method string getJobName()
 */
class UpdateJob extends Roa
{
    /** @var string */
    public $pathPattern = '/v1/job/update';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withJsonContent($value)
    {
        $this->data['JsonContent'] = $value;
        $this->options['query']['JsonContent'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withJobName($value)
    {
        $this->data['JobName'] = $value;
        $this->options['query']['JobName'] = $value;

        return $this;
    }
}
