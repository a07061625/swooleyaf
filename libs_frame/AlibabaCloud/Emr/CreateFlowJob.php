<?php

namespace AlibabaCloud\Emr;

/**
 * @method string getRetryPolicy()
 * @method $this withRetryPolicy($value)
 * @method string getRunConf()
 * @method $this withRunConf($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getType()
 * @method $this withType($value)
 * @method string getParamConf()
 * @method $this withParamConf($value)
 * @method array getResourceList()
 * @method string getFailAct()
 * @method $this withFailAct($value)
 * @method string getMode()
 * @method $this withMode($value)
 * @method string getMonitorConf()
 * @method $this withMonitorConf($value)
 * @method string getMaxRetry()
 * @method $this withMaxRetry($value)
 * @method string getAlertConf()
 * @method $this withAlertConf($value)
 * @method string getProjectId()
 * @method $this withProjectId($value)
 * @method string getEnvConf()
 * @method $this withEnvConf($value)
 * @method string getMaxRunningTimeSec()
 * @method $this withMaxRunningTimeSec($value)
 * @method string getClusterId()
 * @method $this withClusterId($value)
 * @method string getParams()
 * @method $this withParams($value)
 * @method string getCustomVariables()
 * @method $this withCustomVariables($value)
 * @method string getRetryInterval()
 * @method $this withRetryInterval($value)
 * @method string getName()
 * @method $this withName($value)
 * @method string getAdhoc()
 * @method $this withAdhoc($value)
 * @method string getParentCategory()
 * @method $this withParentCategory($value)
 */
class CreateFlowJob extends Rpc
{
    /**
     * @return $this
     */
    public function withResourceList(array $resourceList)
    {
        $this->data['ResourceList'] = $resourceList;
        foreach ($resourceList as $depth1 => $depth1Value) {
            if (isset($depth1Value['Path'])) {
                $this->options['query']['ResourceList.' . ($depth1 + 1) . '.Path'] = $depth1Value['Path'];
            }
            if (isset($depth1Value['Alias'])) {
                $this->options['query']['ResourceList.' . ($depth1 + 1) . '.Alias'] = $depth1Value['Alias'];
            }
        }

        return $this;
    }
}
