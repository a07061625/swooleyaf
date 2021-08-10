<?php

namespace League\CLImate\TerminalObject\Basic;

use League\CLImate\Decorator\Parser\Parser;
use League\CLImate\Util\UtilFactory;

interface BasicTerminalObjectInterface
{
    public function result();

    public function settings();

    /**
     * @param $setting
     */
    public function importSetting($setting);

    /**
     * @return bool
     */
    public function sameLine();

    public function parser(Parser $parser);

    public function util(UtilFactory $util);
}
