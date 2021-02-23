<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-3-10
 * Time: 21:47
 */
namespace Factories;

use Entities\SyTask\AliconfigPayEntity;
use Entities\SyTask\DingtalkConfigCorpEntity;
use Entities\SyTask\TaskBaseEntity;
use Entities\SyTask\TaskLogEntity;
use Entities\SyTask\WebhookEntity;
use Entities\SyTask\WxconfigAccountEntity;
use Entities\SyTask\WxconfigBaseEntity;
use Entities\SyTask\WxconfigCorpEntity;
use Entities\SyTask\WxopenAuthorizerEntity;
use Entities\SyTask\WxproviderCorpAuthorizerEntity;
use SyTrait\SimpleTrait;

class SyTaskMysqlFactory
{
    use SimpleTrait;

    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyTask\TaskBaseEntity
     */
    public static function getTaskBaseEntity(string $dbTag = '')
    {
        return new TaskBaseEntity($dbTag);
    }
    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyTask\TaskLogEntity
     */
    public static function getTaskLogEntity(string $dbTag = '')
    {
        return new TaskLogEntity($dbTag);
    }
    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyTask\WxopenAuthorizerEntity
     */
    public static function getWxopenAuthorizerEntity(string $dbTag = '')
    {
        return new WxopenAuthorizerEntity($dbTag);
    }
    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyTask\WxproviderCorpAuthorizerEntity
     */
    public static function getWxproviderCorpAuthorizerEntity(string $dbTag = '')
    {
        return new WxproviderCorpAuthorizerEntity($dbTag);
    }
    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyTask\WxconfigBaseEntity
     */
    public static function getWxconfigBaseEntity(string $dbTag = '')
    {
        return new WxconfigBaseEntity($dbTag);
    }
    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyTask\WxconfigAccountEntity
     */
    public static function getWxconfigShopEntity(string $dbTag = '')
    {
        return new WxconfigAccountEntity($dbTag);
    }
    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyTask\WxconfigCorpEntity
     */
    public static function getWxconfigCorpEntity(string $dbTag = '')
    {
        return new WxconfigCorpEntity($dbTag);
    }
    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyTask\AliconfigPayEntity
     */
    public static function getAliconfigPayEntity(string $dbTag = '')
    {
        return new AliconfigPayEntity($dbTag);
    }
    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyTask\DingtalkConfigCorpEntity
     */
    public static function getDingtalkConfigCorpEntity(string $dbTag = '')
    {
        return new DingtalkConfigCorpEntity($dbTag);
    }
    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyTask\WebhookEntity
     */
    public static function getWebhookEntity(string $dbTag = '')
    {
        return new WebhookEntity($dbTag);
    }
}
