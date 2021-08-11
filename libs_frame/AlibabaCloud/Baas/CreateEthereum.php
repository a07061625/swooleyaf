<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getConsensus()
 * @method string getDifficulty()
 * @method array getNode()
 * @method string getName()
 * @method string getGas()
 * @method string getDescription()
 * @method string getNetworkId()
 * @method string getRegion()
 */
class CreateEthereum extends Rpc
{
    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withConsensus($value)
    {
        $this->data['Consensus'] = $value;
        $this->options['form_params']['Consensus'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDifficulty($value)
    {
        $this->data['Difficulty'] = $value;
        $this->options['form_params']['Difficulty'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withNode(array $node)
    {
        $this->data['Node'] = $node;
        foreach ($node as $depth1 => $depth1Value) {
            $this->options['form_params']['Node.' . ($depth1 + 1) . '.Name'] = $depth1Value['Name'];
        }

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
    public function withGas($value)
    {
        $this->data['Gas'] = $value;
        $this->options['form_params']['Gas'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDescription($value)
    {
        $this->data['Description'] = $value;
        $this->options['form_params']['Description'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNetworkId($value)
    {
        $this->data['NetworkId'] = $value;
        $this->options['form_params']['NetworkId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRegion($value)
    {
        $this->data['Region'] = $value;
        $this->options['form_params']['Region'] = $value;

        return $this;
    }
}
