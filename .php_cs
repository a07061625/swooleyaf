<?php
/**
 * 代码规范检查配置
 * User: 姜伟
 * Date: 2019/5/7
 * Time: 11:16
 */
$finder = PhpCsFixer\Finder::create()
    ->files()
    ->name('*.php')
    ->exclude('vendor')
    ->in(__DIR__)
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);
$fixers = [
    '@PSR2' => true,
    'array_syntax' => ['syntax' => 'short'],
    'combine_consecutive_unsets' => true,
    'single_quote' => true, //简单字符串应该使用单引号代替双引号
    'self_accessor' => true, //在当前类中使用 self 代替类名
    'binary_operator_spaces' => ['default' => 'single_space'], //二进制操作符两端有一个空格
    'include' => true, //include 和文件路径之间需要有一个空格,文件路径不需要用括号括起来
    'standardize_not_equals' => true, //使用 <> 代替 !=
    'no_unused_imports' => true, //删除没用到的use
    'no_singleline_whitespace_before_semicolons' => true, //禁止只有单行空格和分号的写法
    'no_empty_statement' => true, //多余的分号
    'no_extra_consecutive_blank_lines' => true,
    'no_unreachable_default_argument_value' => true,
    'no_blank_lines_after_class_opening' => true, //类开始标签后不应该有空白行
    'no_trailing_comma_in_list_call' => true, //删除list语句中多余的逗号
    'no_leading_namespace_whitespace' => true, //命名空间前面不应该有空格
    'no_useless_else' => false,
    'no_useless_return' => true,
    'object_operator_without_whitespace' => true,
    'ordered_class_elements' => true,
    'ordered_imports' => true,
    'phpdoc_add_missing_param_annotation' => true,
    'phpdoc_order' => false,
    'strict_comparison' => false,
    'strict_param' => true,
    'concat_space' => ['spacing' => 'one'],
    'simplified_null_return' => true,
    'pre_increment' => false,
];
return PhpCsFixer\Config::create()
    ->setRules($fixers)
    ->setFinder($finder)
    ->setUsingCache(true);