<?php

declare(strict_types=1);


namespace ProgramandoConCabeza\Management;


use Exception;

abstract class AbstractManagementProcess
{

    const ENV_FILE          = './.env';
    const ENV_ZIP_FILE_PATH = './environments.zip';

    /**
     * @throws Exception
     */
    public function create()
    {
        (new CreateEnvZipFile())(self::ENV_FILE, self::ENV_ZIP_FILE_PATH);
    }

    /**
     * @throws Exception
     */
    public function replace()
    {
        (new ReplaceEnvFile())(self::ENV_FILE, self::ENV_ZIP_FILE_PATH);
    }
}