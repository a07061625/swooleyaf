<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getCipherSuit()
 * @method string getSize()
 * @method string getMachineNum()
 * @method string getLiveTime()
 * @method string getBizid()
 * @method string getBlockchainType()
 * @method string getBlockchainRegionId()
 * @method string getTlsAlgo()
 * @method string getMerkleTreeSuit()
 */
class CreateBlockchainApplication extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCipherSuit($value)
    {
        $this->data['CipherSuit'] = $value;
        $this->options['form_params']['CipherSuit'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSize($value)
    {
        $this->data['Size'] = $value;
        $this->options['form_params']['Size'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMachineNum($value)
    {
        $this->data['MachineNum'] = $value;
        $this->options['form_params']['MachineNum'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLiveTime($value)
    {
        $this->data['LiveTime'] = $value;
        $this->options['form_params']['LiveTime'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBizid($value)
    {
        $this->data['Bizid'] = $value;
        $this->options['form_params']['Bizid'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBlockchainType($value)
    {
        $this->data['BlockchainType'] = $value;
        $this->options['form_params']['BlockchainType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBlockchainRegionId($value)
    {
        $this->data['BlockchainRegionId'] = $value;
        $this->options['form_params']['BlockchainRegionId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTlsAlgo($value)
    {
        $this->data['TlsAlgo'] = $value;
        $this->options['form_params']['TlsAlgo'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMerkleTreeSuit($value)
    {
        $this->data['MerkleTreeSuit'] = $value;
        $this->options['form_params']['MerkleTreeSuit'] = $value;

        return $this;
    }
}
