<?php
/**
 * 新建项目
 * User: 姜伟
 * Date: 2019/7/24 0024
 * Time: 14:07
 */
namespace SyIot\Tencent\Project;

use DesignPatterns\Singletons\IotConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Iot\TencentIotException;
use SyIot\BaseTencent;

class ProjectCreate extends BaseTencent
{
    /**
     * 项目名称
     *
     * @var string
     */
    private $ProjectName = '';
    /**
     * 项目描述
     *
     * @var string
     */
    private $ProjectDesc = '';

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'CreateProject';
    }

    private function __clone()
    {
    }

    /**
     * @param string $projectName
     *
     * @throws \SyException\Iot\TencentIotException
     */
    public function setProjectName(string $projectName)
    {
        if (ctype_alnum($projectName)) {
            $this->reqData['ProjectName'] = $projectName;
        } else {
            throw new TencentIotException('项目名称不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param string $projectDesc
     *
     * @throws \SyException\Iot\TencentIotException
     */
    public function setProjectDesc(string $projectDesc)
    {
        if (strlen($projectDesc) > 0) {
            $this->reqData['ProjectDesc'] = $projectDesc;
        } else {
            throw new TencentIotException('项目描述不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['ProjectName'])) {
            throw new TencentIotException('项目名称不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqData['ProjectDesc'])) {
            throw new TencentIotException('项目描述不能为空', ErrorCode::IOT_PARAM_ERROR);
        }

        $config = IotConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
