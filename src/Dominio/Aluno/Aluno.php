<?php

namespace Alura\Arquitetura\Dominio\Aluno;

use Alura\Arquitetura\Dominio\Cpf;
use Alura\Arquitetura\Dominio\Email;
use Alura\Arquitetura\Dominio\Aluno\Telefone;

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

    private function __construct(
        Cpf $cpf,
        string $nome,
        Email $email
    ) {
        $this->cpf = $cpf;
        $this->nome = $nome;
        $this->email = $email;
    }

    /**
     * named constructor
     *
     * @param string $cpf
     * @param string $nome
     * @param string $email
     * @return Aluno
     */
    public static function criaNovoAluno(
        string $cpf,
        string $nome,
        string $email
    ) {
        return new Aluno(
            new Cpf($cpf),
            $nome,
            new Email($email)
        );
    }

    public function adicionarTelefone(string $ddd, string $telefone)
    {
        $this->telefones[] = new Telefone($ddd, $telefone);
        return $this;
    }

    /**
     *
     * @return Telefone[]
     */
    public function telefones(): array
    {
        return $this->telefones;
    }

    public function cpf(): string
    {
        return $this->cpf;
    }

    public function nome(): string
    {
        return $this->nome;
    }

    public function email()
    {
        return $this->email;
    }
}
