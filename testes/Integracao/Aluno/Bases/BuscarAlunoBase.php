<?php

namespace Alura\Arquitetura\Testes\Integracao\Aluno\Bases;

use Alura\Arquitetura\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Dominio\Aluno\RepositorioDeAluno;

abstract class BuscarAlunoBase extends AlunoTesteBase
{
    protected RepositorioDeAluno $repositorioDeAluno;

    public function __construct()
    {
        $this->repositorioDeAluno = $this->setaRepositorioDeAluno();
        parent::__construct();
    }

    protected abstract function setaRepositorioDeAluno(): RepositorioDeAluno;
    
    public function testDeveEncontrarUmAlunoPeloCpf()
    {
        $aluno = Aluno::criaNovoAluno(
            '123.456.789-10',
            'João',
            'joao@example.com'
        );

        $aluno->adicionarTelefone('023', '99999-9999')
            ->adicionarTelefone('023', '8888-8888');

        $this->repositorioDeAluno->adicionarAluno($aluno);

        $alunoBuscado = $this->repositorioDeAluno->buscarPorCpf($aluno->cpf());

        $this->assertEquals($alunoBuscado, $aluno);
    }
}
