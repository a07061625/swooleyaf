<?php

namespace AlibabaCloud\Cds;

/**
 * @method string getJsonContent()
 * @method string getJobName()
 * @method string getDeployType()
 */
class CreateJob extends Roa
{
    /** @var string */
    public $pathPattern = '/v1/job/create';

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeployType($value)
    {
        $this->data['DeployType'] = $value;
        $this->options['query']['DeployType'] = $value;

        return $this;
    }
}
