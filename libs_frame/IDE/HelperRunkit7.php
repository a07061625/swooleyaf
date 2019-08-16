<?php
namespace {
    define('RUNKIT_IMPORT_FUNCTIONS', 1);
    define('RUNKIT7_IMPORT_FUNCTIONS', 1);
    define('RUNKIT_IMPORT_CLASS_METHODS', 2);
    define('RUNKIT7_IMPORT_CLASS_METHODS', 2);
    define('RUNKIT_IMPORT_CLASS_CONSTS', 4);
    define('RUNKIT7_IMPORT_CLASS_CONSTS', 4);
    define('RUNKIT_IMPORT_CLASS_PROPS', 8);
    define('RUNKIT7_IMPORT_CLASS_PROPS', 8);
    define('RUNKIT_IMPORT_CLASS_STATIC_PROPS', 16);
    define('RUNKIT7_IMPORT_CLASS_STATIC_PROPS', 16);
    define('RUNKIT_IMPORT_CLASSES', 30);
    define('RUNKIT7_IMPORT_CLASSES', 30);
    define('RUNKIT_IMPORT_OVERRIDE', 32);
    define('RUNKIT7_IMPORT_OVERRIDE', 32);
    define('RUNKIT_ACC_RETURN_REFERENCE', 67108864);
    define('RUNKIT7_ACC_RETURN_REFERENCE', 67108864);
    define('RUNKIT_ACC_PUBLIC', 256);
    define('RUNKIT7_ACC_PUBLIC', 256);
    define('RUNKIT_ACC_PROTECTED', 512);
    define('RUNKIT7_ACC_PROTECTED', 512);
    define('RUNKIT_ACC_PRIVATE', 1024);
    define('RUNKIT7_ACC_PRIVATE', 1024);
    define('RUNKIT_ACC_STATIC', 1);
    define('RUNKIT7_ACC_STATIC', 1);
    define('RUNKIT_OVERRIDE_OBJECTS', 32768);
    define('RUNKIT7_OVERRIDE_OBJECTS', 32768);
    define('RUNKIT_FEATURE_MANIPULATION', 1);
    define('RUNKIT7_FEATURE_MANIPULATION', 1);
    define('RUNKIT_FEATURE_SUPERGLOBALS', 1);
    define('RUNKIT7_FEATURE_SUPERGLOBALS', 1);
    define('RUNKIT_FEATURE_SANDBOX', 0);
    define('RUNKIT7_FEATURE_SANDBOX', 0);
}

namespace {
    /**
     * @param $value [required]
     */
    function runkit7_zval_inspect($value){}

    /**
     * @param $value [required]
     */
    function runkit_zval_inspect($value){}

    /**
     * @param $obj [required]
     */
    function runkit7_object_id($obj){}

    /**
     * @param $obj [required]
     */
    function runkit_object_id($obj){}

    function runkit7_superglobals(){}

    function runkit_superglobals(){}

    /**
     * @param $filename [required]
     * @param $flags [optional]
     */
    function runkit7_import($filename, $flags=null){}

    /**
     * @param $filename [required]
     * @param $flags [optional]
     */
    function runkit_import($filename, $flags=null){}

    /**
     * @param $funcname [required]
     * @param $arglist_or_closure [required]
     * @param $code_or_doc_comment [optional]
     * @param $return_by_reference [optional]
     * @param $doc_comment [optional]
     * @param $return_type [optional]
     * @param $is_strict [optional]
     */
    function runkit7_function_add($funcname, $arglist_or_closure, $code_or_doc_comment=null, $return_by_reference=null, $doc_comment=null, $return_type=null, $is_strict=null){}

    /**
     * @param $funcname [required]
     * @param $arglist_or_closure [required]
     * @param $code_or_doc_comment [optional]
     * @param $return_by_reference [optional]
     * @param $doc_comment [optional]
     * @param $return_type [optional]
     * @param $is_strict [optional]
     */
    function runkit_function_add($funcname, $arglist_or_closure, $code_or_doc_comment=null, $return_by_reference=null, $doc_comment=null, $return_type=null, $is_strict=null){}

    /**
     * @param $funcname [required]
     */
    function runkit7_function_remove($funcname){}

    /**
     * @param $funcname [required]
     */
    function runkit_function_remove($funcname){}

    /**
     * @param $funcname [required]
     * @param $newname [required]
     */
    function runkit7_function_rename($funcname, $newname){}

    /**
     * @param $funcname [required]
     * @param $newname [required]
     */
    function runkit_function_rename($funcname, $newname){}

    /**
     * @param $funcname [required]
     * @param $arglist_or_closure [required]
     * @param $code_or_doc_comment [required]
     * @param $return_by_reference [optional]
     * @param $doc_comment [optional]
     * @param $return_type [optional]
     * @param $is_strict [optional]
     */
    function runkit7_function_redefine($funcname, $arglist_or_closure, $code_or_doc_comment, $return_by_reference=null, $doc_comment=null, $return_type=null, $is_strict=null){}

    /**
     * @param $funcname [required]
     * @param $arglist_or_closure [required]
     * @param $code_or_doc_comment [required]
     * @param $return_by_reference [optional]
     * @param $doc_comment [optional]
     * @param $return_type [optional]
     * @param $is_strict [optional]
     */
    function runkit_function_redefine($funcname, $arglist_or_closure, $code_or_doc_comment, $return_by_reference=null, $doc_comment=null, $return_type=null, $is_strict=null){}

    /**
     * @param $funcname [required]
     * @param $targetname [required]
     */
    function runkit7_function_copy($funcname, $targetname){}

    /**
     * @param $funcname [required]
     * @param $targetname [required]
     */
    function runkit_function_copy($funcname, $targetname){}

    /**
     * @param $classname [required]
     * @param $methodname [required]
     * @param $arglist_or_closure [required]
     * @param $code_or_flags [optional]
     * @param $flags_or_doc_comment [optional]
     * @param $doc_comment [optional]
     * @param $return_type [optional]
     * @param $is_strict [optional]
     */
    function runkit7_method_add($classname, $methodname, $arglist_or_closure, $code_or_flags=null, $flags_or_doc_comment=null, $doc_comment=null, $return_type=null, $is_strict=null){}

    /**
     * @param $classname [required]
     * @param $methodname [required]
     * @param $arglist_or_closure [required]
     * @param $code_or_flags [optional]
     * @param $flags_or_doc_comment [optional]
     * @param $doc_comment [optional]
     * @param $return_type [optional]
     * @param $is_strict [optional]
     */
    function runkit_method_add($classname, $methodname, $arglist_or_closure, $code_or_flags=null, $flags_or_doc_comment=null, $doc_comment=null, $return_type=null, $is_strict=null){}

    /**
     * @param $classname [required]
     * @param $methodname [required]
     * @param $arglist_or_closure [required]
     * @param $code_or_flags [optional]
     * @param $flags_or_doc_comment [optional]
     * @param $doc_comment [optional]
     * @param $return_type [optional]
     * @param $is_strict [optional]
     */
    function runkit7_method_redefine($classname, $methodname, $arglist_or_closure, $code_or_flags=null, $flags_or_doc_comment=null, $doc_comment=null, $return_type=null, $is_strict=null){}

    /**
     * @param $classname [required]
     * @param $methodname [required]
     * @param $arglist_or_closure [required]
     * @param $code_or_flags [optional]
     * @param $flags_or_doc_comment [optional]
     * @param $doc_comment [optional]
     * @param $return_type [optional]
     * @param $is_strict [optional]
     */
    function runkit_method_redefine($classname, $methodname, $arglist_or_closure, $code_or_flags=null, $flags_or_doc_comment=null, $doc_comment=null, $return_type=null, $is_strict=null){}

    /**
     * @param $classname [required]
     * @param $methodname [required]
     */
    function runkit7_method_remove($classname, $methodname){}

    /**
     * @param $classname [required]
     * @param $methodname [required]
     */
    function runkit_method_remove($classname, $methodname){}

    /**
     * @param $classname [required]
     * @param $methodname [required]
     * @param $newname [required]
     */
    function runkit7_method_rename($classname, $methodname, $newname){}

    /**
     * @param $classname [required]
     * @param $methodname [required]
     * @param $newname [required]
     */
    function runkit_method_rename($classname, $methodname, $newname){}

    /**
     * @param $dClass [required]
     * @param $dMethod [required]
     * @param $sClass [required]
     * @param $sMethod [optional]
     */
    function runkit7_method_copy($dClass, $dMethod, $sClass, $sMethod=null){}

    /**
     * @param $dClass [required]
     * @param $dMethod [required]
     * @param $sClass [required]
     * @param $sMethod [optional]
     */
    function runkit_method_copy($dClass, $dMethod, $sClass, $sMethod=null){}

    /**
     * @param $constname [required]
     * @param $value [required]
     * @param $newVisibility [optional]
     */
    function runkit7_constant_redefine($constname, $value, $newVisibility=null){}

    /**
     * @param $constname [required]
     * @param $value [required]
     * @param $newVisibility [optional]
     */
    function runkit_constant_redefine($constname, $value, $newVisibility=null){}

    /**
     * @param $constname [required]
     */
    function runkit7_constant_remove($constname){}

    /**
     * @param $constname [required]
     */
    function runkit_constant_remove($constname){}

    /**
     * @param $constname [required]
     * @param $value [required]
     * @param $newVisibility [optional]
     */
    function runkit7_constant_add($constname, $value, $newVisibility=null){}

    /**
     * @param $constname [required]
     * @param $value [required]
     * @param $newVisibility [optional]
     */
    function runkit_constant_add($constname, $value, $newVisibility=null){}
}
