#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';

use jahndigital\Classes\Commands\ControllerCommand;
use jahndigital\Classes\Commands\ModelCommand;
use jahndigital\Classes\Commands\RepositoryCommand;

$command = $argv[1] ?? null;

switch ($command) {
    case 'make:model':
        ModelCommand::handle($argv);
        break;
    case 'make:controller':
        ControllerCommand::handle($argv);
        break;
    case 'make:repository':
        RepositoryCommand::handle($argv);
        break;
    default:
        echo "Invalid command\n";
        break;
}
