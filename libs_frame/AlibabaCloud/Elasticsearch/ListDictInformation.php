<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getAnalyzerType()
 * @method string getBucketName()
 * @method string getKey()
 */
class ListDictInformation extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/dict/_info';

    /** @var string */
    public $method = 'GET';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAnalyzerType($value)
    {
        $this->data['AnalyzerType'] = $value;
        $this->options['query']['analyzerType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBucketName($value)
    {
        $this->data['BucketName'] = $value;
        $this->options['query']['bucketName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withKey($value)
    {
        $this->data['Key'] = $value;
        $this->options['query']['key'] = $value;

        return $this;
    }
}
