<?php

declare(strict_types=1);


namespace ProgramandoConCabeza\CryptoAndDecrypt;


use Exception;

final class CryptoAndDecrypt
{

    const CIPHERING    = 'AES-128-CTR';
    const CIPHERING_IV = '5173447794948136';

    /**
     * @throws Exception
     */
    public static function encrypt(string $value): ?string
    {
        $secret = self::promptSilent();

        return openssl_encrypt($value, self::CIPHERING, $secret, 0, self::CIPHERING_IV);
    }

    /**
     * @throws Exception
     */
    public static function decrypt(string $value): string
    {
        $secret = self::promptSilent();

        return openssl_decrypt($value, self::CIPHERING, $secret, 0, self::CIPHERING_IV);
    }

    public static function promptSilent()
    {
        if (preg_match('/^win/i', PHP_OS)) {
            $vbscript = sys_get_temp_dir() . 'prompt_password.vbs';
            file_put_contents(
                $vbscript, 'wscript.echo(InputBox("'
                         . addslashes("Write the secret key:")
                         . '", "", "password here"))');
            $command  = "cscript //nologo " . escapeshellarg($vbscript);
            $password = rtrim(shell_exec($command));
            unlink($vbscript);
        } else {
            $command = "/usr/bin/env bash -c 'echo OK'";
            if (rtrim(shell_exec($command)) !== 'OK') {
                trigger_error("Can't invoke bash");
                return;
            }
            $command  = "/usr/bin/env bash -c 'read -s -p \""
                . addslashes("Write the secret key:")
                . "\" mypassword && echo \$mypassword'";
            $password = rtrim(shell_exec($command));
            echo "\n";
        }
        return $password;
    }
}
