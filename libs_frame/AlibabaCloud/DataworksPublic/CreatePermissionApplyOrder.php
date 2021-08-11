<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getApplyReason()
 * @method $this withApplyReason($value)
 * @method string getMaxComputeProjectName()
 * @method $this withMaxComputeProjectName($value)
 * @method array getApplyObject()
 * @method string getApplyUserIds()
 * @method $this withApplyUserIds($value)
 * @method string getDeadline()
 * @method $this withDeadline($value)
 * @method string getWorkspaceId()
 * @method $this withWorkspaceId($value)
 * @method string getOrderType()
 * @method $this withOrderType($value)
 * @method string getEngineType()
 * @method $this withEngineType($value)
 */
class CreatePermissionApplyOrder extends Rpc
{
    /**
     * @return $this
     */
    public function withApplyObject(array $applyObject)
    {
        $this->data['ApplyObject'] = $applyObject;
        foreach ($applyObject as $depth1 => $depth1Value) {
            foreach ($depth1Value['ColumnMetaList'] as $depth2 => $depth2Value) {
                if (isset($depth2Value['Name'])) {
                    $this->options['query']['ApplyObject.' . ($depth1 + 1) . '.ColumnMetaList.' . ($depth2 + 1) . '.Name'] = $depth2Value['Name'];
                }
            }
            if (isset($depth1Value['Name'])) {
                $this->options['query']['ApplyObject.' . ($depth1 + 1) . '.Name'] = $depth1Value['Name'];
            }
            if (isset($depth1Value['Actions'])) {
                $this->options['query']['ApplyObject.' . ($depth1 + 1) . '.Actions'] = $depth1Value['Actions'];
            }
        }

        return $this;
    }
}
