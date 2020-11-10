<?php
/**
 * Discourages the use of alias functions.
 *
 * Alias functions are kept in PHP for compatibility
 * with older versions. Can be used to forbid the use of any function.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Generic\Sniffs\PHP;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class ForbiddenFunctionsSniff implements Sniff
{
    /**
     * A list of forbidden functions with their alternatives.
     *
     * The value is NULL if no alternative exists. IE, the
     * function should just not be used.
     *
     * @var array<string, null|string>
     */
    public $forbiddenFunctions = [
        'sizeof' => 'count',
        'delete' => 'unset',
    ];

    /**
     * If true, an error will be thrown; otherwise a warning.
     *
     * @var bool
     */
    public $error = true;

    /**
     * A cache of forbidden function names, for faster lookups.
     *
     * @var string[]
     */
    protected $forbiddenFunctionNames = [];

    /**
     * If true, forbidden functions will be considered regular expressions.
     *
     * @var bool
     */
    protected $patternMatch = false;

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        // Everyone has had a chance to figure out what forbidden functions
        // they want to check for, so now we can cache out the list.
        $this->forbiddenFunctionNames = array_keys($this->forbiddenFunctions);

        if (true === $this->patternMatch) {
            foreach ($this->forbiddenFunctionNames as $i => $name) {
                $this->forbiddenFunctionNames[$i] = '/' . $name . '/i';
            }

            return [T_STRING];
        }

        // If we are not pattern matching, we need to work out what
        // tokens to listen for.
        $hasHaltCompiler = false;
        $string = '<?php ';
        foreach ($this->forbiddenFunctionNames as $name) {
            if ('__halt_compiler' === $name) {
                $hasHaltCompiler = true;
            } else {
                $string .= $name . '();';
            }
        }

        if (true === $hasHaltCompiler) {
            $string .= '__halt_compiler();';
        }

        $register = [];

        $tokens = token_get_all($string);
        array_shift($tokens);
        foreach ($tokens as $token) {
            if (true === \is_array($token)) {
                $register[] = $token[0];
            }
        }

        $this->forbiddenFunctionNames = array_map('strtolower', $this->forbiddenFunctionNames);
        $this->forbiddenFunctions = array_combine($this->forbiddenFunctionNames, $this->forbiddenFunctions);

        return array_unique($register);
    }

    //end register()

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token in
     *                                               the stack passed in $tokens.
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        $ignore = [
            T_DOUBLE_COLON => true,
            T_OBJECT_OPERATOR => true,
            T_NULLSAFE_OBJECT_OPERATOR => true,
            T_FUNCTION => true,
            T_CONST => true,
            T_PUBLIC => true,
            T_PRIVATE => true,
            T_PROTECTED => true,
            T_AS => true,
            T_NEW => true,
            T_INSTEADOF => true,
            T_NS_SEPARATOR => true,
            T_IMPLEMENTS => true,
        ];

        $prevToken = $phpcsFile->findPrevious(T_WHITESPACE, ($stackPtr - 1), null, true);

        // If function call is directly preceded by a NS_SEPARATOR it points to the
        // global namespace, so we should still catch it.
        if (T_NS_SEPARATOR === $tokens[$prevToken]['code']) {
            $prevToken = $phpcsFile->findPrevious(T_WHITESPACE, ($prevToken - 1), null, true);
            if (T_STRING === $tokens[$prevToken]['code']) {
                // Not in the global namespace.
                return;
            }
        }

        if (true === isset($ignore[$tokens[$prevToken]['code']])) {
            // Not a call to a PHP function.
            return;
        }

        $nextToken = $phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 1), null, true);
        if (true === isset($ignore[$tokens[$nextToken]['code']])) {
            // Not a call to a PHP function.
            return;
        }

        if (T_STRING === $tokens[$stackPtr]['code'] && T_OPEN_PARENTHESIS !== $tokens[$nextToken]['code']) {
            // Not a call to a PHP function.
            return;
        }

        $function = strtolower($tokens[$stackPtr]['content']);
        $pattern = null;

        if (true === $this->patternMatch) {
            $count = 0;
            $pattern = preg_replace(
                $this->forbiddenFunctionNames,
                $this->forbiddenFunctionNames,
                $function,
                1,
                $count
            );

            if (0 === $count) {
                return;
            }

            // Remove the pattern delimiters and modifier.
            $pattern = substr($pattern, 1, -2);
        } else {
            if (false === \in_array($function, $this->forbiddenFunctionNames, true)) {
                return;
            }
        }//end if

        $this->addError($phpcsFile, $stackPtr, $tokens[$stackPtr]['content'], $pattern);
    }

    //end process()

    /**
     * Generates the error or warning for this sniff.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the forbidden function
     *                                               in the token array.
     * @param string                      $function  The name of the forbidden function.
     * @param string                      $pattern   The pattern used for the match.
     */
    protected function addError($phpcsFile, $stackPtr, $function, $pattern = null)
    {
        $data = [$function];
        $error = 'The use of function %s() is ';
        if (true === $this->error) {
            $type = 'Found';
            $error .= 'forbidden';
        } else {
            $type = 'Discouraged';
            $error .= 'discouraged';
        }

        if (null === $pattern) {
            $pattern = strtolower($function);
        }

        if (null !== $this->forbiddenFunctions[$pattern]
            && 'null' !== $this->forbiddenFunctions[$pattern]
        ) {
            $type .= 'WithAlternative';
            $data[] = $this->forbiddenFunctions[$pattern];
            $error .= '; use %s() instead';
        }

        if (true === $this->error) {
            $phpcsFile->addError($error, $stackPtr, $type, $data);
        } else {
            $phpcsFile->addWarning($error, $stackPtr, $type, $data);
        }
    }

    //end addError()
}//end class
