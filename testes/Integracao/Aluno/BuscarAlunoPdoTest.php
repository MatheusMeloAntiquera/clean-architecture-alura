<?php

namespace Alura\Arquitetura\Testes\Integracao\Aluno;

use PDO;
use PHPUnit\Framework\TestCase;
use Alura\Arquitetura\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Infra\Aluno\RepositorioDeAlunoComPdo;

class BuscarAlunoPdoTest extends TestCase
{
    private static PDO $conexao;
    public static function setUpBeforeClass(): void
    {
        self::$conexao = new PDO('sqlite:test.db');
    }

    public function setUp(): void
    {
        $conexao = new PDO('sqlite:test.db');
        $conexao->prepare("DELETE FROM telefones")->execute();
        $conexao->prepare("DELETE FROM alunos")->execute();
    }

    public function testDeveEncontrarUmAlunoPeloCpf()
    {
        $repositorioDeAlunoComPdo = new RepositorioDeAlunoComPdo(
            self::$conexao
        );

        $aluno = Aluno::criaNovoAluno(
            '123.456.789-10',
            'João',
            'joao@example.com'
        );

        $aluno->adicionarTelefone('023', '99999-9999')
            ->adicionarTelefone('023', '8888-8888');

        $repositorioDeAlunoComPdo->adicionarAluno($aluno);

        $alunoBuscado = $repositorioDeAlunoComPdo->buscarPorCpf($aluno->cpf());

        $this->assertEquals($alunoBuscado, $aluno);
    }
}
