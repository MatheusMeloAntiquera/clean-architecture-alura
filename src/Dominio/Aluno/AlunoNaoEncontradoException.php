<?php

namespace Alura\Arquitetura\Dominio\Aluno;

use DomainException;
use Alura\Arquitetura\Dominio\Cpf;

class AlunoNaoEncontradoException extends DomainException
{
    public function __construct(string $cpf)
    {
        parent::__construct("Aluno com CPF $cpf não encontrado");
    }
}
