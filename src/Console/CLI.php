<?php

namespace AssistantEngine\AgentLoop\Console;

use AssistantEngine\OpenFunctions\Core\List\ItemList;
use AssistantEngine\OpenFunctions\Core\Types\UserMessage;

class CLI
{
    public static function input()
    {
        // Prompt the user for additional input.
        echo PHP_EOL . "Enter message (or type 'exit' to quit): " ;
        $handle = fopen("php://stdin", "r");
        return trim(fgets($handle));
    }
}