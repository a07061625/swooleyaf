<?php

namespace AlibabaCloud\CS;

/**
 * @method string getImageName()
 * @method string getDockerVersion()
 */
class DescribeImages extends Roa
{
    /** @var string */
    public $pathPattern = '/images';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withImageName($value)
    {
        $this->data['ImageName'] = $value;
        $this->options['query']['ImageName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDockerVersion($value)
    {
        $this->data['DockerVersion'] = $value;
        $this->options['query']['DockerVersion'] = $value;

        return $this;
    }
}
