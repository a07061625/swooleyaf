<?php

namespace AlibabaCloud\Emr;

/**
 * @method array getUserList()
 * @method array getHostList()
 * @method string getClusterId()
 * @method $this withClusterId($value)
 * @method string getDefaultQueue()
 * @method $this withDefaultQueue($value)
 * @method string getDefaultUser()
 * @method $this withDefaultUser($value)
 * @method array getQueueList()
 * @method string getProjectId()
 * @method $this withProjectId($value)
 */
class CreateFlowProjectClusterSetting extends Rpc
{
    /**
     * @return $this
     */
    public function withUserList(array $userList)
    {
        $this->data['UserList'] = $userList;
        foreach ($userList as $i => $iValue) {
            $this->options['query']['UserList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withHostList(array $hostList)
    {
        $this->data['HostList'] = $hostList;
        foreach ($hostList as $i => $iValue) {
            $this->options['query']['HostList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withQueueList(array $queueList)
    {
        $this->data['QueueList'] = $queueList;
        foreach ($queueList as $i => $iValue) {
            $this->options['query']['QueueList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
