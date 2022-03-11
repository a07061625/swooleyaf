<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/14 0014
 * Time: 8:53
 */

namespace Wx\Account\Statistics;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseAccount;
use Wx\WxUtilAccount;
use Wx\WxUtilBase;

class Statistics extends WxBaseAccount
{
    const TYPE_USER_DAY_CHANGE = '0100';
    const TYPE_USER_DAY_TOTAL = '0101';
    const TYPE_ARTICLE_SEND_DAY_CHANGE = '0200';
    const TYPE_ARTICLE_SEND_DAY_TOTAL = '0201';
    const TYPE_ARTICLE_READ_DAY_CHANGE = '0202';
    const TYPE_ARTICLE_READ_HOUR_CHANGE = '0203';
    const TYPE_ARTICLE_SHARE_DAY_CHANGE = '0204';
    const TYPE_ARTICLE_SHARE_HOUR_CHANGE = '0205';
    const TYPE_MSG_SEND_DAY_CHANGE = '0300';
    const TYPE_MSG_SEND_HOUR_CHANGE = '0301';
    const TYPE_MSG_SEND_WEEK_CHANGE = '0302';
    const TYPE_MSG_SEND_MONTH_CHANGE = '0303';
    const TYPE_MSG_DIST_DAY_CHANGE = '0304';
    const TYPE_MSG_DIST_WEEK_CHANGE = '0305';
    const TYPE_MSG_DIST_MONTH_CHANGE = '0306';
    const TYPE_INTERFACE_DAY_CHANGE = '0400';
    const TYPE_INTERFACE_HOUR_CHANGE = '0401';

    /**
     * 公众号ID
     *
     * @var string
     */
    private $appid = '';
    /**
     * 起始日期
     *
     * @var string
     */
    private $begin_date = '';
    /**
     * 结束日期
     *
     * @var string
     */
    private $end_date = '';
    /**
     * 最大日期天数
     *
     * @var int
     */
    private $max_date = 0;

    public function __construct(string $appId, string $type)
    {
        parent::__construct();
        $this->appid = $appId;

        switch ($type) {
            case self::TYPE_USER_DAY_CHANGE: //用户每日变动数
                $this->serviceUrl = 'https://api.weixin.qq.com/datacube/getusersummary?access_token=';
                $this->max_date = 7;

                break;
            case self::TYPE_USER_DAY_TOTAL: //用户每日总数
                $this->serviceUrl = 'https://api.weixin.qq.com/datacube/getusercumulate?access_token=';
                $this->max_date = 7;

                break;
            case self::TYPE_ARTICLE_SEND_DAY_CHANGE: //图文每日发送数
                $this->serviceUrl = 'https://api.weixin.qq.com/datacube/getarticlesummary?access_token=';
                $this->max_date = 1;

                break;
            case self::TYPE_ARTICLE_SEND_DAY_TOTAL: //图文每日发送总数
                $this->serviceUrl = 'https://api.weixin.qq.com/datacube/getarticletotal?access_token=';
                $this->max_date = 1;

                break;
            case self::TYPE_ARTICLE_READ_DAY_CHANGE: //图文每日浏览数
                $this->serviceUrl = 'https://api.weixin.qq.com/datacube/getuserread?access_token=';
                $this->max_date = 3;

                break;
            case self::TYPE_ARTICLE_READ_HOUR_CHANGE: //图文每小时浏览数
                $this->serviceUrl = 'https://api.weixin.qq.com/datacube/getuserreadhour?access_token=';
                $this->max_date = 1;

                break;
            case self::TYPE_ARTICLE_SHARE_DAY_CHANGE: //图文每日分享数
                $this->serviceUrl = 'https://api.weixin.qq.com/datacube/getusershare?access_token=';
                $this->max_date = 7;

                break;
            case self::TYPE_ARTICLE_SHARE_HOUR_CHANGE: //图文每小时分享数
                $this->serviceUrl = 'https://api.weixin.qq.com/datacube/getusersharehour?access_token=';
                $this->max_date = 1;

                break;
            case self::TYPE_MSG_SEND_DAY_CHANGE: //消息每日发送数
                $this->serviceUrl = 'https://api.weixin.qq.com/datacube/getupstreammsg?access_token=';
                $this->max_date = 7;

                break;
            case self::TYPE_MSG_SEND_HOUR_CHANGE: //消息每小时发送数
                $this->serviceUrl = 'https://api.weixin.qq.com/datacube/getupstreammsghour?access_token=';
                $this->max_date = 1;

                break;
            case self::TYPE_MSG_SEND_WEEK_CHANGE: //消息每周发送数
                $this->serviceUrl = 'https://api.weixin.qq.com/datacube/getupstreammsgweek?access_token=';
                $this->max_date = 30;

                break;
            case self::TYPE_MSG_SEND_MONTH_CHANGE: //消息每月发送数
                $this->serviceUrl = 'https://api.weixin.qq.com/datacube/getupstreammsgmonth?access_token=';
                $this->max_date = 30;

                break;
            case self::TYPE_MSG_DIST_DAY_CHANGE: //消息每日分布数
                $this->serviceUrl = 'https://api.weixin.qq.com/datacube/getupstreammsgdist?access_token=';
                $this->max_date = 15;

                break;
            case self::TYPE_MSG_DIST_WEEK_CHANGE: //消息每周分布数
                $this->serviceUrl = 'https://api.weixin.qq.com/datacube/getupstreammsgdistweek?access_token=';
                $this->max_date = 30;

                break;
            case self::TYPE_MSG_DIST_MONTH_CHANGE: //消息每月分布数
                $this->serviceUrl = 'https://api.weixin.qq.com/datacube/getupstreammsgdistmonth?access_token=';
                $this->max_date = 30;

                break;
            case self::TYPE_INTERFACE_DAY_CHANGE: //接口每日调用数
                $this->serviceUrl = 'https://api.weixin.qq.com/datacube/getinterfacesummary?access_token=';
                $this->max_date = 30;

                break;
            case self::TYPE_INTERFACE_HOUR_CHANGE: //接口每小时调用数
                $this->serviceUrl = 'https://api.weixin.qq.com/datacube/getinterfacesummaryhour?access_token=';
                $this->max_date = 1;

                break;
            default:
                throw new WxException('统计类型不支持', ErrorCode::WX_PARAM_ERROR);
        }
    }

    private function __clone()
    {
        //do nothing
    }

    public function setDate(int $beginTime, int $endTime)
    {
        $nowDayTime = strtotime(date('Ymd'));
        if ($beginTime < 1417363200) {
            throw new WxException('起始时间不能小于2014年12月1日', ErrorCode::WX_PARAM_ERROR);
        }
        if ($endTime < 1417363200) {
            throw new WxException('结束时间不能小于2014年12月1日', ErrorCode::WX_PARAM_ERROR);
        }
        if ($beginTime > $endTime) {
            throw new WxException('起始时间不能大于结束时间', ErrorCode::WX_PARAM_ERROR);
        }
        if ($beginTime >= $nowDayTime) {
            throw new WxException('起始时间必须小于今天', ErrorCode::WX_PARAM_ERROR);
        }
        if ($endTime >= $nowDayTime) {
            throw new WxException('结束时间必须小于今天', ErrorCode::WX_PARAM_ERROR);
        }

        $beginDay = date('Y-m-d', $beginTime);
        $endDay = date('Y-m-d', $endTime);
        $beginDayTime = strtotime($beginDay);
        $endDayTime = strtotime($endDay);
        $dayNum = (int)(($endDayTime - $beginDayTime) / 86400);
        if ($dayNum >= $this->max_date) {
            throw new WxException('时间跨度必须小于最大限定天数', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['begin_date'] = $beginDay;
        $this->reqData['end_date'] = $endDay;
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['begin_date'])) {
            throw new WxException('起始时间不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilAccount::getAccessToken($this->appid);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (isset($sendData['errcode'])) {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        } else {
            $resArr['data'] = $sendData;
        }

        return $resArr;
    }
}
