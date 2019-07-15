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

class TopicRouteTableDeleteRequest extends RpcAcsRequest
{
    private $DstTopics;
    private $srcTopic;

    public function __construct()
    {
        parent::__construct('Iot', '2018-01-20', 'DeleteTopicRouteTable');
        $this->setMethod('POST');
    }

    public function getDstTopics()
    {
        return $this->DstTopics;
    }

    public function setDstTopics($DstTopics)
    {
        $this->DstTopics = $DstTopics;
        for ($i = 0; $i < count($DstTopics); $i ++) {
            $this->queryParameters['DstTopic.' . ($i + 1)] = $DstTopics[$i];
        }
    }

    public function getSrcTopic()
    {
        return $this->srcTopic;
    }

    public function setSrcTopic($srcTopic)
    {
        $this->srcTopic = $srcTopic;
        $this->queryParameters['SrcTopic'] = $srcTopic;
    }
}
