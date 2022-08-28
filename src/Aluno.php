<?php

namespace Alura\Arquitetura;

use Alura\Arquitetura\Email;
use Alura\Arquitetura\Telefone;

class Aluno
{
    private Cpf $cpf;
    private string $nome;
    private Email $email;

    /**
     *
     * @var Telefone[]
     */
    private array $telefones = [];

    public function __construct(
        Cpf $cpf,
        string $nome,
        Email $email
    ) {
        $this->cpf = $cpf;
        $this->nome = $nome;
        $this->email = $email;
    }

    public function adicionarTelefone(Telefone $telefone)
    {
        $this->telefones[] = $telefone;
    }

    public function retornaTelefones(): array
    {
        return $this->telefones;
    }
}
