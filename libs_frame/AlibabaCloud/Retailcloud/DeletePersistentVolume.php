<?php

namespace AlibabaCloud\Retailcloud;

/**
 * @method string getPersistentVolumeName()
 * @method string getClusterInstanceId()
 */
class DeletePersistentVolume extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPersistentVolumeName($value)
    {
        $this->data['PersistentVolumeName'] = $value;
        $this->options['form_params']['PersistentVolumeName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClusterInstanceId($value)
    {
        $this->data['ClusterInstanceId'] = $value;
        $this->options['form_params']['ClusterInstanceId'] = $value;

        return $this;
    }
}
