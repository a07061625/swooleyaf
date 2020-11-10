<?php
/**
 * Warn about commented out code.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Squiz\Sniffs\PHP;

use PHP_CodeSniffer\Exceptions\TokenizerException;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

class CommentedOutCodeSniff implements Sniff
{
    /**
     * A list of tokenizers this sniff supports.
     *
     * @var array
     */
    public $supportedTokenizers = [
        'PHP',
        'CSS',
    ];

    /**
     * If a comment is more than $maxPercentage% code, a warning will be shown.
     *
     * @var int
     */
    public $maxPercentage = 35;

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
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token
     *                                               in the stack passed in $tokens.
     *
     * @return int|void Integer stack pointer to skip forward or void to continue
     *                  normal file processing.
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        // Ignore comments at the end of code blocks.
        if ('//end ' === substr($tokens[$stackPtr]['content'], 0, 6)) {
            return;
        }

        $content = '';
        $lastLineSeen = $tokens[$stackPtr]['line'];
        $commentStyle = 'line';
        if (0 === strpos($tokens[$stackPtr]['content'], '/*')) {
            $commentStyle = 'block';
        }

        $lastCommentBlockToken = $stackPtr;
        for ($i = $stackPtr; $i < $phpcsFile->numTokens; ++$i) {
            if (false === isset(Tokens::$emptyTokens[$tokens[$i]['code']])) {
                break;
            }

            if (T_WHITESPACE === $tokens[$i]['code']) {
                continue;
            }

            if (true === isset(Tokens::$phpcsCommentTokens[$tokens[$i]['code']])) {
                $lastLineSeen = $tokens[$i]['line'];

                continue;
            }

            if ('line' === $commentStyle
                && ($lastLineSeen + 1) <= $tokens[$i]['line']
                && 0 === strpos($tokens[$i]['content'], '/*')
            ) {
                // First non-whitespace token on a new line is start of a different style comment.
                break;
            }

            if ('line' === $commentStyle
                && ($lastLineSeen + 1) < $tokens[$i]['line']
            ) {
                // Blank line breaks a '//' style comment block.
                break;
            }

            /*
                Trim as much off the comment as possible so we don't
                have additional whitespace tokens or comment tokens
            */

            $tokenContent = trim($tokens[$i]['content']);
            $break = false;

            if ('line' === $commentStyle) {
                if ('//' === substr($tokenContent, 0, 2)) {
                    $tokenContent = substr($tokenContent, 2);
                }

                if ('#' === substr($tokenContent, 0, 1)) {
                    $tokenContent = substr($tokenContent, 1);
                }
            } else {
                if ('/**' === substr($tokenContent, 0, 3)) {
                    $tokenContent = substr($tokenContent, 3);
                }

                if ('/*' === substr($tokenContent, 0, 2)) {
                    $tokenContent = substr($tokenContent, 2);
                }

                if ('*/' === substr($tokenContent, -2)) {
                    $tokenContent = substr($tokenContent, 0, -2);
                    $break = true;
                }

                if ('*' === substr($tokenContent, 0, 1)) {
                    $tokenContent = substr($tokenContent, 1);
                }
            }//end if

            $content .= $tokenContent . $phpcsFile->eolChar;
            $lastLineSeen = $tokens[$i]['line'];

            $lastCommentBlockToken = $i;

            if (true === $break) {
                // Closer of a block comment found.
                break;
            }
        }//end for

        // Ignore typical warning suppression annotations from other tools.
        if (1 === preg_match('`^\s*@[A-Za-z()\._-]+\s*$`', $content)) {
            return $lastCommentBlockToken + 1;
        }

        // Quite a few comments use multiple dashes, equals signs etc
        // to frame comments and licence headers.
        $content = preg_replace('/[-=#*]{2,}/', '-', $content);

        // Random numbers sitting inside the content can throw parse errors
        // for invalid literals in PHP7+, so strip those.
        $content = preg_replace('/\d+/', '', $content);

        $content = trim($content);

        if ('' === $content) {
            return $lastCommentBlockToken + 1;
        }

        if ('PHP' === $phpcsFile->tokenizerType) {
            $content = '<?php ' . $content . ' ?>';
        }

        // Because we are not really parsing code, the tokenizer can throw all sorts
        // of errors that don't mean anything, so ignore them.
        $oldErrors = ini_get('error_reporting');
        ini_set('error_reporting', 0);

        try {
            $tokenizerClass = \get_class($phpcsFile->tokenizer);
            $tokenizer = new $tokenizerClass($content, $phpcsFile->config, $phpcsFile->eolChar);
            $stringTokens = $tokenizer->getTokens();
        } catch (TokenizerException $e) {
            // We couldn't check the comment, so ignore it.
            ini_set('error_reporting', $oldErrors);

            return $lastCommentBlockToken + 1;
        }

        ini_set('error_reporting', $oldErrors);

        $numTokens = \count($stringTokens);

        /*
            We know what the first two and last two tokens should be
            (because we put them there) so ignore this comment if those
            tokens were not parsed correctly. It obviously means this is not
            valid code.
        */

        // First token is always the opening tag.
        if (T_OPEN_TAG !== $stringTokens[0]['code']) {
            return $lastCommentBlockToken + 1;
        }
        array_shift($stringTokens);
        --$numTokens;

        // Last token is always the closing tag, unless something went wrong.
        if (false === isset($stringTokens[($numTokens - 1)])
            || T_CLOSE_TAG !== $stringTokens[($numTokens - 1)]['code']
        ) {
            return $lastCommentBlockToken + 1;
        }
        array_pop($stringTokens);
        --$numTokens;

        // Second last token is always whitespace or a comment, depending
        // on the code inside the comment.
        if ('PHP' === $phpcsFile->tokenizerType) {
            if (false === isset(Tokens::$emptyTokens[$stringTokens[($numTokens - 1)]['code']])) {
                return $lastCommentBlockToken + 1;
            }

            if (T_WHITESPACE === $stringTokens[($numTokens - 1)]['code']) {
                array_pop($stringTokens);
                --$numTokens;
            }
        }

        $emptyTokens = [
            T_WHITESPACE => true,
            T_STRING => true,
            T_STRING_CONCAT => true,
            T_ENCAPSED_AND_WHITESPACE => true,
            T_NONE => true,
            T_COMMENT => true,
        ];
        $emptyTokens += Tokens::$phpcsCommentTokens;

        $numComment = 0;
        $numPossible = 0;
        $numCode = 0;
        $numNonWhitespace = 0;

        for ($i = 0; $i < $numTokens; ++$i) {
            if (true === isset($emptyTokens[$stringTokens[$i]['code']])) {
                // Looks like comment.
                ++$numComment;
            } elseif (true === isset(Tokens::$comparisonTokens[$stringTokens[$i]['code']])
                || true === isset(Tokens::$arithmeticTokens[$stringTokens[$i]['code']])
                || T_GOTO_LABEL === $stringTokens[$i]['code']
            ) {
                // Commented out HTML/XML and other docs contain a lot of these
                // characters, so it is best to not use them directly.
                ++$numPossible;
            } else {
                // Looks like code.
                ++$numCode;
            }

            if (T_WHITESPACE !== $stringTokens[$i]['code']) {
                ++$numNonWhitespace;
            }
        }

        // Ignore comments with only two or less non-whitespace tokens.
        // Sample size too small for a reliably determination.
        if ($numNonWhitespace <= 2) {
            return $lastCommentBlockToken + 1;
        }

        $percentCode = ceil((($numCode / $numTokens) * 100));
        if ($percentCode > $this->maxPercentage) {
            // Just in case.
            $percentCode = min(100, $percentCode);

            $error = 'This comment is %s%% valid code; is this commented out code?';
            $data = [$percentCode];
            $phpcsFile->addWarning($error, $stackPtr, 'Found', $data);
        }

        return $lastCommentBlockToken + 1;
    }

    //end process()
}//end class
