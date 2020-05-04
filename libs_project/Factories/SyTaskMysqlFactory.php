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
use Entities\SyTask\WxconfigBaseEntity;
use Entities\SyTask\WxconfigCorpEntity;
use Entities\SyTask\WxconfigAccountEntity;
use Entities\SyTask\WxopenAuthorizerEntity;
use Entities\SyTask\WxproviderCorpAuthorizerEntity;
use SyTrait\SimpleTrait;

class SyTaskMysqlFactory
{
    use SimpleTrait;

    /**
     * @param string $dbName 数据库名
     * @return \Entities\SyTask\TaskBaseEntity
     */
    public static function TaskBaseEntity(string $dbName = '')
    {
        return new TaskBaseEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     * @return \Entities\SyTask\TaskLogEntity
     */
    public static function TaskLogEntity(string $dbName = '')
    {
        return new TaskLogEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     * @return \Entities\SyTask\WxopenAuthorizerEntity
     */
    public static function WxopenAuthorizerEntity(string $dbName = '')
    {
        return new WxopenAuthorizerEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     * @return \Entities\SyTask\WxproviderCorpAuthorizerEntity
     */
    public static function WxproviderCorpAuthorizerEntity(string $dbName = '')
    {
        return new WxproviderCorpAuthorizerEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     * @return \Entities\SyTask\WxconfigBaseEntity
     */
    public static function WxconfigBaseEntity(string $dbName = '')
    {
        return new WxconfigBaseEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     * @return \Entities\SyTask\WxconfigAccountEntity
     */
    public static function WxconfigShopEntity(string $dbName = '')
    {
        return new WxconfigAccountEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     * @return \Entities\SyTask\WxconfigCorpEntity
     */
    public static function WxconfigCorpEntity(string $dbName = '')
    {
        return new WxconfigCorpEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     * @return \Entities\SyTask\AliconfigPayEntity
     */
    public static function AliconfigPayEntity(string $dbName = '')
    {
        return new AliconfigPayEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     * @return \Entities\SyTask\DingtalkConfigCorpEntity
     */
    public static function DingtalkConfigCorpEntity(string $dbName = '')
    {
        return new DingtalkConfigCorpEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     * @return \Entities\SyTask\WebhookEntity
     */
    public static function WebhookEntity(string $dbName = '')
    {
        return new WebhookEntity($dbName);
    }
}
