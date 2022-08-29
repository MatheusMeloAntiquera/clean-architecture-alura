<?php

namespace Alura\Arquitetura\Infra\Aluno;

use Alura\Arquitetura\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Dominio\Aluno\RepositorioDeAluno;
use Alura\Arquitetura\Dominio\Aluno\AlunoNaoEncontradoException;

class RepositorioDeAlunoEmMemoria implements RepositorioDeAluno
{

    /**
     *
     * @var Aluno[]
     */
    private $alunos = [];

    public function adicionarAluno(Aluno $aluno): void
    {
        $this->alunos[] = $aluno;
    }

    public function removerAluno(Aluno $aluno): void
    {
        foreach ($this->alunos as $indice => $a) {
            if ($aluno->cpf() === $a->cpf()) {
                unset($this->alunos[$indice]);
                return;
            }
        }

        throw new AlunoNaoEncontradoException($aluno->cpf());
    }

    public function buscarPorCpf(string $cpf): null|Aluno
    {
        $alunosFiltrados = array_filter(
            $this->alunos,
            fn (Aluno $aluno) => $aluno->cpf() == $cpf
        );

        if (empty($alunosFiltrados)) {
            return null;
        }

        return $alunosFiltrados[0];
    }

    /**
     *
     * @return Aluno[]
     */
    public function buscarTodos(): array
    {
        return $this->alunos;
    }
}
