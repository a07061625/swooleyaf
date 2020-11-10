<?php
/**
 * Ensures all calls to inbuilt PHP functions are lowercase.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Squiz\Sniffs\PHP;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

class LowercasePHPFunctionsSniff implements Sniff
{
    /**
     * String -> int hash map of all php built in function names
     *
     * @var array
     */
    private $builtInFunctions;

    /**
     * Construct the LowercasePHPFunctionSniff
     */
    public function __construct()
    {
        $allFunctions = get_defined_functions();
        $this->builtInFunctions = array_flip($allFunctions['internal']);
    }

    //end __construct()

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_STRING];
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

        $content = $tokens[$stackPtr]['content'];
        $contentLc = strtolower($content);
        if ($content === $contentLc) {
            return;
        }

        // Make sure it is an inbuilt PHP function.
        // PHP_CodeSniffer can possibly include user defined functions
        // through the use of vendor/autoload.php.
        if (false === isset($this->builtInFunctions[$contentLc])) {
            return;
        }

        // Make sure this is a function call or a use statement.
        $next = $phpcsFile->findNext(Tokens::$emptyTokens, ($stackPtr + 1), null, true);
        if (false === $next) {
            // Not a function call.
            return;
        }

        $ignore = Tokens::$emptyTokens;
        $ignore[] = T_BITWISE_AND;
        $prev = $phpcsFile->findPrevious($ignore, ($stackPtr - 1), null, true);
        $prevPrev = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($prev - 1), null, true);

        if (T_OPEN_PARENTHESIS !== $tokens[$next]['code']) {
            // Is this a use statement importing a PHP native function ?
            if (T_NS_SEPARATOR !== $tokens[$next]['code']
                && T_STRING === $tokens[$prev]['code']
                && 'function' === $tokens[$prev]['content']
                && false !== $prevPrev
                && T_USE === $tokens[$prevPrev]['code']
            ) {
                $error = 'Use statements for PHP native functions must be lowercase; expected "%s" but found "%s"';
                $data = [
                    $contentLc,
                    $content,
                ];

                $fix = $phpcsFile->addFixableError($error, $stackPtr, 'UseStatementUppercase', $data);
                if (true === $fix) {
                    $phpcsFile->fixer->replaceToken($stackPtr, $contentLc);
                }
            }

            // No open parenthesis; not a "use function" statement nor a function call.
            return;
        }//end if

        if (T_FUNCTION === $tokens[$prev]['code']) {
            // Function declaration, not a function call.
            return;
        }

        if (T_NS_SEPARATOR === $tokens[$prev]['code']) {
            if (false !== $prevPrev
                && (T_STRING === $tokens[$prevPrev]['code']
                || T_NAMESPACE === $tokens[$prevPrev]['code']
                || T_NEW === $tokens[$prevPrev]['code'])
            ) {
                // Namespaced class/function, not an inbuilt function.
                // Could potentially give false negatives for non-namespaced files
                // when namespace\functionName() is encountered.
                return;
            }
        }

        if (T_NEW === $tokens[$prev]['code']) {
            // Object creation, not an inbuilt function.
            return;
        }

        if (T_OBJECT_OPERATOR === $tokens[$prev]['code']
            || T_NULLSAFE_OBJECT_OPERATOR === $tokens[$prev]['code']
        ) {
            // Not an inbuilt function.
            return;
        }

        if (T_DOUBLE_COLON === $tokens[$prev]['code']) {
            // Not an inbuilt function.
            return;
        }

        $error = 'Calls to PHP native functions must be lowercase; expected "%s" but found "%s"';
        $data = [
            $contentLc,
            $content,
        ];

        $fix = $phpcsFile->addFixableError($error, $stackPtr, 'CallUppercase', $data);
        if (true === $fix) {
            $phpcsFile->fixer->replaceToken($stackPtr, $contentLc);
        }
    }

    //end process()
}//end class
