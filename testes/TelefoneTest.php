<?php

namespace Alura\Arquitetura\Testes;

use InvalidArgumentException;
use Alura\Arquitetura\Telefone;
use PHPUnit\Framework\TestCase;

class TelefoneTest extends TestCase
{
    public function testNaoDevePermitirDddInvalido()
    {
        $this->expectException(InvalidArgumentException::class);
        (new Telefone(
            '2',
            '12345789'
        ));
    }

    public function testNaoDevePermitirNumeroInvalido()
    {
        $this->expectException(InvalidArgumentException::class);
        (new Telefone(
            '012',
            '1234578910'
        ));
    }

    public function testOTelefoneDevePoderSerRepresentadoComoString()
    {
        $telefone = new Telefone(
            '021',
            '12345-6789'
        );
        $this->assertSame('(021) 12345-6789', (string) $telefone);
    }
}
