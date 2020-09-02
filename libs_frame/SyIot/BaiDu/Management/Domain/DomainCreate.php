<?php
/**
 * 创建权限组
 * User: 姜伟
 * Date: 2019/7/18 0018
 * Time: 23:59
 */
namespace SyIot\BaiDu\Management\Domain;

use SyConstant\ErrorCode;
use SyException\Iot\BaiDuIotException;
use SyIot\BaseBaiDu;
use SyIot\UtilBaiDu;
use SyTool\Tool;

class DomainCreate extends BaseBaiDu
{
    /**
     * 名称
     *
     * @var string
     */
    private $name = '';
    /**
     * 描述
     *
     * @var string
     */
    private $description = '';
    /**
     * 类型
     *
     * @var string
     */
    private $type = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/v3/iot/management/domain';
    }

    private function __clone()
    {
    }

    /**
     * @param string $name
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setName(string $name)
    {
        if (ctype_alnum($name)) {
            $this->reqData['name'] = $name;
        } else {
            throw new BaiDuIotException('名称不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param string $description
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setDescription(string $description)
    {
        if (strlen($description) > 0) {
            $this->reqData['description'] = $description;
        } else {
            throw new BaiDuIotException('描述不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param string $type
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setType(string $type)
    {
        if (in_array($type, ['ROOT', 'NORMAL'])) {
            $this->reqData['type'] = $type;
        } else {
            throw new BaiDuIotException('类型不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['name'])) {
            throw new BaiDuIotException('名称不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqData['description'])) {
            throw new BaiDuIotException('描述不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqData['type'])) {
            throw new BaiDuIotException('类型不能为空', ErrorCode::IOT_PARAM_ERROR);
        }

        $this->reqHeader['Authorization'] = UtilBaiDu::createSign([
            'req_method' => self::REQ_METHOD_POST,
            'req_uri' => $this->serviceUri,
            'req_params' => [],
            'req_headers' => [
                'host',
            ],
        ]);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceProtocol . '://' . $this->serviceDomain . $this->serviceUri;
        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);

        return $this->getContent();
    }
}
