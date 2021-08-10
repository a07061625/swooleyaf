<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getPassword()
 * @method string getInstanceIds()
 * @method string getTargetClusterId()
 */
class TransformClusterMember extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/resource/transform_cluster_member';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPassword($value)
    {
        $this->data['Password'] = $value;
        $this->options['query']['Password'] = $value;

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
        $this->options['query']['InstanceIds'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTargetClusterId($value)
    {
        $this->data['TargetClusterId'] = $value;
        $this->options['query']['TargetClusterId'] = $value;

        return $this;
    }
}
