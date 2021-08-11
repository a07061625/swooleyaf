<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getAlarmMode()
 * @method string getProjectName()
 * @method string getFollower()
 * @method string getEntityId()
 */
class CreateQualityFollower extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAlarmMode($value)
    {
        $this->data['AlarmMode'] = $value;
        $this->options['form_params']['AlarmMode'] = $value;

        return $this;
    }

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
    public function withFollower($value)
    {
        $this->data['Follower'] = $value;
        $this->options['form_params']['Follower'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEntityId($value)
    {
        $this->data['EntityId'] = $value;
        $this->options['form_params']['EntityId'] = $value;

        return $this;
    }
}
