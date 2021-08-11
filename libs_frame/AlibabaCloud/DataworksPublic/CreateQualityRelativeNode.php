<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getProjectName()
 * @method string getTargetNodeProjectId()
 * @method string getMatchExpression()
 * @method string getEnvType()
 * @method string getTargetNodeProjectName()
 * @method string getTableName()
 * @method string getNodeId()
 * @method string getProjectId()
 */
class CreateQualityRelativeNode extends Rpc
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
    public function withTargetNodeProjectId($value)
    {
        $this->data['TargetNodeProjectId'] = $value;
        $this->options['form_params']['TargetNodeProjectId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMatchExpression($value)
    {
        $this->data['MatchExpression'] = $value;
        $this->options['form_params']['MatchExpression'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEnvType($value)
    {
        $this->data['EnvType'] = $value;
        $this->options['form_params']['EnvType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTargetNodeProjectName($value)
    {
        $this->data['TargetNodeProjectName'] = $value;
        $this->options['form_params']['TargetNodeProjectName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTableName($value)
    {
        $this->data['TableName'] = $value;
        $this->options['form_params']['TableName'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectId($value)
    {
        $this->data['ProjectId'] = $value;
        $this->options['form_params']['ProjectId'] = $value;

        return $this;
    }
}
