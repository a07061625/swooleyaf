<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method array getColumns()
 * @method string getLifeCycle()
 * @method $this withLifeCycle($value)
 * @method array getThemes()
 * @method string getLogicalLevelId()
 * @method $this withLogicalLevelId($value)
 * @method string getEndpoint()
 * @method string getEnvType()
 * @method string getHasPart()
 * @method $this withHasPart($value)
 * @method string getTableName()
 * @method $this withTableName($value)
 * @method string getAppGuid()
 * @method $this withAppGuid($value)
 * @method string getProjectId()
 * @method $this withProjectId($value)
 * @method string getCategoryId()
 * @method $this withCategoryId($value)
 * @method string getVisibility()
 * @method $this withVisibility($value)
 * @method string getPhysicsLevelId()
 * @method $this withPhysicsLevelId($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getIsView()
 * @method $this withIsView($value)
 * @method string getExternalTableType()
 * @method $this withExternalTableType($value)
 * @method string getLocation()
 * @method $this withLocation($value)
 * @method string getComment()
 * @method $this withComment($value)
 * @method string getCreateIfNotExists()
 * @method $this withCreateIfNotExists($value)
 */
class UpdateTable extends Rpc
{
    /**
     * @return $this
     */
    public function withColumns(array $columns)
    {
        $this->data['Columns'] = $columns;
        foreach ($columns as $depth1 => $depth1Value) {
            if (isset($depth1Value['SeqNumber'])) {
                $this->options['form_params']['Columns.' . ($depth1 + 1) . '.SeqNumber'] = $depth1Value['SeqNumber'];
            }
            if (isset($depth1Value['IsPartitionCol'])) {
                $this->options['form_params']['Columns.' . ($depth1 + 1) . '.IsPartitionCol'] = $depth1Value['IsPartitionCol'];
            }
            if (isset($depth1Value['ColumnNameCn'])) {
                $this->options['form_params']['Columns.' . ($depth1 + 1) . '.ColumnNameCn'] = $depth1Value['ColumnNameCn'];
            }
            if (isset($depth1Value['Length'])) {
                $this->options['form_params']['Columns.' . ($depth1 + 1) . '.Length'] = $depth1Value['Length'];
            }
            if (isset($depth1Value['Comment'])) {
                $this->options['form_params']['Columns.' . ($depth1 + 1) . '.Comment'] = $depth1Value['Comment'];
            }
            if (isset($depth1Value['ColumnName'])) {
                $this->options['form_params']['Columns.' . ($depth1 + 1) . '.ColumnName'] = $depth1Value['ColumnName'];
            }
            if (isset($depth1Value['ColumnType'])) {
                $this->options['form_params']['Columns.' . ($depth1 + 1) . '.ColumnType'] = $depth1Value['ColumnType'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withThemes(array $themes)
    {
        $this->data['Themes'] = $themes;
        foreach ($themes as $depth1 => $depth1Value) {
            if (isset($depth1Value['ThemeLevel'])) {
                $this->options['form_params']['Themes.' . ($depth1 + 1) . '.ThemeLevel'] = $depth1Value['ThemeLevel'];
            }
            if (isset($depth1Value['ThemeId'])) {
                $this->options['form_params']['Themes.' . ($depth1 + 1) . '.ThemeId'] = $depth1Value['ThemeId'];
            }
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEndpoint($value)
    {
        $this->data['Endpoint'] = $value;
        $this->options['form_params']['Endpoint'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEnvType($value)
    {
        $this->data['EnvType'] = $value;
        $this->options['form_params']['EnvType'] = $value;

        return $this;
    }
}
