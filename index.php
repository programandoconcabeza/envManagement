<?php

require_once 'vendor/autoload.php';

use Src\Management\ManagementProcess;

try {
    (new ManagementProcess())();
} catch (Exception $e) {
    throw new \Exception($e->getMessage());
}