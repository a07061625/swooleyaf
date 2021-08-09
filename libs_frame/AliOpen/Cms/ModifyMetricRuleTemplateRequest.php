<?php

namespace AliOpen\Cms;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ModifyMetricRuleTemplate
 *
 * @method string getName()
 * @method string getRestVersion()
 * @method string getDescription()
 * @method array getAlertTemplatess()
 * @method string getTemplateId()
 */
class ModifyMetricRuleTemplateRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'Cms',
            '2019-01-01',
            'ModifyMetricRuleTemplate',
            'cms'
        );
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->requestParameters['Name'] = $name;
        $this->queryParameters['Name'] = $name;

        return $this;
    }

    /**
     * @param string $restVersion
     *
     * @return $this
     */
    public function setRestVersion($restVersion)
    {
        $this->requestParameters['RestVersion'] = $restVersion;
        $this->queryParameters['RestVersion'] = $restVersion;

        return $this;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->requestParameters['Description'] = $description;
        $this->queryParameters['Description'] = $description;

        return $this;
    }

    /**
     * @return $this
     */
    public function setAlertTemplatess(array $alertTemplates)
    {
        $this->requestParameters['AlertTemplatess'] = $alertTemplates;
        foreach ($alertTemplates as $depth1 => $depth1Value) {
            $this->queryParameters['AlertTemplates.' . ($depth1 + 1) . '.Period'] = $depth1Value['Period'];
            $this->queryParameters['AlertTemplates.' . ($depth1 + 1) . '.Escalations.Warn.Threshold'] = $depth1Value['EscalationsWarnThreshold'];
            $this->queryParameters['AlertTemplates.' . ($depth1 + 1) . '.Escalations.Warn.ComparisonOperator'] = $depth1Value['EscalationsWarnComparisonOperator'];
            $this->queryParameters['AlertTemplates.' . ($depth1 + 1) . '.Escalations.Critical.Statistics'] = $depth1Value['EscalationsCriticalStatistics'];
            $this->queryParameters['AlertTemplates.' . ($depth1 + 1) . '.Escalations.Info.Times'] = $depth1Value['EscalationsInfoTimes'];
            $this->queryParameters['AlertTemplates.' . ($depth1 + 1) . '.RuleName'] = $depth1Value['RuleName'];
            $this->queryParameters['AlertTemplates.' . ($depth1 + 1) . '.Escalations.Info.Statistics'] = $depth1Value['EscalationsInfoStatistics'];
            $this->queryParameters['AlertTemplates.' . ($depth1 + 1) . '.Escalations.Critical.Times'] = $depth1Value['EscalationsCriticalTimes'];
            $this->queryParameters['AlertTemplates.' . ($depth1 + 1) . '.Escalations.Info.ComparisonOperator'] = $depth1Value['EscalationsInfoComparisonOperator'];
            $this->queryParameters['AlertTemplates.' . ($depth1 + 1) . '.Escalations.Warn.Statistics'] = $depth1Value['EscalationsWarnStatistics'];
            $this->queryParameters['AlertTemplates.' . ($depth1 + 1) . '.Escalations.Info.Threshold'] = $depth1Value['EscalationsInfoThreshold'];
            $this->queryParameters['AlertTemplates.' . ($depth1 + 1) . '.Namespace'] = $depth1Value['Namespace'];
            $this->queryParameters['AlertTemplates.' . ($depth1 + 1) . '.Selector'] = $depth1Value['Selector'];
            $this->queryParameters['AlertTemplates.' . ($depth1 + 1) . '.MetricName'] = $depth1Value['MetricName'];
            $this->queryParameters['AlertTemplates.' . ($depth1 + 1) . '.Category'] = $depth1Value['Category'];
            $this->queryParameters['AlertTemplates.' . ($depth1 + 1) . '.Escalations.Critical.ComparisonOperator'] = $depth1Value['EscalationsCriticalComparisonOperator'];
            $this->queryParameters['AlertTemplates.' . ($depth1 + 1) . '.Escalations.Warn.Times'] = $depth1Value['EscalationsWarnTimes'];
            $this->queryParameters['AlertTemplates.' . ($depth1 + 1) . '.Escalations.Critical.Threshold'] = $depth1Value['EscalationsCriticalThreshold'];
        }

        return $this;
    }

    /**
     * @param string $templateId
     *
     * @return $this
     */
    public function setTemplateId($templateId)
    {
        $this->requestParameters['TemplateId'] = $templateId;
        $this->queryParameters['TemplateId'] = $templateId;

        return $this;
    }
}
