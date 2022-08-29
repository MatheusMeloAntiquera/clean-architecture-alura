<?php

namespace Alura\Arquitetura\Testes\Integracao\Aluno;

use PDO;
use PHPUnit\Framework\TestCase;
use Alura\Arquitetura\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Infra\Aluno\RepositorioDeAlunoComPdo;

class AdicionarAlunoPdoTest extends TestCase
{
    public function setUp(): void
    {
        $conexao = new PDO('sqlite:test.db');
        $conexao->prepare("DELETE FROM telefones")->execute();
        $conexao->prepare("DELETE FROM alunos")->execute();
    }

    public function testDevePersistirUmAlunoUtilizandoPdo()
    {
        $repositorioDeAlunoComPdo = new RepositorioDeAlunoComPdo(
            new PDO('sqlite:test.db')
        );

        $aluno = Aluno::criaNovoAluno(
            '123.456.789-10',
            'João',
            'joao@example.com'
        );

        $aluno->adicionarTelefone('023', '99999-9999')
            ->adicionarTelefone('023', '8888-8888');

        $repositorioDeAlunoComPdo->adicionarAluno($aluno);
        $this->assertTrue(true);
    }
}
