<?php

declare(strict_types=1);


namespace Src\Management;

use ZipArchive;

final class PutEnvFromZipFile
{
    /**
     * @throws \Exception
     */
    public function __invoke(string $file, string $envFile): void
    {
        if (!file_exists($file)) {
            throw new \Exception('Does not exist ' . $file . ' file');
        }

        (new DeleteCurrentEnvFile())($envFile);

        $zip = new ZipArchive;
        if ($zip->open($file)) {
            $zip->extractTo('./');
            $zip->close();

            if (!file_exists($envFile)) {
                throw new \Exception('Does not extract ' . $file . ' file');
            }

            unlink($file);

        } else {
            throw new \Exception('Cannot open ' . $file . '  zip file');
        }
    }
}