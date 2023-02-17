<?php

require_once 'vendor/autoload.php';

use ProgramandoConCabeza\Management\ManagementProcess;
use ProgramandoConCabeza\PHPColorCli;


try {
    (new ManagementProcess())();
    print_r(PHPColorCli::getColoredString('The process has been successfully.', 'green') . PHP_EOL);

} catch (Exception $e) {
    print_r(PHPColorCli::getColoredString($e->getMessage(), 'red') . PHP_EOL);
}
