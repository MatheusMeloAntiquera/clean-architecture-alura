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

    public function retornaTelefones(): array
    {
        return $this->telefones;
    }
}
