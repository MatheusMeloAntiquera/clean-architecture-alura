<?php

namespace Alura\Arquitetura\Infra\Aluno;

use PDO;

use Alura\Arquitetura\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Dominio\Aluno\RepositorioDeAluno;
use Alura\Arquitetura\Dominio\Aluno\AlunoNaoEncontradoException;

class RepositorioDeAlunoComPdo implements RepositorioDeAluno
{
    private $conexao;
    public function __construct(PDO $conexao)
    {
        $this->conexao = $conexao;
    }
    public function adicionarAluno(Aluno $aluno): void
    {
        $sql = "INSERT INTO alunos VALUES (:cpf, :nome, :email);";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue('cpf', $aluno->cpf());
        $stmt->bindValue('nome', $aluno->nome());
        $stmt->bindValue('email', $aluno->email());
        $stmt->execute();

        $sql = "INSERT INTO telefones VALUES (:ddd, :numero, :cpf_aluno);";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue('cpf_aluno', $aluno->cpf());

        foreach ($aluno->telefones() as $telefone) {
            $stmt->bindValue('ddd', $telefone->ddd());
            $stmt->bindValue('numero', $telefone->numero());
            $stmt->execute();
        }
    }

    public function removerAluno(Aluno $aluno): void
    {
        $sql = "SELECT * FROM alunos WHERE (cpf = :cpf);";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue('cpf', $aluno->cpf());
        $stmt->execute();
        $resultado = $stmt->fetchObject();

        if (empty($resultado)) {
            throw new AlunoNaoEncontradoException("Aluno não encontrado");
        }

        $sql = "DELETE FROM alunos WHERE (cpf = :cpf);";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue('cpf', $aluno->cpf());
        $stmt->execute();
    }

    public function buscarPorCpf(string $cpf): null|Aluno
    {
        $sql = "SELECT * FROM alunos WHERE (cpf = :cpf);";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue('cpf', $cpf);
        $stmt->execute();
        $resultado = $stmt->fetchObject();

        if (empty($resultado)) {
            return null;
        }

        $aluno = Aluno::criaNovoAluno($resultado->cpf, $resultado->nome, $resultado->email);

        $sql = "SELECT * FROM telefones WHERE (cpf_aluno = :cpf);";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue('cpf', $cpf);
        $stmt->execute();
        $telefones = $stmt->fetchAll(PDO::FETCH_CLASS);

        foreach ($telefones as $telefone) {
            $aluno->adicionarTelefone($telefone->ddd, $telefone->numero);
        }

        return $aluno;
    }

    public function buscarTodos(): array
    {
        $alunos = [];

        $stmt = $this->conexao->prepare("SELECT * FROM alunos;");
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_CLASS);

        if (!empty($resultado)) {
            foreach ($resultado as $alunoEncontrado) {
                $aluno = Aluno::criaNovoAluno($alunoEncontrado->cpf, $alunoEncontrado->nome, $alunoEncontrado->email);

                $sql = "SELECT * FROM telefones WHERE (cpf_aluno = :cpf);";
                $stmt = $this->conexao->prepare($sql);
                $stmt->bindValue('cpf', $alunoEncontrado->cpf);
                $stmt->execute();
                $telefones = $stmt->fetchAll(PDO::FETCH_CLASS);

                foreach ($telefones as $telefone) {
                    $aluno->adicionarTelefone($telefone->ddd, $telefone->numero);
                }

                $alunos[] = $aluno;
            }
        }
        return $alunos;
    }
}
