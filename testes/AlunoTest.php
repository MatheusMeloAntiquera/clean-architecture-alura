<?php

namespace Alura\Arquitetura\Testes;

use Alura\Arquitetura\Cpf;
use Alura\Arquitetura\Aluno;
use Alura\Arquitetura\Email;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class AlunoTest extends TestCase
{
    public function testNaoDevePermitirAdicionarUmTelefoneInvalido()
    {
        $this->expectException(InvalidArgumentException::class);
        (new Aluno(
            new Cpf('123.456.789-10'),
            'João',
            new Email('joao@example.com.br')
        ))->adicionarTelefone(
            '12',
            '98765-4321'
        );
    }

    public function testDeveRetornaOsTelefonesDoAluno()
    {
        $aluno = new Aluno(
            new Cpf('123.456.789-10'),
            'João',
            new Email('joao@example.com.br')
        );

        $aluno->adicionarTelefone(
            '012',
            '98765-4321'
        );

        $telefones = $aluno->retornaTelefones();
        $this->assertIsArray($telefones);
        $this->assertSame('012 98765-4321', (string) $telefones[0]);
    }
}
