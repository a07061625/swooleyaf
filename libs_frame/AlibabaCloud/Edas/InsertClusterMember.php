<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getPassword()
 * @method string getInstanceIds()
 * @method string getClusterId()
 */
class InsertClusterMember extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/resource/cluster_member';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPassword($value)
    {
        $this->data['Password'] = $value;
        $this->options['query']['password'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceIds($value)
    {
        $this->data['InstanceIds'] = $value;
        $this->options['query']['instanceIds'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClusterId($value)
    {
        $this->data['ClusterId'] = $value;
        $this->options['query']['clusterId'] = $value;

        return $this;
    }
}
