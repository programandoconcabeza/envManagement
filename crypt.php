<?php

require_once 'vendor/autoload.php';

use ProgramandoConCabeza\Management\ManagementProcess;
use ProgramandoConCabeza\PHPColorCli;


try {
    (new ManagementProcess())->create();
    print_r(
        PHPColorCli::getColoredString(
        'The process has been successfully.',
        PHPColorCli::colors()->green()
            ) . PHP_EOL
    );

} catch (Exception $e) {
    print_r(
        PHPColorCli::getColoredString(
        $e->getMessage(),
        PHPColorCli::colors()->red()
        ) . PHP_EOL
    );
}
