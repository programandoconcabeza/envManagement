<?php

declare(strict_types=1);


namespace Tests\Unit\Management;


use Exception;
use PHPUnit\Framework\TestCase;
use Src\Management\PutEnvFromZipFile;
use ZipArchive;

final class PutEnvFromZipFileTest extends TestCase
{

    private PutEnvFromZipFile $sut;

    const ENV_FILE = './.env';
    const ENV_ZIP_FILE = './environments.zip';

    protected function setUp(): void
    {
        $this->sut = new PutEnvFromZipFile();
    }

    /**
    * @test
    * be_proper_class
    */
    public function isShouldBeProperClass ()
    {
        $this->assertInstanceOf(PutEnvFromZipFile::class, $this->sut);
    }

    /**
    * @test
    * throw_exception_if_zip_does_not_exist
    */
    public function isShouldThrowExceptionIfZipDoesNotExist ()
    {
        $this->expectException(Exception::class);
        ($this->sut)('notZipExist.zip', '');
    }

    /**
     * @test
     * return_empty_if_file_is_empty
     * @throws Exception
     */
    public function isShouldExtractCorrectEnvFile ()
    {

        if (!file_exists(self::ENV_FILE)) {
            $this->createCustomEnvFile();
        }

        $zip = new ZipArchive();
        if ($zip->open(self::ENV_ZIP_FILE, ZipArchive::CREATE) === TRUE) {
            $zip->addFile(self::ENV_FILE);
        }
        $zip->close();

        ($this->sut)(self::ENV_ZIP_FILE, self::ENV_FILE);
        $this->assertEquals(true, file_exists(self::ENV_FILE));
    }

    private function createCustomEnvFile()
    {
        file_put_contents('./.env', '');
    }
}