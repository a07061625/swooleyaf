<?php

namespace AlibabaCloud\Retailcloud;

/**
 * @method string getReclaimPolicy()
 * @method string getNFSVersion()
 * @method string getAccessModes()
 * @method string getName()
 * @method string getMountTargetDomain()
 * @method string getMountDir()
 * @method string getClusterInstanceId()
 * @method string getCapacity()
 * @method string getStorageClass()
 */
class CreatePersistentVolume extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withReclaimPolicy($value)
    {
        $this->data['ReclaimPolicy'] = $value;
        $this->options['form_params']['ReclaimPolicy'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNFSVersion($value)
    {
        $this->data['NFSVersion'] = $value;
        $this->options['form_params']['NFSVersion'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAccessModes($value)
    {
        $this->data['AccessModes'] = $value;
        $this->options['form_params']['AccessModes'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withName($value)
    {
        $this->data['Name'] = $value;
        $this->options['form_params']['Name'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMountTargetDomain($value)
    {
        $this->data['MountTargetDomain'] = $value;
        $this->options['form_params']['MountTargetDomain'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMountDir($value)
    {
        $this->data['MountDir'] = $value;
        $this->options['form_params']['MountDir'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCapacity($value)
    {
        $this->data['Capacity'] = $value;
        $this->options['form_params']['Capacity'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStorageClass($value)
    {
        $this->data['StorageClass'] = $value;
        $this->options['form_params']['StorageClass'] = $value;

        return $this;
    }
}
