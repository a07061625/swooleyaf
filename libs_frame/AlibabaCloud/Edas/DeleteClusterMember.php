<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getClusterMemberId()
 * @method string getClusterId()
 */
class DeleteClusterMember extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/resource/cluster_member';

    /** @var string */
    public $method = 'DELETE';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClusterMemberId($value)
    {
        $this->data['ClusterMemberId'] = $value;
        $this->options['query']['ClusterMemberId'] = $value;

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
        $this->options['query']['ClusterId'] = $value;

        return $this;
    }
}
