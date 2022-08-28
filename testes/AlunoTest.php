<?php

namespace Alura\Arquitetura\Testes;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Alura\Arquitetura\Dominio\Aluno\Aluno;

class AlunoTest extends TestCase
{
    public function testNaoDevePermitirAdicionarUmTelefoneInvalido()
    {
        $this->expectException(InvalidArgumentException::class);
        Aluno::criaNovoAluno(
            '123.456.789-10',
            'João',
            'joao@example.com.br'
        )->adicionarTelefone(
            '12',
            '98765-4321'
        );
    }

    public function testDeveRetornaOsTelefonesDoAluno()
    {
        $aluno = Aluno::criaNovoAluno(
            '123.456.789-10',
            'João',
            'joao@example.com.br'
        )->adicionarTelefone(
            '012',
            '98765-4321'
        )->adicionarTelefone(
            '012',
            '3333-4321'
        );

        $telefones = $aluno->retornaTelefones();
        $this->assertIsArray($telefones);
        $this->assertSame('(012) 98765-4321', (string) $telefones[0]);
        $this->assertSame('(012) 3333-4321', (string) $telefones[1]);
    }
}
