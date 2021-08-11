<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getAlarmMode()
 * @method string getProjectName()
 * @method string getFollower()
 * @method string getFollowerId()
 */
class UpdateQualityFollower extends Rpc
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
    public function withFollowerId($value)
    {
        $this->data['FollowerId'] = $value;
        $this->options['form_params']['FollowerId'] = $value;

        return $this;
    }
}
