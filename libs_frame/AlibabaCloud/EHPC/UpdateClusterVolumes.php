<?php

namespace AlibabaCloud\EHPC;

/**
 * @method array getAdditionalVolumes()
 * @method string getClusterId()
 * @method $this withClusterId($value)
 */
class UpdateClusterVolumes extends Rpc
{
    /**
     * @return $this
     */
    public function withAdditionalVolumes(array $additionalVolumes)
    {
        $this->data['AdditionalVolumes'] = $additionalVolumes;
        foreach ($additionalVolumes as $depth1 => $depth1Value) {
            if (isset($depth1Value['VolumeType'])) {
                $this->options['query']['AdditionalVolumes.' . ($depth1 + 1) . '.VolumeType'] = $depth1Value['VolumeType'];
            }
            if (isset($depth1Value['VolumeProtocol'])) {
                $this->options['query']['AdditionalVolumes.' . ($depth1 + 1) . '.VolumeProtocol'] = $depth1Value['VolumeProtocol'];
            }
            if (isset($depth1Value['LocalDirectory'])) {
                $this->options['query']['AdditionalVolumes.' . ($depth1 + 1) . '.LocalDirectory'] = $depth1Value['LocalDirectory'];
            }
            if (isset($depth1Value['RemoteDirectory'])) {
                $this->options['query']['AdditionalVolumes.' . ($depth1 + 1) . '.RemoteDirectory'] = $depth1Value['RemoteDirectory'];
            }
            foreach ($depth1Value['Roles'] as $depth2 => $depth2Value) {
                if (isset($depth2Value['Name'])) {
                    $this->options['query']['AdditionalVolumes.' . ($depth1 + 1) . '.Roles.' . ($depth2 + 1) . '.Name'] = $depth2Value['Name'];
                }
            }
            if (isset($depth1Value['VolumeId'])) {
                $this->options['query']['AdditionalVolumes.' . ($depth1 + 1) . '.VolumeId'] = $depth1Value['VolumeId'];
            }
            if (isset($depth1Value['VolumeMountpoint'])) {
                $this->options['query']['AdditionalVolumes.' . ($depth1 + 1) . '.VolumeMountpoint'] = $depth1Value['VolumeMountpoint'];
            }
            if (isset($depth1Value['Location'])) {
                $this->options['query']['AdditionalVolumes.' . ($depth1 + 1) . '.Location'] = $depth1Value['Location'];
            }
            if (isset($depth1Value['JobQueue'])) {
                $this->options['query']['AdditionalVolumes.' . ($depth1 + 1) . '.JobQueue'] = $depth1Value['JobQueue'];
            }
        }

        return $this;
    }
}
