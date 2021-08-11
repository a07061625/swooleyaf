<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getProjectName()
 * @method string getFollowerId()
 */
class DeleteQualityFollower extends Rpc
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
    public function withFollowerId($value)
    {
        $this->data['FollowerId'] = $value;
        $this->options['form_params']['FollowerId'] = $value;

        return $this;
    }
}
