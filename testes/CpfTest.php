<?php

namespace Alura\Arquitetura\Testes;

use Alura\Arquitetura\Cpf;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class CpfTest extends TestCase
{
    public function testNaoDevePermitiCpfComFormatoInvalido()
    {
        $this->expectException(InvalidArgumentException::class);
        (new Cpf('12345678910'));
    }

    public function testCpfDevePoderSerRepresentadoComoString()
    {
        $cpf = new Cpf('123.456.789-10');
        $this->assertSame('123.456.789-10', (string) $cpf);
    }
}