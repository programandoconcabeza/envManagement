<?php

declare(strict_types=1);


namespace ProgramandoConCabeza\Management;


use ProgramandoConCabeza\CryptoAndDecrypt\CryptoAndDecrypt;
use ZipArchive;

final class CreateEnvZipFile
{
    /**
     * @throws \Exception
     */
    public function __invoke(string $env, string $envZip)
    {
        if (!file_exists($env)) {
            throw new \Exception('Env file does not exist.');
        }

        $envContent = file_get_contents($env);
        $envCrypt = CryptoAndDecrypt::encrypt($envContent);

        $zip = new ZipArchive;
        if ($zip->open($envZip, ZipArchive::CREATE|ZipArchive::OVERWRITE))
        {
            $zip->addFromString($env, $envCrypt);
            $zip->close();
        }
    }
}