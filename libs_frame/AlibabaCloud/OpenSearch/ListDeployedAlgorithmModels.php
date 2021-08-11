<?php

namespace AlibabaCloud\OpenSearch;

/**
 * @method string getAlgorithmType()
 * @method string getInServiceOnly()
 * @method string getAppGroupIdentity()
 */
class ListDeployedAlgorithmModels extends Roa
{
    /** @var string */
    public $pathPattern = '/v4/openapi/app-groups/[appGroupIdentity]/deployed-algorithm-models';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAlgorithmType($value)
    {
        $this->data['AlgorithmType'] = $value;
        $this->options['query']['algorithmType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInServiceOnly($value)
    {
        $this->data['InServiceOnly'] = $value;
        $this->options['query']['inServiceOnly'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppGroupIdentity($value)
    {
        $this->data['AppGroupIdentity'] = $value;
        $this->pathParameters['appGroupIdentity'] = $value;

        return $this;
    }
}
