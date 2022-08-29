<?php

namespace Alura\Arquitetura\Testes\Integracao\Aluno;

use Alura\Arquitetura\Dominio\Aluno\RepositorioDeAluno;
use Alura\Arquitetura\Infra\Aluno\RepositorioDeAlunoEmMemoria;
use Alura\Arquitetura\Testes\Integracao\Aluno\Bases\BuscarAlunoBase;

class BuscarAlunoEmMemoriaTest extends BuscarAlunoBase
{
    protected function setaRepositorioDeAluno(): RepositorioDeAluno
    {
        return new RepositorioDeAlunoEmMemoria();
    }

    public function setUp(): void
    {
        //Para simular uma limpeza na base
        unset($this->repositorioDeAluno);
        $this->repositorioDeAluno = $this->setaRepositorioDeAluno();
    }

}
