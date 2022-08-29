<?php

namespace Alura\Arquitetura\Dominio\Aluno;

use Alura\Arquitetura\Dominio\Cpf;
use Alura\Arquitetura\Dominio\Aluno\Aluno;

interface RepositorioDeAluno
{
    public function adicionarAluno(Aluno $aluno): void;
    public function removerAluno(Aluno $aluno): void;
    public function buscarPorCpf(string $aluno): null|Aluno;
}
