<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getDndEnd()
 * @method string getAlertUnit()
 * @method string getRemindUnit()
 * @method string getUseFlag()
 * @method string getAlertInterval()
 * @method string getAlertMethods()
 * @method string getRobotUrls()
 * @method string getMaxAlertTimes()
 * @method string getBizProcessIds()
 * @method string getRemindType()
 * @method string getAlertTargets()
 * @method string getBaselineIds()
 * @method string getRemindId()
 * @method string getDetail()
 * @method string getRemindName()
 * @method string getProjectId()
 * @method string getNodeIds()
 */
class UpdateRemind extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDndEnd($value)
    {
        $this->data['DndEnd'] = $value;
        $this->options['form_params']['DndEnd'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAlertUnit($value)
    {
        $this->data['AlertUnit'] = $value;
        $this->options['form_params']['AlertUnit'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRemindUnit($value)
    {
        $this->data['RemindUnit'] = $value;
        $this->options['form_params']['RemindUnit'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUseFlag($value)
    {
        $this->data['UseFlag'] = $value;
        $this->options['form_params']['UseFlag'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAlertInterval($value)
    {
        $this->data['AlertInterval'] = $value;
        $this->options['form_params']['AlertInterval'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAlertMethods($value)
    {
        $this->data['AlertMethods'] = $value;
        $this->options['form_params']['AlertMethods'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRobotUrls($value)
    {
        $this->data['RobotUrls'] = $value;
        $this->options['form_params']['RobotUrls'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMaxAlertTimes($value)
    {
        $this->data['MaxAlertTimes'] = $value;
        $this->options['form_params']['MaxAlertTimes'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBizProcessIds($value)
    {
        $this->data['BizProcessIds'] = $value;
        $this->options['form_params']['BizProcessIds'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRemindType($value)
    {
        $this->data['RemindType'] = $value;
        $this->options['form_params']['RemindType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAlertTargets($value)
    {
        $this->data['AlertTargets'] = $value;
        $this->options['form_params']['AlertTargets'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBaselineIds($value)
    {
        $this->data['BaselineIds'] = $value;
        $this->options['form_params']['BaselineIds'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRemindId($value)
    {
        $this->data['RemindId'] = $value;
        $this->options['form_params']['RemindId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDetail($value)
    {
        $this->data['Detail'] = $value;
        $this->options['form_params']['Detail'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRemindName($value)
    {
        $this->data['RemindName'] = $value;
        $this->options['form_params']['RemindName'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNodeIds($value)
    {
        $this->data['NodeIds'] = $value;
        $this->options['form_params']['NodeIds'] = $value;

        return $this;
    }
}
