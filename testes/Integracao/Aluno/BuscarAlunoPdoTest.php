<?php

namespace Alura\Arquitetura\Testes\Integracao\Aluno;

use PDO;
use Alura\Arquitetura\Dominio\Aluno\RepositorioDeAluno;
use Alura\Arquitetura\Infra\Aluno\RepositorioDeAlunoComPdo;
use Alura\Arquitetura\Testes\Integracao\Aluno\Bases\BuscarAlunoBase;

class BuscarAlunoPdoTest extends BuscarAlunoBase
{
    protected PDO $conexao;

    public function __construct()
    {
        $this->conexao = new PDO('sqlite:test.db');
        parent::__construct();
    }

    public function setaRepositorioDeAluno(): RepositorioDeAluno
    {
        return new RepositorioDeAlunoComPdo($this->conexao);
    }

    public function setUp(): void
    {
        $this->conexao->prepare("DELETE FROM telefones")->execute();
        $this->conexao->prepare("DELETE FROM alunos")->execute();
    }
}
