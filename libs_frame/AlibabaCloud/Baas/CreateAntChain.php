<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getCipherSuit()
 * @method string getLiveTime()
 * @method string getName()
 * @method string getResourceSize()
 * @method string getNodeNum()
 * @method string getBlockchainRegionId()
 * @method string getTlsAlgo()
 * @method string getMerkleTreeSuit()
 * @method string getConsortiumId()
 */
class CreateAntChain extends Rpc
{
    /** @var string */
    public $method = 'PUT';

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
    public function withResourceSize($value)
    {
        $this->data['ResourceSize'] = $value;
        $this->options['form_params']['ResourceSize'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNodeNum($value)
    {
        $this->data['NodeNum'] = $value;
        $this->options['form_params']['NodeNum'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withConsortiumId($value)
    {
        $this->data['ConsortiumId'] = $value;
        $this->options['form_params']['ConsortiumId'] = $value;

        return $this;
    }
}
