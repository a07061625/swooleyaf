<?php

namespace AlibabaCloud\Imageaudit;

/**
 * @method array getLabels()
 * @method array getTasks()
 */
class ScanText extends Rpc
{
    /**
     * @return $this
     */
    public function withLabels(array $labels)
    {
        $this->data['Labels'] = $labels;
        foreach ($labels as $depth1 => $depth1Value) {
            if (isset($depth1Value['Label'])) {
                $this->options['form_params']['Labels.' . ($depth1 + 1) . '.Label'] = $depth1Value['Label'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withTasks(array $tasks)
    {
        $this->data['Tasks'] = $tasks;
        foreach ($tasks as $depth1 => $depth1Value) {
            if (isset($depth1Value['Content'])) {
                $this->options['form_params']['Tasks.' . ($depth1 + 1) . '.Content'] = $depth1Value['Content'];
            }
        }

        return $this;
    }
}
