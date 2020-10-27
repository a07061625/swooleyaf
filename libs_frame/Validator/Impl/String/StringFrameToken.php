<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-3-26
 * Time: 1:09
 */
namespace Validator\Impl\String;

use SyConstant\ErrorCode;
use SyConstant\Project;
use SyException\Validator\ValidatorException;
use SyServer\BaseServer;
use Validator\BaseValidator;
use Validator\ValidatorService;

class StringFrameToken extends BaseValidator implements ValidatorService
{
    public function __construct()
    {
        parent::__construct();
        $this->validatorType = Project::VALIDATOR_TYPE_STRING_FRAME_TOKEN;
    }

    private function __clone()
    {
    }

    /**
     * @param string $data
     * @param int $compareData
     * @return string
     * @throws \SyException\Validator\ValidatorException
     */
    public function validator($data, $compareData) : string
    {
        $expireTime = BaseServer::getServerConfig('token_etime', 0);
        if (time() < $expireTime) {
            return '';
        } else {
            throw new ValidatorException('令牌已过期', ErrorCode::COMMON_SERVER_TOKEN_EXPIRE);
        }
    }
}
