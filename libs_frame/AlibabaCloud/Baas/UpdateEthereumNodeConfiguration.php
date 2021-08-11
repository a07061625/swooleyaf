<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getTMPub()
 * @method string getNodePub()
 * @method string getP2pPort()
 * @method string getWSPort()
 * @method string getIP()
 * @method string getRaftPort()
 * @method string getRpcPort()
 * @method string getTMPort()
 * @method string getNodeId()
 */
class UpdateEthereumNodeConfiguration extends Rpc
{
    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTMPub($value)
    {
        $this->data['TMPub'] = $value;
        $this->options['form_params']['TMPub'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNodePub($value)
    {
        $this->data['NodePub'] = $value;
        $this->options['form_params']['NodePub'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withP2pPort($value)
    {
        $this->data['P2pPort'] = $value;
        $this->options['form_params']['P2pPort'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withWSPort($value)
    {
        $this->data['WSPort'] = $value;
        $this->options['form_params']['WSPort'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIP($value)
    {
        $this->data['IP'] = $value;
        $this->options['form_params']['IP'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRaftPort($value)
    {
        $this->data['RaftPort'] = $value;
        $this->options['form_params']['RaftPort'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRpcPort($value)
    {
        $this->data['RpcPort'] = $value;
        $this->options['form_params']['RpcPort'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTMPort($value)
    {
        $this->data['TMPort'] = $value;
        $this->options['form_params']['TMPort'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNodeId($value)
    {
        $this->data['NodeId'] = $value;
        $this->options['form_params']['NodeId'] = $value;

        return $this;
    }
}
