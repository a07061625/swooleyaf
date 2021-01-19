<?php
/**
 * solr单例类
 * User: 姜伟
 * Date: 2017/3/4 0004
 * Time: 10:20
 */

namespace DesignPatterns\Singletons;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Solr\SolrException;
use SyLog\Log;
use SyTool\Tool;
use SyTrait\SingletonTrait;

class SolrSingleton
{
    use SingletonTrait;

    /**
     * @var string
     */
    private $server = '';
    /**
     * @var string
     */
    private $core = '';
    /**
     * @var string
     */
    private $authToken = '';

    private function __construct()
    {
        $configs = Tool::getConfig('solr.' . SY_ENV . SY_PROJECT);

        $connectUrl = (string)Tool::getArrayVal($configs, 'connect.url', '', true);
        if (0 == preg_match(ProjectBase::REGEX_URL_HTTP, $connectUrl)) {
            throw new SolrException('服务地址不合法', ErrorCode::SOLR_PARAM_ERROR);
        }

        $coreName = (string)Tool::getArrayVal($configs, 'core.name', '', true);
        if (0 == preg_match('/^[0-9a-zA-Z]{2,50}$/', $coreName)) {
            throw new SolrException('core名称不合法', ErrorCode::SOLR_PARAM_ERROR);
        }

        $userName = (string)Tool::getArrayVal($configs, 'user.name', '', true);
        if (\strlen($userName) > 0) {
            $userPwd = (string)Tool::getArrayVal($configs, 'user.password', '', true);
            $this->authToken = 'Basic ' . base64_encode($userName . ':' . $userPwd);
        }

        $this->server = $connectUrl;
        $this->core = $coreName;
    }

    /**
     * @return \DesignPatterns\Singletons\SolrSingleton
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 添加数据
     * 注:字符串类型的数据,如果是以汉字一开头,需要将在数据之前加上字符串&nbsp;
     *
     * @param array $data 数据内容
     */
    public function add(array $data): array
    {
        $resArr = [
            'code' => 0,
        ];

        $result = $this->httpPost('/update?commit=true', $data);
        if (isset($result['responseHeader']['status']) && (0 == $result['responseHeader']['status'])) {
            $resArr['data'] = $result;
        } else {
            Log::error(Tool::jsonEncode($result, JSON_UNESCAPED_UNICODE), ErrorCode::SOLR_ADD_ERROR);
            $resArr['code'] = ErrorCode::SOLR_ADD_ERROR;
            $resArr['message'] = '添加失败';
        }

        return $resArr;
    }

    /**
     * 更新数据
     * 注:字符串类型的数据,如果是以汉字一开头,需要将在数据之前加上字符串&nbsp;
     * _childDocuments_:子文档标识
     * <pre>
     * 修改字段样例: 增加,递增类似结构
     * $data[] = [
     *     'id' => 'sz_0000_1234', --必须有,用于标示修改的数据
     *     'latlng' => [ --需要数据变动的字段名称
     *         'set' => '33,123' --变动数据
     *     ],
     * ];
     * </pre>
     *
     * @param array $data 数据内容
     *                    set:更新值，null清空当前值
     *                    add:增加值(字段属性必须为multi-valued)
     *                    inc:递增值(递增字段数据类型必须是数字类型)
     */
    public function update(array $data): array
    {
        $resArr = [
            'code' => 0,
        ];

        $result = $this->httpPost('/update?commit=true', $data);
        if (isset($result['responseHeader']['status']) && (0 == $result['responseHeader']['status'])) {
            $resArr['data'] = $result;
        } else {
            Log::error(Tool::jsonEncode($result, JSON_UNESCAPED_UNICODE), ErrorCode::SOLR_UPDATE_ERROR);
            $resArr['code'] = ErrorCode::SOLR_UPDATE_ERROR;
            $resArr['message'] = '更新失败';
        }

        return $resArr;
    }

    /**
     * 删除数据
     * <pre>
     * 删除指定数据:
     * $data = [
     *     'delete' => [
     *         0 => [
     *             'id' => 'sz_0000_755684'
     *         ],
     *     ]
     * ];
     *
     * 查询删除数据:--删除联盟ID不为10143且城市为sz的所有数据
     * $data = [
     *     'delete' => [
     *         'query' => '(-channelid:10143) AND (citymark:sz)',
     *     ]
     * ];
     * </pre>
     *
     * @param array $data 删除的数据
     */
    public function delete(array $data): array
    {
        $resArr = [
            'code' => 0,
        ];

        $result = $this->httpPost('/update?commit=true', $data);
        if (isset($result['responseHeader']['status']) && (0 == $result['responseHeader']['status'])) {
            $resArr['data'] = $result;
        } else {
            Log::error(Tool::jsonEncode($result, JSON_UNESCAPED_UNICODE), ErrorCode::SOLR_DELETE_ERROR);
            $resArr['code'] = ErrorCode::SOLR_DELETE_ERROR;
            $resArr['message'] = '删除失败';
        }

        return $resArr;
    }

    /**
     * 搜索
     * </pre>
     * 注1:数组为一维关联数组,如下所示:
     * [
     *     'q' => 'aaa' ---可用的key请参考solr开发文档,value必须经过urlencode编码
     * ]
     * 注2:参数数组中,value未编码前,如果key=q,则搜索关键字中不能包含符号:,如果key != q,则value中不能包含符号:
     * </pre>
     *
     * @param array $data 配置参数数组
     */
    public function select(array $data): array
    {
        $resArr = [
            'code' => 0,
        ];

        $result = $this->httpGet('select', $data);
        if (isset($result['responseHeader']['status']) && (0 == $result['responseHeader']['status'])) {
            $resArr['data'] = $result;
        } else {
            Log::error(Tool::jsonEncode($result, JSON_UNESCAPED_UNICODE), ErrorCode::SOLR_SELECT_ERROR);
            $resArr['code'] = ErrorCode::SOLR_SELECT_ERROR;
            $resArr['message'] = '查询失败';
        }

        return $resArr;
    }

    /**
     * 分词
     *
     * @param array $data 配置参数
     *                    analysis_key: string 分词器名称
     *                    keyword: string 待分词字符串
     */
    public function analysis(array $data): array
    {
        $resArr = [
            'code' => 0,
        ];

        $result = $this->httpGet('analysis/field', [
            'analysis.showmatch' => 'true',
            'analysis.fieldtype' => $data['analysis_key'],
            'analysis.fieldvalue' => urlencode($data['keyword']),
        ]);
        if (isset($result['responseHeader']['status']) && (0 == $result['responseHeader']['status'])) {
            $resArr['data'] = $result;
        } else {
            Log::error(Tool::jsonEncode($result, JSON_UNESCAPED_UNICODE), ErrorCode::SOLR_ANALYSIS_ERROR);
            $resArr['code'] = ErrorCode::SOLR_ANALYSIS_ERROR;
            $resArr['message'] = '分词失败';
        }

        return $resArr;
    }

    /**
     * 发送POST请求
     *
     * @param string $method 操作类型
     * @param array  $data   数据数组
     *
     * @return array
     *
     * @throws \SyException\Solr\SolrException
     */
    private function httpPost(string $method, array $data)
    {
        $dataStr = Tool::jsonEncode($data, JSON_UNESCAPED_UNICODE);
        $url = $this->server . $this->core . $method;

        $httpHeaders = [
            'Content-Type: application/json',
            'Content-Length: ' . \strlen($dataStr),
            'Expect:',
        ];
        if (\strlen($this->authToken) > 0) {
            $httpHeaders[] = 'Authorization: ' . $this->authToken;
        }
        $sendRes = Tool::sendCurlReq([
            CURLOPT_URL => $url,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $dataStr,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_HTTPHEADER => $httpHeaders,
        ]);

        if (0 == $sendRes['res_no']) {
            $resData = Tool::jsonDecode($sendRes['res_content']);
            if (\is_array($resData)) {
                return $resData;
            }
            Log::error('解析POST响应失败,响应数据=' . $sendRes['res_content'], ErrorCode::SOLR_POST_ERROR);

            throw new SolrException('解析POST响应失败', ErrorCode::SOLR_POST_ERROR);
        }
        Log::error('curl发送solr post请求出错,错误码=' . $sendRes['res_no'] . ',错误信息=' . $sendRes['res_msg'], ErrorCode::SOLR_POST_ERROR);

        throw new SolrException('POST请求出错', ErrorCode::SOLR_POST_ERROR);
    }

    /**
     * 发送GET请求
     *
     * @param string $method 操作类型
     * @param array  $data   数据数组
     *
     * @return array
     *
     * @throws \SyException\Solr\SolrException
     */
    private function httpGet(string $method, array $data)
    {
        $url = $this->server . $this->core . '/' . $method . '?wt=json';
        foreach ($data as $key => $eData) {
            if (\strlen($key) > 0) {
                if (\is_array($eData)) {
                    foreach ($eData as $eData1) {
                        $url .= '&' . $key . '=' . $eData1;
                    }
                } else {
                    $url .= '&' . $key . '=' . $eData;
                }
            }
        }

        $httpHeaders = [
            'Content-Type: application/json',
        ];
        if (\strlen($this->authToken) > 0) {
            $httpHeaders[] = 'Authorization: ' . $this->authToken;
        }

        $sendRes = Tool::sendCurlReq([
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_HTTPHEADER => $httpHeaders,
        ]);
        if (0 == $sendRes['res_no']) {
            $resData = Tool::jsonDecode($sendRes['res_content']);
            if (\is_array($resData)) {
                return $resData;
            }
            Log::error('解析GET响应失败,响应数据=' . $sendRes['res_content'], ErrorCode::SOLR_GET_ERROR);

            throw new SolrException('解析GET响应失败', ErrorCode::SOLR_GET_ERROR);
        }
        Log::error('curl发送solr get请求出错,错误码=' . $sendRes['res_no'] . ',错误信息=' . $sendRes['res_msg'], ErrorCode::SOLR_GET_ERROR);

        throw new SolrException('GET请求出错', ErrorCode::SOLR_GET_ERROR);
    }
}
