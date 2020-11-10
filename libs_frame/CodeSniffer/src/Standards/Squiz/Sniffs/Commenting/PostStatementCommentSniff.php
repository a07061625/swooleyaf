<?php
/**
 * Checks to ensure that there are no comments after statements.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Squiz\Sniffs\Commenting;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class PostStatementCommentSniff implements Sniff
{
    /**
     * A list of tokenizers this sniff supports.
     *
     * @var array
     */
    public $supportedTokenizers = [
        'PHP',
        'JS',
    ];

    /**
     * Exceptions to the rule.
     *
     * If post statement comments are found within the condition
     * parenthesis of these structures, leave them alone.
     *
     * @var array
     */
    private $controlStructureExceptions = [
        T_IF => true,
        T_ELSEIF => true,
        T_SWITCH => true,
        T_WHILE => true,
        T_FOR => true,
        T_FOREACH => true,
    ];

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_COMMENT];
    }

    //end register()

    /**
     * Processes this sniff, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token in the
     *                                               stack passed in $tokens.
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if ('//' !== substr($tokens[$stackPtr]['content'], 0, 2)) {
            return;
        }

        $commentLine = $tokens[$stackPtr]['line'];
        $lastContent = $phpcsFile->findPrevious(T_WHITESPACE, ($stackPtr - 1), null, true);

        if (false === $lastContent
            || $tokens[$lastContent]['line'] !== $commentLine
            || 1 === $tokens[$stackPtr]['column']
        ) {
            return;
        }

        if (T_CLOSE_CURLY_BRACKET === $tokens[$lastContent]['code']) {
            return;
        }

        // Special case for JS files and PHP closures.
        if (T_COMMA === $tokens[$lastContent]['code']
            || T_SEMICOLON === $tokens[$lastContent]['code']
        ) {
            $lastContent = $phpcsFile->findPrevious(T_WHITESPACE, ($lastContent - 1), null, true);
            if (false === $lastContent || T_CLOSE_CURLY_BRACKET === $tokens[$lastContent]['code']) {
                return;
            }
        }

        // Special case for (trailing) comments within multi-line control structures.
        if (true === isset($tokens[$stackPtr]['nested_parenthesis'])) {
            $nestedParens = $tokens[$stackPtr]['nested_parenthesis'];
            foreach ($nestedParens as $open => $close) {
                if (true === isset($tokens[$open]['parenthesis_owner'])
                    && true === isset($this->controlStructureExceptions[$tokens[$tokens[$open]['parenthesis_owner']]['code']])
                ) {
                    return;
                }
            }
        }

        $error = 'Comments may not appear after statements';
        $fix = $phpcsFile->addFixableError($error, $stackPtr, 'Found');
        if (true === $fix) {
            $phpcsFile->fixer->addNewlineBefore($stackPtr);
        }
    }

    //end process()
}//end class
