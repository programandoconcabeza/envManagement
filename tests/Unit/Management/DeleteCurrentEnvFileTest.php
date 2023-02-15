<?php

declare(strict_types=1);


namespace Tests\Unit\Management;


use PHPUnit\Framework\TestCase;
use Src\Management\DeleteCurrentEnvFile;

final class DeleteCurrentEnvFileTest extends TestCase
{

    private DeleteCurrentEnvFile $sut;

    protected function setUp(): void
    {
        $this->sut = new DeleteCurrentEnvFile();
    }

    /**
    * @test
    * be_proper_class
    */
    public function isShouldBeProperClass ()
    {
        $this->assertInstanceOf(DeleteCurrentEnvFile::class, $this->sut);
    }

    /**
    * @test
    * return_string_if_env_file_exist
    */
    public function isShouldReturnStringIfEnvFileExist ()
    {
        $fileName = './env-remove-' . time();

        touch($fileName);
        ($this->sut)($fileName);
        $this->assertEquals(false, file_exists($fileName));
    }
}