<?php

declare(strict_types=1);


namespace ProgramandoConCabeza\Management;


final class ManagementProcess
{
    const ENV_FILE = './.env';
    const ENV_ZIP_FILE = './environments.zip';

    /**
     * @throws \Exception
     */
    public function __invoke()
    {
        (new PutEnvFromZipFile())(self::ENV_ZIP_FILE, self::ENV_FILE);
    }
}
