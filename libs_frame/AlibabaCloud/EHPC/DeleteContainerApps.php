<?php

namespace AlibabaCloud\EHPC;

/**
 * @method array getContainerApp()
 */
class DeleteContainerApps extends Rpc
{
    /**
     * @return $this
     */
    public function withContainerApp(array $containerApp)
    {
        $this->data['ContainerApp'] = $containerApp;
        foreach ($containerApp as $depth1 => $depth1Value) {
            if (isset($depth1Value['Id'])) {
                $this->options['query']['ContainerApp.' . ($depth1 + 1) . '.Id'] = $depth1Value['Id'];
            }
        }

        return $this;
    }
}
