<?php

namespace AlibabaCloud\Iqa;

/**
 * @method string getProjectName()
 * @method string getModelId()
 * @method string getProjectType()
 */
class CreateProject extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectName($value)
    {
        $this->data['ProjectName'] = $value;
        $this->options['form_params']['ProjectName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withModelId($value)
    {
        $this->data['ModelId'] = $value;
        $this->options['form_params']['ModelId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectType($value)
    {
        $this->data['ProjectType'] = $value;
        $this->options['form_params']['ProjectType'] = $value;

        return $this;
    }
}
