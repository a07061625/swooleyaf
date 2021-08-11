<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getProjectEnv()
 * @method string getOutputs()
 * @method string getOutputNodeListAsMap()
 */
class ListNodesByOutput extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectEnv($value)
    {
        $this->data['ProjectEnv'] = $value;
        $this->options['form_params']['ProjectEnv'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOutputs($value)
    {
        $this->data['Outputs'] = $value;
        $this->options['form_params']['Outputs'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOutputNodeListAsMap($value)
    {
        $this->data['OutputNodeListAsMap'] = $value;
        $this->options['form_params']['OutputNodeListAsMap'] = $value;

        return $this;
    }
}
