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

namespace AliOpen\NlsFileTrans;

use AliOpen\Core\RpcAcsRequest;

class GetTaskResultRequest extends RpcAcsRequest
{
    private $debug;
    private $taskId;

    public function __construct()
    {
        parent::__construct('nls-filetrans', '2018-08-17', 'GetTaskResult');
    }

    public function getDebug()
    {
        return $this->debug;
    }

    public function setDebug($debug)
    {
        $this->debug = $debug;
        $this->queryParameters['Debug'] = $debug;
    }

    public function getTaskId()
    {
        return $this->taskId;
    }

    public function setTaskId($taskId)
    {
        $this->taskId = $taskId;
        $this->queryParameters['TaskId'] = $taskId;
    }
}
