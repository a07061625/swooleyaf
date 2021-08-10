<?php

namespace League\CLImate\TerminalObject\Dynamic;

use League\CLImate\Decorator\Parser\Parser;
use League\CLImate\Util\UtilFactory;

interface DynamicTerminalObjectInterface
{
    public function settings();

    /**
     * @param $setting
     */
    public function importSetting($setting);

    public function parser(Parser $parser);

    public function util(UtilFactory $util);
}
