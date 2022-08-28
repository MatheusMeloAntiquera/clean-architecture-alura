<?php

namespace Alura\Arquitetura;

use Alura\Arquitetura\Email;

class Aluno
{
    private string $cpf;
    private string $nome;
    private Email $email;

    public function __construct(
        string $cpf,
        string $nome,
        Email $email
    ) {
        $this->cpf = $cpf;
        $this->nome = $nome;
        $this->email = $email;
    }
}
