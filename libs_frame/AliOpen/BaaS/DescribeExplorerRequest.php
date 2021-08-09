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

namespace AliOpen\BaaS;

use AliOpen\Core\RpcAcsRequest;

class DescribeExplorerRequest extends RpcAcsRequest
{
    private $organizationId;

    private $exBody;

    private $exUrl;

    private $exMethod;

    public function __construct()
    {
        parent::__construct('Baas', '2018-07-31', 'DescribeExplorer');
    }

    public function getOrganizationId()
    {
        return $this->organizationId;
    }

    public function setOrganizationId($organizationId)
    {
        $this->organizationId = $organizationId;
    }

    public function getExBody()
    {
        return $this->exBody;
    }

    public function setExBody($exBody)
    {
        $this->exBody = $exBody;
        $this->queryParameters['ExBody'] = $exBody;
    }

    public function getExUrl()
    {
        return $this->exUrl;
    }

    public function setExUrl($exUrl)
    {
        $this->exUrl = $exUrl;
        $this->queryParameters['ExUrl'] = $exUrl;
    }

    public function getExMethod()
    {
        return $this->exMethod;
    }

    public function setExMethod($exMethod)
    {
        $this->exMethod = $exMethod;
        $this->queryParameters['ExMethod'] = $exMethod;
    }
}
