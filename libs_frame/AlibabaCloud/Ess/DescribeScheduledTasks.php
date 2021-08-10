<?php

namespace AlibabaCloud\Ess;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getScheduledAction2()
 * @method string getScheduledAction1()
 * @method string getScheduledAction6()
 * @method string getScheduledAction5()
 * @method string getScheduledAction4()
 * @method string getScheduledAction3()
 * @method string getScheduledAction9()
 * @method string getScheduledAction8()
 * @method string getScheduledAction7()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getScheduledTaskName20()
 * @method string getScheduledTaskName19()
 * @method string getScheduledTaskName18()
 * @method string getScheduledTaskId20()
 * @method string getScalingGroupId()
 * @method $this withScalingGroupId($value)
 * @method string getScheduledTaskName13()
 * @method string getScheduledTaskName12()
 * @method string getScheduledTaskName11()
 * @method string getScheduledTaskName10()
 * @method string getScheduledTaskName17()
 * @method string getScheduledTaskName16()
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getScheduledTaskName15()
 * @method string getScheduledTaskName14()
 * @method string getScheduledTaskId2()
 * @method string getScheduledTaskId1()
 * @method string getScheduledTaskId4()
 * @method string getScheduledTaskId18()
 * @method string getScheduledTaskId3()
 * @method string getScheduledTaskId19()
 * @method string getScheduledTaskId6()
 * @method string getScheduledTaskId5()
 * @method string getScheduledTaskId8()
 * @method string getScheduledTaskName9()
 * @method string getScheduledAction20()
 * @method string getScheduledTaskId7()
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getScheduledTaskId12()
 * @method string getScheduledTaskName7()
 * @method string getScheduledTaskId9()
 * @method string getScheduledTaskId13()
 * @method string getScheduledTaskName8()
 * @method string getScheduledTaskId10()
 * @method string getScheduledTaskName5()
 * @method string getScheduledTaskId11()
 * @method string getScheduledTaskName6()
 * @method string getScheduledTaskId16()
 * @method string getScheduledTaskName3()
 * @method string getScheduledTaskId17()
 * @method string getScheduledTaskName4()
 * @method string getScheduledTaskId14()
 * @method string getScheduledTaskName1()
 * @method string getScheduledTaskId15()
 * @method string getScheduledTaskName2()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getScheduledAction18()
 * @method string getScheduledAction19()
 * @method string getScheduledAction16()
 * @method string getScheduledAction17()
 * @method string getScheduledAction14()
 * @method string getScheduledAction15()
 * @method string getScheduledAction12()
 * @method string getScheduledAction13()
 * @method string getScheduledAction10()
 * @method string getScheduledAction11()
 */
class DescribeScheduledTasks extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledAction2($value)
    {
        $this->data['ScheduledAction2'] = $value;
        $this->options['query']['ScheduledAction.2'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledAction1($value)
    {
        $this->data['ScheduledAction1'] = $value;
        $this->options['query']['ScheduledAction.1'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledAction6($value)
    {
        $this->data['ScheduledAction6'] = $value;
        $this->options['query']['ScheduledAction.6'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledAction5($value)
    {
        $this->data['ScheduledAction5'] = $value;
        $this->options['query']['ScheduledAction.5'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledAction4($value)
    {
        $this->data['ScheduledAction4'] = $value;
        $this->options['query']['ScheduledAction.4'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledAction3($value)
    {
        $this->data['ScheduledAction3'] = $value;
        $this->options['query']['ScheduledAction.3'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledAction9($value)
    {
        $this->data['ScheduledAction9'] = $value;
        $this->options['query']['ScheduledAction.9'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledAction8($value)
    {
        $this->data['ScheduledAction8'] = $value;
        $this->options['query']['ScheduledAction.8'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledAction7($value)
    {
        $this->data['ScheduledAction7'] = $value;
        $this->options['query']['ScheduledAction.7'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskName20($value)
    {
        $this->data['ScheduledTaskName20'] = $value;
        $this->options['query']['ScheduledTaskName.20'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskName19($value)
    {
        $this->data['ScheduledTaskName19'] = $value;
        $this->options['query']['ScheduledTaskName.19'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskName18($value)
    {
        $this->data['ScheduledTaskName18'] = $value;
        $this->options['query']['ScheduledTaskName.18'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskId20($value)
    {
        $this->data['ScheduledTaskId20'] = $value;
        $this->options['query']['ScheduledTaskId.20'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskName13($value)
    {
        $this->data['ScheduledTaskName13'] = $value;
        $this->options['query']['ScheduledTaskName.13'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskName12($value)
    {
        $this->data['ScheduledTaskName12'] = $value;
        $this->options['query']['ScheduledTaskName.12'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskName11($value)
    {
        $this->data['ScheduledTaskName11'] = $value;
        $this->options['query']['ScheduledTaskName.11'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskName10($value)
    {
        $this->data['ScheduledTaskName10'] = $value;
        $this->options['query']['ScheduledTaskName.10'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskName17($value)
    {
        $this->data['ScheduledTaskName17'] = $value;
        $this->options['query']['ScheduledTaskName.17'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskName16($value)
    {
        $this->data['ScheduledTaskName16'] = $value;
        $this->options['query']['ScheduledTaskName.16'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskName15($value)
    {
        $this->data['ScheduledTaskName15'] = $value;
        $this->options['query']['ScheduledTaskName.15'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskName14($value)
    {
        $this->data['ScheduledTaskName14'] = $value;
        $this->options['query']['ScheduledTaskName.14'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskId2($value)
    {
        $this->data['ScheduledTaskId2'] = $value;
        $this->options['query']['ScheduledTaskId.2'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskId1($value)
    {
        $this->data['ScheduledTaskId1'] = $value;
        $this->options['query']['ScheduledTaskId.1'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskId4($value)
    {
        $this->data['ScheduledTaskId4'] = $value;
        $this->options['query']['ScheduledTaskId.4'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskId18($value)
    {
        $this->data['ScheduledTaskId18'] = $value;
        $this->options['query']['ScheduledTaskId.18'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskId3($value)
    {
        $this->data['ScheduledTaskId3'] = $value;
        $this->options['query']['ScheduledTaskId.3'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskId19($value)
    {
        $this->data['ScheduledTaskId19'] = $value;
        $this->options['query']['ScheduledTaskId.19'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskId6($value)
    {
        $this->data['ScheduledTaskId6'] = $value;
        $this->options['query']['ScheduledTaskId.6'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskId5($value)
    {
        $this->data['ScheduledTaskId5'] = $value;
        $this->options['query']['ScheduledTaskId.5'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskId8($value)
    {
        $this->data['ScheduledTaskId8'] = $value;
        $this->options['query']['ScheduledTaskId.8'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskName9($value)
    {
        $this->data['ScheduledTaskName9'] = $value;
        $this->options['query']['ScheduledTaskName.9'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledAction20($value)
    {
        $this->data['ScheduledAction20'] = $value;
        $this->options['query']['ScheduledAction.20'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskId7($value)
    {
        $this->data['ScheduledTaskId7'] = $value;
        $this->options['query']['ScheduledTaskId.7'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskId12($value)
    {
        $this->data['ScheduledTaskId12'] = $value;
        $this->options['query']['ScheduledTaskId.12'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskName7($value)
    {
        $this->data['ScheduledTaskName7'] = $value;
        $this->options['query']['ScheduledTaskName.7'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskId9($value)
    {
        $this->data['ScheduledTaskId9'] = $value;
        $this->options['query']['ScheduledTaskId.9'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskId13($value)
    {
        $this->data['ScheduledTaskId13'] = $value;
        $this->options['query']['ScheduledTaskId.13'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskName8($value)
    {
        $this->data['ScheduledTaskName8'] = $value;
        $this->options['query']['ScheduledTaskName.8'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskId10($value)
    {
        $this->data['ScheduledTaskId10'] = $value;
        $this->options['query']['ScheduledTaskId.10'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskName5($value)
    {
        $this->data['ScheduledTaskName5'] = $value;
        $this->options['query']['ScheduledTaskName.5'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskId11($value)
    {
        $this->data['ScheduledTaskId11'] = $value;
        $this->options['query']['ScheduledTaskId.11'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskName6($value)
    {
        $this->data['ScheduledTaskName6'] = $value;
        $this->options['query']['ScheduledTaskName.6'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskId16($value)
    {
        $this->data['ScheduledTaskId16'] = $value;
        $this->options['query']['ScheduledTaskId.16'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskName3($value)
    {
        $this->data['ScheduledTaskName3'] = $value;
        $this->options['query']['ScheduledTaskName.3'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskId17($value)
    {
        $this->data['ScheduledTaskId17'] = $value;
        $this->options['query']['ScheduledTaskId.17'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskName4($value)
    {
        $this->data['ScheduledTaskName4'] = $value;
        $this->options['query']['ScheduledTaskName.4'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskId14($value)
    {
        $this->data['ScheduledTaskId14'] = $value;
        $this->options['query']['ScheduledTaskId.14'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskName1($value)
    {
        $this->data['ScheduledTaskName1'] = $value;
        $this->options['query']['ScheduledTaskName.1'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskId15($value)
    {
        $this->data['ScheduledTaskId15'] = $value;
        $this->options['query']['ScheduledTaskId.15'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledTaskName2($value)
    {
        $this->data['ScheduledTaskName2'] = $value;
        $this->options['query']['ScheduledTaskName.2'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledAction18($value)
    {
        $this->data['ScheduledAction18'] = $value;
        $this->options['query']['ScheduledAction.18'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledAction19($value)
    {
        $this->data['ScheduledAction19'] = $value;
        $this->options['query']['ScheduledAction.19'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledAction16($value)
    {
        $this->data['ScheduledAction16'] = $value;
        $this->options['query']['ScheduledAction.16'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledAction17($value)
    {
        $this->data['ScheduledAction17'] = $value;
        $this->options['query']['ScheduledAction.17'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledAction14($value)
    {
        $this->data['ScheduledAction14'] = $value;
        $this->options['query']['ScheduledAction.14'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledAction15($value)
    {
        $this->data['ScheduledAction15'] = $value;
        $this->options['query']['ScheduledAction.15'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledAction12($value)
    {
        $this->data['ScheduledAction12'] = $value;
        $this->options['query']['ScheduledAction.12'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledAction13($value)
    {
        $this->data['ScheduledAction13'] = $value;
        $this->options['query']['ScheduledAction.13'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledAction10($value)
    {
        $this->data['ScheduledAction10'] = $value;
        $this->options['query']['ScheduledAction.10'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduledAction11($value)
    {
        $this->data['ScheduledAction11'] = $value;
        $this->options['query']['ScheduledAction.11'] = $value;

        return $this;
    }
}
