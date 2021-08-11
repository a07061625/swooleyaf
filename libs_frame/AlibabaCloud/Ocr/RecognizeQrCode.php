<?php

namespace AlibabaCloud\Ocr;

/**
 * @method array getTasks()
 */
class RecognizeQrCode extends Rpc
{
    /**
     * @return $this
     */
    public function withTasks(array $tasks)
    {
        $this->data['Tasks'] = $tasks;
        foreach ($tasks as $depth1 => $depth1Value) {
            if (isset($depth1Value['ImageURL'])) {
                $this->options['form_params']['Tasks.' . ($depth1 + 1) . '.ImageURL'] = $depth1Value['ImageURL'];
            }
        }

        return $this;
    }
}
