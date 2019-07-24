<?php
/**
 * 查询项目详情
 * User: 姜伟
 * Date: 2019/7/24 0024
 * Time: 14:07
 */
namespace SyIot\Tencent\Product;

use Constant\ErrorCode;
use SyException\Iot\TencentIotException;
use SyIot\IotBaseTencent;

class ProjectDescribe extends IotBaseTencent
{
    /**
     * 项目ID
     * @var int
     */
    private $ProjectId = 0;

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'DescribeProject';
        $this->reqHeader['X-TC-Version'] = '2019-04-23';
    }

    private function __clone()
    {
    }

    /**
     * @param int $projectId
     * @throws \SyException\Iot\TencentIotException
     */
    public function setProjectId(int $projectId)
    {
        if ($projectId > 0) {
            $this->reqData['ProjectId'] = $projectId;
        } else {
            throw new TencentIotException('项目ID不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['ProjectId'])) {
            throw new TencentIotException('项目ID不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        $this->addReqSign();
        return $this->getContent();
    }
}
