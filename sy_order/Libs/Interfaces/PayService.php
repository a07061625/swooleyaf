<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/9/18 0018
 * Time: 14:30
 */
namespace Interfaces;

interface PayService
{
    /**
     * 校验支付参数
     * @return array
     */
    public function checkPayParams() : array;

    /**
     * 获取支付信息
     * @param array $data
     * @return array 格式如下:<pre>
     * [
     *      'pay_name' => 'aaa' --支付名称,不能超过60个汉字
     *      'pay_money' => 100 --支付金额,单位为分,必须大于0
     *      'pay_attach' => '123_daf' --附加数据,没有则设置成空字符串,只设置一些关键数据且长度不能超过127字节
     *      'pay_sn' => '00002017061322131212345678' --支付单号
     *      'pay_ps' => 0 --分账状态 0:不支持分账 1:不分账 2:分账
     * ]
     * </pre>
     */
    public function getPayInfo(array $data) : array;

    /**
     * 处理支付结果
     * @param array $data 参数数组
     * @return array 支付处理完成后,如需进行后续处理,比如发送短信,模板消息等,则返回非空数组,如不需后续处理,则返回空数组
     */
    public function handlePaySuccess(array $data) : array;

    /**
     * 支付处理成功后续操作
     * @param array $data 参数数组
     * @return mixed
     */
    public function handlePaySuccessAttach(array $data);
}
