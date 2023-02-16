<?php

declare(strict_types=1);


namespace Src\Management;


final class DeleteCurrentEnvFile
{
    public function __invoke(string $file): void
    {
        if (file_exists($file)) {
            unlink($file);
        }
    }
}