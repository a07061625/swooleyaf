<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getProjectName()
 * @method string getMatchExpression()
 * @method string getEnvType()
 * @method string getTableName()
 */
class GetQualityEntity extends Rpc
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
    public function withTableName($value)
    {
        $this->data['TableName'] = $value;
        $this->options['form_params']['TableName'] = $value;

        return $this;
    }
}
