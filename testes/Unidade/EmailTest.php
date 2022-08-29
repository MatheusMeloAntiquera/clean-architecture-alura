<?php

namespace Alura\Arquitetura\Testes;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Alura\Arquitetura\Dominio\Email;

class EmailTest extends TestCase
{
    public function testEmailNoFormatoInvalidoNaoPodeExistir()
    {
        $this->expectException(InvalidArgumentException::class);
        (new Email("email inválido"));
    }

    public function testEmailDevePoderSerRepresentadoComoString()
    {
        $email = new Email('endereco@example.com');
        $this->assertSame('endereco@example.com', (string) $email);
    }
}
