<?php

namespace Alura\Arquitetura;

use Alura\Arquitetura\Cpf;
use Alura\Arquitetura\Email;
use Alura\Arquitetura\Telefone;

class FabricaAluno
{
    private Aluno $aluno;

    public function criaNovoAluno(
        string $cpf,
        string $nome,
        string $email
    ) {
        $this->aluno = new Aluno(
            new Cpf($cpf),
            $nome,
            new Email($email)
        );
        return $this;
    }

    public function adicionarTelefone(string $ddd, string $telefone): self
    {
        $this->aluno->adicionarTelefone(new Telefone($ddd, $telefone));
        return $this;
    }

    public function retornaAluno(): Aluno
    {
        return $this->aluno;
    }
}
