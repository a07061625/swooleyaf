<?php

namespace AlibabaCloud\DomainIntl;

/**
 * @method array getTaskDetailNo()
 * @method string getUserClientIp()
 * @method $this withUserClientIp($value)
 * @method string getLang()
 * @method $this withLang($value)
 */
class AcknowledgeTaskResult extends Rpc
{
    /**
     * @return $this
     */
    public function withTaskDetailNo(array $taskDetailNo)
    {
        $this->data['TaskDetailNo'] = $taskDetailNo;
        foreach ($taskDetailNo as $i => $iValue) {
            $this->options['query']['TaskDetailNo.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
