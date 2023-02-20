<?php

declare(strict_types=1);


namespace ProgramandoConCabeza\Management;


use FilesystemIterator;
use ProgramandoConCabeza\CryptoAndDecrypt\CryptoAndDecrypt;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ZipArchive;

final class ReplaceEnvFile
{

    /**
     * @throws \Exception
     */
    public function __invoke(string $env, string $envFile)
    {
        if (!file_exists($envFile)) {
            throw new \Exception('environments.zip not found.');
        }

        $zip = new ZipArchive;
        if ($zip->open($envFile)) {
            $zip->extractTo('./temp/');
            $zip->close();

            if (!file_exists($env)) {
                touch($env);
            }

            $tempContent = file_get_contents('./temp/.env');
            $decryptContent = CryptoAndDecrypt::decrypt($tempContent);

            file_put_contents(
                $env,
                $decryptContent
                );

            $this->deleteFiles();

        } else {
            throw new \Exception('Cannot open ' . $envFile . ' zip env');
        }

    }

    private function deleteFiles()
    {
        $dir = './temp';
        $it = new RecursiveDirectoryIterator(
            $dir,
            FilesystemIterator::SKIP_DOTS
        );
        $files = new RecursiveIteratorIterator(
            $it,
            RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach($files as $file) {
            if ($file->isDir()){
                rmdir($file->getRealPath());
            } else {
                unlink($file->getRealPath());
            }
        }
        rmdir($dir);
    }
}