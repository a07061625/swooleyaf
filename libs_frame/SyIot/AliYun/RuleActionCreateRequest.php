<?php
/*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */
namespace SyIot\AliYun;

use AliOpen\Core\RpcAcsRequest;

class RuleActionCreateRequest extends RpcAcsRequest
{
    private $configuration;
    private $ruleId;
    private $type;
    private $errorActionFlag;

    public function __construct()
    {
        parent::__construct('Iot', '2018-01-20', 'CreateRuleAction');
        $this->setMethod('POST');
    }

    public function getConfiguration()
    {
        return $this->configuration;
    }

    public function setConfiguration($configuration)
    {
        $this->configuration = $configuration;
        $this->queryParameters['Configuration'] = $configuration;
    }

    public function getRuleId()
    {
        return $this->ruleId;
    }

    public function setRuleId($ruleId)
    {
        $this->ruleId = $ruleId;
        $this->queryParameters['RuleId'] = $ruleId;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
        $this->queryParameters['Type'] = $type;
    }

    public function getErrorActionFlag()
    {
        return $this->errorActionFlag;
    }

    public function setErrorActionFlag($errorActionFlag)
    {
        $this->errorActionFlag = $errorActionFlag;
        $this->queryParameters['ErrorActionFlag'] = $errorActionFlag;
    }
}
