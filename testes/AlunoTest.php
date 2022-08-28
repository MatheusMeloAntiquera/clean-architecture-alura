<?php

namespace Alura\Arquitetura\Testes;

use Alura\Arquitetura\Cpf;
use Alura\Arquitetura\Aluno;
use Alura\Arquitetura\Email;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Alura\Arquitetura\FabricaAluno;

class AlunoTest extends TestCase
{
    public function testNaoDevePermitirAdicionarUmTelefoneInvalido()
    {
        $fabricaAluno = new FabricaAluno();
        $this->expectException(InvalidArgumentException::class);
        $fabricaAluno->criaNovoAluno(
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
        $fabricaAluno = new FabricaAluno();
        $fabricaAluno->criaNovoAluno(
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

        $aluno = $fabricaAluno->retornaAluno();
        $telefones = $aluno->retornaTelefones();
        $this->assertIsArray($telefones);
        $this->assertSame('(012) 98765-4321', (string) $telefones[0]);
        $this->assertSame('(012) 3333-4321', (string) $telefones[1]);
    }
}
