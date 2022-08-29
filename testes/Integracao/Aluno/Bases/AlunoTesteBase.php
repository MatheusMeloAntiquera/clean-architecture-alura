<?php

namespace Alura\Arquitetura\Testes\Integracao\Aluno\Bases;

use PHPUnit\Framework\TestCase;
use Alura\Arquitetura\Dominio\Aluno\RepositorioDeAluno;

abstract class AlunoTesteBase extends TestCase
{
    protected abstract function setaRepositorioDeAluno(): RepositorioDeAluno;
}
