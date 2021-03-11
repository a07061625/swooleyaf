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
    '@PHP56Migration' => true,
    '@PHPUnit60Migration:risky' => true,
    '@PhpCsFixer' => true,
    '@PhpCsFixer:risky' => true,
    'list_syntax' => ['syntax' => 'long'],
    'encoding' => true, //PHP代码必须只使用没有BOM的UTF-8
    'line_ending' => true, //所有的PHP文件编码必须一致
    'array_syntax' => ['syntax' => 'short'], //用[]关键字来定义数组
    'single_quote' => true, //简单字符串应该使用单引号代替双引号
    'self_accessor' => true, //在当前类中使用 self 代替类名
    'binary_operator_spaces' => ['default' => 'single_space'], //二进制运算符应按配置包含的空格 align:居中 align_single_space:默认,单空格居中 align_single_space_minimal:单空格居中且空格大于1个的时候缩减到1个 no_space:没有空格 single_space:单空格,不居中 null:不做任何改变
    'include' => true, //Include/Require的时候不应该用括号扩起来,应该用空格分割
    'standardize_not_equals' => true, //使用 <> 代替 !=
    'no_closing_tag' => true, //关闭标签必须在 PHP 文件中去掉
    'no_unused_imports' => true, //删除没用到的use
    'no_singleline_whitespace_before_semicolons' => true, //禁止在关闭分号前使用单行空格
    'no_empty_statement' => true, //不应该存在空的结构体
    'no_extra_consecutive_blank_lines' => true,
    'no_unreachable_default_argument_value' => true,
    'no_blank_lines_after_class_opening' => true, //class 开标签后面不应该有空
    'no_trailing_comma_in_list_call' => true, //删除list语句中多余的逗号
    'no_leading_namespace_whitespace' => true, //命名空间前面不应该有空格
    'no_useless_else' => true, //不需要没有用的 else 分支
    'no_useless_return' => true,
    'object_operator_without_whitespace' => true,
    'ordered_class_elements' => true,
    'ordered_imports' => true,
    'phpdoc_add_missing_param_annotation' => true,
    'strict_comparison' => false,
    'strict_param' => false,
    'concat_space' => ['spacing' => 'one'], //连接字符是否需要空格,可选配置项 none:不需要 one:一个空格
    'simplified_null_return' => true,
    'pre_increment' => false,
    'align_multiline_comment' => ['comment_type' => 'phpdocs_only'], //每行多行DocComments必须有一个星号（PSR-5）,并且必须与第一行对齐
    'blank_line_after_namespace' => true, //命名空间之后空一行
    'blank_line_after_opening_tag' => false, //<?php 后面加一个空行
    'blank_line_before_statement' => ['statements' => ['break', 'continue', 'declare', 'return', 'throw', 'try'],], //空行换行必须在任何已配置的语句之前,可选配置项:break,case,continue,declare,default,die,do,exit,for,foreach,goto,if,include,include_once,require,require_once,return,switch,throw,try,while,yield
    'cast_spaces' => ['space' => 'none',], //类型转换的时候,是否需要在中间加空格 none:不加 single:加一个空格
    'class_keyword_remove' => false, //::class关键字移除,转成字符串
    'combine_consecutive_issets' => true, //当多个isset通过&&连接的时候,合并处理
    'combine_consecutive_unsets' => true, //当多个unset使用的时候,合并处理
    'declare_equal_normalize' => ['space' => 'single'], //declare语句中的等于号是否需要空格 none:不需要 single:一个空格
    'elseif' => true, //用elseif来代替else if
    'full_opening_tag' => true, //php代码必须用 <?php 或者 <?= 不能是其他
    'function_declaration' => ['closure_function_spacing' => 'one'], //必包函数关键字function后面是否需要空格 one:一个空格 none:不需要
    'function_typehint_space' => true, //在闭包函数的参数类型约束的时候,是否需要空格
    'general_phpdoc_annotation_remove' => ['annotations' => [],], //phpdoc中应该忽略的注解
    'heredoc_to_nowdoc' => true, //当一个heredoc里面没有变量当时候，可以转成 nowdoc
    'linebreak_after_opening_tag' => true, //在<?php 标签所在的行不允许存在代码
    'lowercase_cast' => true, //数据类型转换必须小写
    'lowercase_constants' => true, //true, false, null 这几个php常量必须为小写
    'lowercase_keywords' => true, //PHP关键字必须小写
    'new_with_braces' => true, //使用 new 关键字创建的所有实例必须后跟括号
    'no_blank_lines_after_phpdoc' => true, //phpdoc 后面不应该有空行
    'no_empty_comment' => true, //不应该存在空注释
    'no_empty_phpdoc' => true, //不应该存在空的 phpdoc
    'no_leading_import_slash' => true, //use 语句中取消前置斜杠
    'no_mixed_echo_print' => ['use' => 'echo'], //不允许混合使用echo和print语句
    'no_multiline_whitespace_around_double_arrow' => true, //运算符 => 不应被多行空格包围
    'no_null_property_initialization' => true, //属性不能用显式初始化 null
    'no_short_echo_tag' => true, //用 <?php echo 来代替 <?=
    'no_spaces_after_function_name' => true, //在函数或者方法定义的时候,不允许函数和左括号之间有空格
    'no_spaces_inside_parenthesis' => true, //在左括号后面不能有空格,在右括号之前不能有空格
    'no_trailing_comma_in_singleline_array' => true, //PHP 单行数组最后不应该有逗号
    'no_trailing_whitespace' => true, //删除非空行末尾的尾随空格
    'no_trailing_whitespace_in_comment' => true, //注释或 PHPDoc 中必须没有尾随空格
    'no_unneeded_control_parentheses' => ['statements' => ['break', 'clone', 'continue', 'echo_print', 'return', 'switch_case', 'yield']], //删除控制语句周围不需要的括号 可选配置项: break,clone,continue,echo_print,return,switch_case,yield
    'no_unneeded_curly_braces' => true, //删除不需要的花括号
    'no_unneeded_final_method' => true, //终态类一定不能有终态方法
    'no_whitespace_before_comma_in_array' => true, //在数组声明中每个逗号前不得有空格
    'not_operator_with_space' => false, //逻辑 NOT 运算符（!）应该具有前导和尾随空格
    'not_operator_with_successor_space' => false, //逻辑 NOT 运算符（!）应该有一个尾随空格
    'phpdoc_align' => ['tags' => ['param', 'return', 'throws', 'type', 'var']], //给定 phpdoc 标签的所有项目必须左对齐或垂直对齐 tags配置项: param,property,return,throws,type,var,method
    'phpdoc_annotation_without_dot' => true, //PHPDoc 注释描述不应该是一个句子,即不能以句号结尾
    'phpdoc_indent' => true, //Docblock 应与文档主题具有相同的缩进
    'phpdoc_no_empty_return' => true, //@return void 和@return null 注释应该 PHPDoc 的被省略
    'phpdoc_no_package' => false, //@package 和@subpackage 注释应该 PHPDoc 的被省略
    'phpdoc_order' => false, //应该对 PHPDoc 中的@param 注释进行排序,以便首先@throws 注释,然后是@return 注释,然后是注释
    'phpdoc_separation' => true, //PHPDoc 中的注释应该组合在一起,以便相同类型的注释紧跟在一起,并且不同类型的注释由单个空行分隔
    'phpdoc_single_line_var_spacing' => true, //单行@var PHPDoc 应该有适当的间距
    'phpdoc_summary' => false, //PHPDoc 摘要应以句号,感叹号或问号结尾
    'phpdoc_var_without_name' => true, //@var 和@type 注释不应包含变量名称
    'single_blank_line_at_eof' => true, //没有结束标记的 PHP 文件必须始终以单个空行换头结束
    'single_line_after_imports' => true, //每个命名空间使用必须在它自己的行上,并且在 use 语句块之后必须有一个空行
    'space_after_semicolon' => ['remove_in_empty_for_expressions' => true,], //分号后修复空格 remove_in_empty_for_expressions:是否应删除空 for 表达式的空格
    'switch_case_semicolon_to_colon' => true, //case 之后应该是冒号而不是分号
    'switch_case_space' => true, //删除 case 冒号和值之间的额外空格
    'ternary_operator_spaces' => true, //三元操作符周围有标准空格
    'trim_array_spaces' => true, //数组应该像函数/方法参数一样格式化,不带前导或尾随单行空格
    'unary_operator_spaces' => true, //一元运算符应放在其操作数旁边
    'whitespace_after_comma_in_array' => true, //在数组声明中,每个逗号后必须有一个空格
    'nullable_type_declaration_for_default_null_value' => true,
    'multiline_whitespace_before_semicolons' => ['strategy' => 'no_multi_line',], //在结束分号之前禁止多行空格或将分号移动到新行
    'space_after_semicolon' => ['remove_in_empty_for_expressions' => true,], //分号后修复空格
];

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules($fixers)
    ->setFinder($finder)
    ->setUsingCache(true);